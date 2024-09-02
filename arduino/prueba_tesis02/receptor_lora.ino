#include <HardwareSerial.h>

// Definir los pines de LoRa y ESP32
#define LORA_RX_PIN 16  // RX pin para LoRa
#define LORA_TX_PIN 17  // TX pin para LoRa

// Crear un objeto HardwareSerial para LoRa
HardwareSerial loraSerial(2);  // Usar UART2

void setup() {
  Serial.begin(9600);
  loraSerial.begin(9600, SERIAL_8N1, LORA_RX_PIN, LORA_TX_PIN);

  // Establecer parámetros del módulo LoRa
  setLoRaParameters();
}

void loop() {
  if (loraSerial.available()) {
    String inString = loraSerial.readStringUntil('\n');
    Serial.println("Datos recibidos por LoRa: " + inString);

    // Parsear los datos recibidos
    if (inString.startsWith("+RCV=")) {
      // Quitar el prefijo +RCV=
      inString = inString.substring(5);

      // Dividir los datos por comas
      int firstComma = inString.indexOf(',');
      int secondComma = inString.indexOf(',', firstComma + 1);
      int thirdComma = inString.indexOf(',', secondComma + 1);

      String address = inString.substring(0, firstComma);
      String length = inString.substring(firstComma + 1, secondComma);
      String data = inString.substring(secondComma + 1, thirdComma);

      Serial.println("Dirección: " + address);
      Serial.println("Longitud: " + length);
      Serial.println("Datos: " + data);
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
  //delay(1000);
  while (loraSerial.available()) {
    String response = loraSerial.readString();
    Serial.println(response);
  }
}