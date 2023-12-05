#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
#include <WiFiClient.h>
#include <ArduinoJson.h>
#include <SoftwareSerial.h>

const char* ssid = "";               //Replace with your network SSID
const char* password = "";  //Replace with your network password
const char* host = "";        //Replace with  your IP or Website hosting

SoftwareSerial water_sensor(14, 12);       // Rx Tx D5 D6
float ph;
int tds;
int temp;

void setup() {
  Serial.begin(9600);
  water_sensor.begin(9600);
  WiFi.mode(WIFI_STA);
  WiFi.begin(ssid, password);
  // Attempt to connect to WiFi
  int attempts = 0;
  while (WiFi.status() != WL_CONNECTED && attempts < 20) {
    Serial.print(".");
    delay(1000);
    attempts++;
  }
  if (attempts >= 20) {
    Serial.println("Failed to connect to WiFi. Please check your credentials.");
    // You may add additional handling here, such as restarting the device.
  } else {
    Serial.println("");
    Serial.println("WiFi connected");
    Serial.println("IP address: ");
    Serial.println(WiFi.localIP());
    Serial.println();
    delay(2000);
  }
}

void loop() {
  if (get_sensor_data()) {
    Serial.println("Data captured");
    WiFiClient client;
    const int httpPort = 80;
    if (!client.connect(host, httpPort)) {
      Serial.println("Connection to server failed");
      // You may add additional handling here, such as restarting the device.
      return;
    }

    //Check WiFi connection status
    if (WiFi.status() == WL_CONNECTED) {
      String Link;
      HTTPClient http;
      Link = "http://" + String(host) + "/send_data.php?ph=" + String(ph) + "&tds=" + String(tds) + "&temp=" + String(temp);

      http.begin(client, Link);
      http.GET();

      String respon = http.getString();
      Serial.println(respon);
      http.end();

    }
  } else {
    Serial.println("Error in JSON data");
  }

  delay(5000);  // kalo mau ganti ganti di arduino juga waktunya
}

bool get_sensor_data() {
  StaticJsonDocument<1000> jsonDoc;

  // Read the JSON string from SoftwareSerial
  String jsonString = water_sensor.readStringUntil('\n');

  // Deserialize JSON
  DeserializationError error = deserializeJson(jsonDoc, jsonString);

  // Check for errors
  if (error) {
    Serial.print(F("deserializeJson() failed: "));
    Serial.println(error.c_str());
    return false;
  }
  Serial.print("Received JSON: ");
  Serial.println(jsonString);
  // Extract data from JSON
  ph = jsonDoc["a1"].as<float>();
  tds = jsonDoc["a2"].as<int>();
  temp = jsonDoc["a3"].as<int>();  // Temp

  return true;
}
