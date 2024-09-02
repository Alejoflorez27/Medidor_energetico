#include <HardwareSerial.h>
#include <WiFi.h>
#include <HTTPClient.h>

// Definir los pines de LoRa y ESP32
#define LORA_RX_PIN 16  // RX pin para LoRa
#define LORA_TX_PIN 17  // TX pin para LoRa

// Crear un objeto HardwareSerial para LoRa
HardwareSerial loraSerial(2);  // Usar UART2

// WiFi credentials
const char* ssid = "Familia Bohorquez";
const char* password = "hola_mundo21";

// Server details
//const char* serverUrl = "http://192.168.0.12/Medidor_energetico/urequestPHP.php";

//aws
const char* serverUrl = "http://3.16.96.30/urequestPHP.php";

// Tiempo de medición en horas (aquí 1 segundo = 1/3600 horas)
const float timeInterval = 1.0 / 3600.0;

void setup() {
  Serial.begin(9600);
  loraSerial.begin(9600, SERIAL_8N1, LORA_RX_PIN, LORA_TX_PIN);

  // Establecer parámetros del módulo LoRa
  setLoRaParameters();

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
  if (loraSerial.available()) {
    String inString = loraSerial.readStringUntil('\n');
    Serial.println("Datos recibidos por LoRa: " + inString);

    // Parsear los datos recibidos
    if (inString.startsWith("+RCV=")) {
      // Quitar el prefijo +RCV=
      inString = inString.substring(5);

      // Dividir los datos por comas y almacenar en un array
      String values[23];  // Ajustar el tamaño del array según la cantidad de valores esperados
      int index = 0;

      while (inString.length() > 0 && index < 23) {
        int commaIndex = inString.indexOf(',');
        if (commaIndex == -1) {  // Último valor
          values[index++] = inString;
          break;
        } else {
          values[index++] = inString.substring(0, commaIndex);
          inString = inString.substring(commaIndex + 1);
        }
      }

      // Asignar cada valor a su respectiva variable
      String voltaje = values[0];
      String Ia = values[1];
      String Ib = values[2];
      String Ic = values[3];
      String Pa = values[4];
      String Pb = values[5];
      String Pc = values[6];
      String Ps = values[7];
      String Qa = values[8];
      String Qb = values[9];
      String Qc = values[10];
      String Qs = values[11];
      String PFA = values[12];
      String PFB = values[13];
      String PFC = values[14];
      String PFS = values[15];
      String Sa = values[16];
      String Sb = values[17];
      String Sc = values[18];
      String Ss = values[19];
      String Frecuencia = values[22];

      Serial.println("Voltaje: " + voltaje);
      Serial.println("Corriente Ia: " + Ia);
      Serial.println("Corriente Ib: " + Ib);
      Serial.println("Corriente Ic: " + Ic);
      Serial.println("Potencia activa Pa: " + Pa);
      Serial.println("Potencia activa Pb: " + Pb);
      Serial.println("Potencia activa Pc: " + Pc);
      Serial.println("Potencia activa Ps: " + Ps);
      Serial.println("Potencia reactiva Qa: " + Qa);
      Serial.println("Potencia reactiva Qb: " + Qb);
      Serial.println("Potencia reactiva Qc: " + Qc);
      Serial.println("Potencia reactiva Qs: " + Qs);
      Serial.println("Factor de potencia A: " + PFA);
      Serial.println("Factor de potencia B: " + PFB);
      Serial.println("Factor de potencia C: " + PFC);
      Serial.println("Factor de potencia S: " + PFS);
      Serial.println("Potencia aparente Sa: " + Sa);
      Serial.println("Potencia aparente Sb: " + Sb);
      Serial.println("Potencia aparente Sc: " + Sc);
      Serial.println("Potencia aparente Ss: " + Ss);
      Serial.println("Frecuencia: " + Frecuencia);

      // Calcular el consumo de energía en kWh
      float PsFloat = Ps.toFloat();  // Convertir Ps a flotante
      float Energy = (PsFloat * timeInterval) / 1000.0;  // kWh

      Serial.println("Consumo de energía (kWh): " + String(Energy));

      // Enviar los datos al servidor
      sendToServer(voltaje, Ia, Ib, Ic, Pa, Pb, Pc, Ps, Qa, Qb, Qc, Qs, PFA, PFB, PFC, PFS, Sa, Sb, Sc, Ss, Frecuencia, Energy);
    }
  }
}

void setLoRaParameters() {
  // Configurar el módulo LoRa
  loraSerial.println("AT+IPR=9600");         // Configurar la velocidad en baudios
  loraSerial.println("AT+NETWORKID=6");     // Configurar el ID de la red
  loraSerial.println("AT+MODE=0");          // Modo LoRa
  loraSerial.println("AT+PARAMETER=10,7,1,7"); // Parámetros de LoRa: SF10, BW 125kHz, CR 4/5, Preamble 7

  // Esperar la respuesta del módulo LoRa
  while (loraSerial.available()) {
    String response = loraSerial.readString();
    Serial.println(response);
  }
}

void sendToServer(String voltaje, String Ia, String Ib, String Ic, String Pa, String Pb, String Pc, String Ps, String Qa, String Qb, String Qc, String Qs, String PFA, String PFB, String PFC, String PFS, String Sa, String Sb, String Sc, String Ss, String Frecuencia, float Energy) {
  if (WiFi.status() == WL_CONNECTED) {
    HTTPClient http;
    http.begin(serverUrl);

    // Crear el payload JSON
    String payload = "{\"V\":\"" + voltaje + 
                     "\",\"Ia\":\"" + Ia + 
                     "\",\"Ib\":\"" + Ib + 
                     "\",\"Ic\":\"" + Ic + 
                     "\",\"Pa\":\"" + Pa + 
                     "\",\"Pb\":\"" + Pb + 
                     "\",\"Pc\":\"" + Pc + 
                     "\",\"Ps\":\"" + Ps + 
                     "\",\"Qa\":\"" + Qa + 
                     "\",\"Qb\":\"" + Qb + 
                     "\",\"Qc\":\"" + Qc + 
                     "\",\"Qs\":\"" + Qs + 
                     "\",\"PFA\":\"" + PFA + 
                     "\",\"PFB\":\"" + PFB + 
                     "\",\"PFC\":\"" + PFC + 
                     "\",\"PFS\":\"" + PFS + 
                     "\",\"Sa\":\"" + Sa + 
                     "\",\"Sb\":\"" + Sb + 
                     "\",\"Sc\":\"" + Sc + 
                     "\",\"Ss\":\"" + Ss + 
                     "\",\"F\":\"" + Frecuencia + 
                     "\",\"Energy\":\"" + String(Energy) + "\"}";

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