//Tesis por WIFI
#include <ModbusMaster.h>
#include <WiFi.h>
#include <HTTPClient.h>

// Modbus stuff
#define MODBUS_DIR_PIN 33
#define MODBUS_RX_PIN 16
#define MODBUS_TX_PIN 17
#define MODBUS_SERIAL_BAUD 9600

// Dirección de los registros de datos del medidor de energía
uint16_t data_registers[] = {
  0x002A, // Voltage
  0x002B, // Ia
  0x002C, // Ib
  0x002D, // Ic
  0x002E, // Pa
  0x002F, // Pb
  0x0030, // Pc
  0x0031, // Ps
  0x0032, // Qa
  0x0033, // Qb
  0x0034, // Qc
  0x0035, // Qs
  0x0036, // PFA
  0x0037, // PFB
  0x0038, // PFC
  0x0039, // PFS
  0x003A, // Sa
  0x003B, // Sb
  0x003C, // Sc
  0x003D, // Ss
  0x003E  // Frecuencia
};

// WiFi credentials
const char* ssid = "Familia Bohorquez";
const char* password = "hola_mundo21";

// Server details
//local cambia por dhcp mirar cmd ipv4
const char* serverUrl = "http://192.168.0.12/Medidor_energetico/urequestPHP.php";
//aws
//const char* serverUrl = "http://3.16.96.30/urequestPHP.php";

// Inicializar el objeto ModbusMaster como nodo
ModbusMaster node;

// Variables para cálculo de energía
float totalEnergy = 0.0; // Energía total en kWh
unsigned long previousMillis = 0;
const unsigned long interval = 5000; // Intervalo de 5 segundos para lecturas

// Pin 4 establecido en alto para el modo de transmisión Modbus
void modbusPreTransmission() {
  digitalWrite(MODBUS_DIR_PIN, HIGH);
}

// Pin 4 establecido en bajo para el modo de recepción Modbus
void modbusPostTransmission() {
  digitalWrite(MODBUS_DIR_PIN, LOW);
}

void setup() {
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

void loop() {
  unsigned long currentMillis = millis();

  if (currentMillis - previousMillis >= interval) {
    previousMillis = currentMillis;

    uint8_t result;
    uint16_t data[21]; // Array para almacenar los datos leídos

    for (int i = 0; i < 21; i++) {
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

    // Convertir las lecturas a valores adecuados
    float voltage = data[0] / 10.0;
    float currentA = data[1] / 1000.0;
    float currentB = data[2] / 1000.0;
    float currentC = data[3] / 1000.0;
    float powerA = data[4] / 10.0;
    float powerB = data[5] / 10.0;
    float powerC = data[6] / 10.0;
    float totalPower = data[7] / 10.0;
    float reactivePowerA = data[8] / 10.0;
    float reactivePowerB = data[9] / 10.0;
    float reactivePowerC = data[10] / 10.0;
    float totalReactivePower = data[11] / 10.0;
    float powerFactorA = data[12] / 100.0;
    float powerFactorB = data[13] / 100.0;
    float powerFactorC = data[14] / 100.0;
    float totalPowerFactor = data[15] / 100.0;
    float apparentPowerA = data[16] / 10.0;
    float apparentPowerB = data[17] / 10.0;
    float apparentPowerC = data[18] / 10.0;
    float totalApparentPower = data[19] / 10.0;
    float frequency = data[20] / 10.0;

    // Calcular la energía (en kWh)
    float energy = (totalPower * (interval / 3600000.0)); // Intervalo en horas
    totalEnergy += energy;

    // Imprimir la energía total
    Serial.print("Energía total (kWh): ");
    Serial.println(totalEnergy);

    // Enviar datos al servidor
    if (WiFi.status() == WL_CONNECTED) {
      HTTPClient http;
      http.begin(serverUrl);

      // Crear el payload JSON
      String payload = "{\"V\":" + String(voltage) +
                       ",\"Ia\":" + String(currentA) +
                       ",\"Ib\":" + String(currentB) +
                       ",\"Ic\":" + String(currentC) +
                       ",\"Pa\":" + String(powerA) +
                       ",\"Pb\":" + String(powerB) +
                       ",\"Pc\":" + String(powerC) +
                       ",\"Ps\":" + String(totalPower) +
                       ",\"Qa\":" + String(reactivePowerA) +
                       ",\"Qb\":" + String(reactivePowerB) +
                       ",\"Qc\":" + String(reactivePowerC) +
                       ",\"Qs\":" + String(totalReactivePower) +
                       ",\"PFA\":" + String(powerFactorA) +
                       ",\"PFB\":" + String(powerFactorB) +
                       ",\"PFC\":" + String(powerFactorC) +
                       ",\"PFS\":" + String(totalPowerFactor) +
                       ",\"Sa\":" + String(apparentPowerA) +
                       ",\"Sb\":" + String(apparentPowerB) +
                       ",\"Sc\":" + String(apparentPowerC) +
                       ",\"Ss\":" + String(totalApparentPower) +
                       ",\"F\":" + String(frequency) +
                       ",\"Energy\":" + String(totalEnergy) + "}";

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
  }
}
