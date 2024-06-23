#include <ModbusMaster.h>
#include <WiFi.h>
#include <HTTPClient.h>

// Modbus stuff
#define MODBUS_DIR_PIN 33
#define MODBUS_RX_PIN 16
#define MODBUS_TX_PIN 17
#define MODBUS_SERIAL_BAUD 9600

uint16_t data_registers[] = {0x003E, 0x002A, 0x002F}; // Direcciones de los registros: F, V, C

// WiFi credentials
const char* ssid = "Familia Bohorquez";
const char* password = "hola_mundo21";

// Server details
//local
//const char* serverUrl = "http://192.168.0.3/Medidor_energetico/urequestPHP.php";
//aws
const char* serverUrl = "http://3.16.96.30/urequestPHP.php";

// Inicializar el objeto ModbusMaster como nodo
ModbusMaster node;

// Pin 4 establecido en alto para el modo de transmisión Modbus
void modbusPreTransmission()
{
  digitalWrite(MODBUS_DIR_PIN, HIGH);
}

// Pin 4 establecido en bajo para el modo de recepción Modbus
void modbusPostTransmission()
{
  digitalWrite(MODBUS_DIR_PIN, LOW);
}

void setup()
{
  // Inicializar comunicación serial
  Serial.begin(9600);
  pinMode(MODBUS_DIR_PIN, OUTPUT);
  digitalWrite(MODBUS_DIR_PIN, LOW);

  // Inicializar comunicación serial para MODBUS
  Serial2.begin(MODBUS_SERIAL_BAUD, SERIAL_8N1, MODBUS_RX_PIN, MODBUS_TX_PIN);
  Serial2.setTimeout(200);

  // Iniciar el nodo MODBUS con dirección de esclavo 12 y puerto Serial2
  node.begin(1, Serial2);

  // Asignar funciones de callback para cambiar la dirección del pin MODBUS_DIR_PIN
  node.preTransmission(modbusPreTransmission);
  node.postTransmission(modbusPostTransmission);

  // Conectarse a la red WiFi
  WiFi.begin(ssid, password);
  Serial.print("Conectando a WiFi");
  while (WiFi.status() != WL_CONNECTED) {
    delay(1000);
    Serial.print(".");
  }
  Serial.println("Conectado a WiFi");
}

void loop()
{
  uint8_t result;
  uint16_t data[3]; // Array para almacenar los datos leídos

  for (int i = 0; i < 3; i++) {
    // Leer los registros de datos del medidor de energía
    Serial.print("Intentando leer registro en dirección: ");
    Serial.println(data_registers[i]);
    result = node.readInputRegisters(data_registers[i], 1);
    
    // Verificar si la lectura fue exitosa
    if (result == node.ku8MBSuccess) {
      // Recuperar los datos leídos y almacenarlos en el array 'data'
      data[i] = node.getResponseBuffer(0);
      // Imprimir el valor leído
      Serial.print("Valor leído en registro: ");
      Serial.println(data[i]);
    } else {
      // Si la lectura no fue exitosa, imprimir el código de error
      Serial.print("Failed to read register. Error code: ");
      Serial.println(result, HEX);
    }
    delay(100); // Esperar un breve tiempo antes de la próxima lectura
  }

  // Enviar datos al servidor
  if (WiFi.status() == WL_CONNECTED) {
    HTTPClient http;
    http.begin(serverUrl);

    // Crear el payload JSON
    String payload = "{\"F\":" + String(data[0]) + ",\"V\":" + String(data[1]) + ",\"C\":" + String(data[2]) + "}";

    // Configurar cabeceras
    http.addHeader("Content-Type", "application/json");

    // Enviar solicitud POST
    int httpResponseCode = http.POST(payload);

    // Verificar la respuesta del servidor
    if (httpResponseCode > 0) {
      String response = http.getString();
      Serial.println("Respuesta del servidor: " + response);
    } else {
      Serial.println("Error en la solicitud POST: " + String(httpResponseCode));
    }

    // Finalizar conexión
    http.end();
  } else {
    Serial.println("No conectado a WiFi");
  }

  // Esperar un tiempo antes de la próxima iteración
  delay(5000);
}
