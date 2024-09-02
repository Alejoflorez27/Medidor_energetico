#include <HardwareSerial.h>

// Definir los pines de LoRa y ESP32
#define LORA_RX_PIN 16  // RX pin para LoRa
#define LORA_TX_PIN 17  // TX pin para LoRa
#define UART_RX_PIN 22  // RX pin para UART1
#define UART_TX_PIN 23  // TX pin para UART1

// Crear un objeto HardwareSerial para LoRa
HardwareSerial loraSerial(2);  // Usar UART2

void setup() {
  Serial.begin(9600);
  Serial1.begin(9600, SERIAL_8N1, UART_RX_PIN, UART_TX_PIN);  // TX=22, RX=23

  // Inicializar la comunicación LoRa a 115200 baudios
  loraSerial.begin(9600, SERIAL_8N1, LORA_RX_PIN, LORA_TX_PIN);

  // Establecer parámetros del módulo LoRa
  setLoRaParameters();
}

void loop() {
  if (Serial1.available()) {
    String receivedData = Serial1.readStringUntil('\n');
    Serial.println("Datos recibidos: " + receivedData);

    // Enviar los datos por LoRa
    sendData(receivedData);
    
  }
}

void setLoRaParameters() {
  // Configurar el módulo LoRa
  loraSerial.println("AT+IPR=9600");         // Configurar la velocidad en baudios
  loraSerial.println("AT+NETWORKID=6");     // Configurar el ID de la red
  loraSerial.println("AT+MODE=0");          // Modo LoRa
  loraSerial.println("AT+PARAMETER=10,7,1,7"); // Parámetros de LoRa: SF10, BW 125kHz, CR 4/5, Preamble 7

  // Esperar la respuesta del módulo LoRa
  delay(1000);
  while (loraSerial.available()) {
    String response = loraSerial.readString();
    Serial.println(response);
  }
}

void sendData(String data) {
  // Enviar datos vía LoRa
  loraSerial.print("AT+SEND=0,");
  loraSerial.print(data.length());
  loraSerial.print(",");
  loraSerial.println(data);

  // Esperar la respuesta del módulo LoRa
  //delay(1000);
  while (loraSerial.available()) {
    String response = loraSerial.readString();
    Serial.println(response);
  }
}