#include <DallasTemperature.h>
#include <OneWire.h>
#include <ArduinoJson.h>
#include "GravityTDS.h"
#include <SoftwareSerial.h>

#define ONE_WIRE_BUS 4
#define TDS_SENSOR_PIN A1
#define PH_SENSOR_PIN A0

SoftwareSerial water_sensor(2, 3); // Rx Tx
OneWire oneWire(ONE_WIRE_BUS);
GravityTDS gravityTds;
DallasTemperature tempsensors(&oneWire);

float tdsValue = 0;
float tempValue = 0;
float calibrationValue = 22;
int phVal = 0;
unsigned long int avgVal;
int bufferArr[10], temp;

void setup()
{
  Serial.begin(9600);
  water_sensor.begin(9600);
  tempsensors.begin();
  gravityTds.setPin(TDS_SENSOR_PIN);
  gravityTds.setAref(5.0);
  gravityTds.setAdcRange(1024);
  gravityTds.begin();
}

StaticJsonDocument<1000> jsonDoc;

void loop()
{
  // Read pH sensor values
  for (int i = 0; i < 10; i++)
  {
    bufferArr[i] = analogRead(PH_SENSOR_PIN);
    delay(30);
  }

  // Sort pH sensor values
  for (int i = 0; i < 9; i++)
  {
    for (int j = i + 1; j < 10; j++)
    {
      if (bufferArr[i] > bufferArr[j])
      {
        temp = bufferArr[i];
        bufferArr[i] = bufferArr[j];
        bufferArr[j] = temp;
      }
    }
  }

  // Calculate average pH value
  avgVal = 0;
  for (int i = 2; i < 8; i++)
    avgVal += bufferArr[i];

  float volt = (float)avgVal * 5.0 / 1024 / 6;
  float phAct = -5.70 * volt + calibrationValue;

  // Read temperature and TDS values
  tempsensors.requestTemperatures();
  tempValue = tempsensors.getTempCByIndex(0);
  gravityTds.setTemperature(tempValue);
  gravityTds.update();
  tdsValue = gravityTds.getTdsValue();

  // Populate JSON object
  jsonDoc["a1"] = phAct;
  jsonDoc["a2"] = tdsValue;
  jsonDoc["a3"] = tempValue;

  // Serialize JSON to string
  String jsonString;
  serializeJson(jsonDoc, jsonString);

  // Print JSON to Serial
  Serial.println(jsonString);
  water_sensor.println(jsonString);
  delay(5000);
}
