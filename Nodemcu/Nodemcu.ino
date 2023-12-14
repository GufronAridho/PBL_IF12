#include <WiFiManager.h>
#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
#include <WiFiClient.h>
#include <ArduinoJson.h>
#include <SoftwareSerial.h>

const char* host = "";  //Replace with your IP
const char* serverName = ""; //Replace with http://your host/your folder/post_data.php 

SoftwareSerial water_sensor(14, 12);  // Rx Tx D5 D6
//Replace with your apiKeyValue
//Make sure to change the apiKeyValue of the post_data.php
String apiKeyValue = ""; 
float ph;
int tds;
float temp;

void setup() {
  WiFi.mode(WIFI_STA);  // explicitly set mode, esp defaults to STA+AP
  Serial.begin(9600);
  water_sensor.begin(9600);
  //WiFiManager, Local intialization. Once its business is done, there is no need to keep it around
  WiFiManager wm;
  // reset settings - wipe stored credentials for testing
  // these are stored by the esp library
  wm.resetSettings(); // you can delete this line if done with testing WiFi access point
  // Automatically connect using saved credentials,
  // if connection fails, it starts an access point with the specified name ( "AutoConnectAP"),
  // if empty will auto generate SSID, if password is blank it will be anonymous AP (wm.autoConnect())
  // then goes into a blocking loop awaiting configuration and will return success result
  bool res;
  // res = wm.autoConnect(); // auto generated AP name from chipid
  // res = wm.autoConnect("AutoConnectAP"); // anonymous ap
  res = wm.autoConnect("AutoConnectAP", "password");  // password protected ap
  if (!res) {
    Serial.println("Failed to connect");
    // ESP.restart();
  } else {
    //if you get here you have connected to the WiFi
    Serial.println("connected...yeey :)");
  }
}

void loop() {
  if (get_sensor_data()) {
    Serial.println("Data captured");
    WiFiClient client;
    const int httpPort = 80;
    if (!client.connect(host, httpPort)) {
      Serial.println("Connection to server failed");
      
      return;
    }
    //Check WiFi connection status
    if (WiFi.status() == WL_CONNECTED) {
      HTTPClient http;

      http.begin(client, serverName);

      http.addHeader("Content-Type", "application/x-www-form-urlencoded");

      String httpRequestData = "api_key=" + apiKeyValue + "&ph=" + ph +"&tds=" + tds + "&temp=" + temp + "";
      Serial.print("httpRequestData: ");
      Serial.println(httpRequestData);

      int httpResponseCode = http.POST(httpRequestData);
      if (httpResponseCode > 0) {
        Serial.print("HTTP Response code: ");
        Serial.println(httpResponseCode);
      } else {
        Serial.print("Error code: ");
        Serial.println(httpResponseCode);
      }
      // Free resources
      http.end();
    } else {
      Serial.println("WiFi Disconnected");
    }
  } else {
    Serial.println("Error in JSON data");
  }
  delay(5000); 
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
  temp = jsonDoc["a3"].as<float>(); 

  return true;
}
