
/*
    Author: Robert Conde
    Resources: SPI [tinyurl.com/ot75qb6]
               PCD, Terminology, & Ref. [tinyurl.com/rzxecnw]
               HTTP [tinyurl.com/yba8ox9p]
    Pin Layout:
      MOSI -> D7
      MISO -> D6
      SCK  -> D5
*/

// Imports
#include <ESP8266WiFi.h>
#include <ESP8266WiFiMulti.h>
#include <ESP8266HTTPClient.h>
#include <SPI.h>
#include <MFRC522.h>

// Wifi Details
const char* SSID[] = {"Conde Residence - 2.4" ,  "Conde Residence - Garage 2.4"};
const char* PASS[] = {"heat7361",                "heat7361"};

// Box Details
const String BID = "0123456789";

// URLs & Modes
const String ARD_URL = "http://192.168.0.31/arduino";

const String MODE_NAME[] = {"Update Location" , "Update Attendance"};
const String MODE_URL[] = {"updLoc.php", "updAttend.php"};

// RFID Pins
#define RST_PIN  D3
#define SS_PIN   D2 // SDA

// Initialize Objects
ESP8266WiFiMulti multiWifi;
MFRC522 rfid(SS_PIN, RST_PIN);

void setup() {
  // Serial Begin & BID
  Serial.begin(115200);                     // For data dumps a high baud rate is needed
  
  Serial.println("\nBox '" + BID + "' On");
  Serial.println();
  
  // Wifi
  Serial.print("Connecting to Wifi");
  
  for(int i = 0; i < sizeof(SSID)/sizeof(SSID[0]); ++i)  // Connect to Wifi
    multiWifi.addAP(SSID[i], PASS[i]);
  
  while(multiWifi.run() != WL_CONNECTED) {     // Wait 'till connected to Wifi
    Serial.print(".");
    delay(1000);
  }
  Serial.println();
  
  Serial.print("Local IP: ");               // Then print out local IP address
  Serial.println(WiFi.localIP());
  Serial.println();
  
  // RFID
  SPI.begin();                              // Begin SPI (Serial Peripheral Interface; SCK, MOSI, MISO, & SS)
  rfid.PCD_Init();                          // Start PCD (Proximity Coupling Device; "Contactless Reader")
  rfid.PCD_DumpVersionToSerial();           // Dump reader version info
  Serial.println();

  // Modes
  Serial.println("Modes (Enter Corr. # to Change Mode):");
  for(int i = 0; i < sizeof(MODE_URL)/sizeof(MODE_URL[0]); ++i)
    Serial.println("\t" + modeStr(i + 1));
  Serial.println();

  // Indicate Ready
  Serial.println("Waiting for Card...");
  Serial.println();
}

int mode = 1;
void loop() {
  // If serial has input, change mode
  if(Serial.available()) {
    String in = Serial.readString();
    
    setMode(in.toInt());
    Serial.println();
  }
  
  // If card is present, do update
  if(rfid.PICC_IsNewCardPresent() && rfid.PICC_ReadCardSerial()) {
    // Card Type
    Serial.print("Card Type: ");            // Then print out its type,
    MFRC522::PICC_Type cardType = rfid.PICC_GetType(rfid.uid.sak);
    Serial.println(rfid.PICC_GetTypeName(cardType));

    // UID
    String uid = "";
    for(int i = 0; i < 4; i++) {
      char byteStr[2];
      
      sprintf(byteStr, "%02x", rfid.uid.uidByte[i]);

      uid += byteStr;
    }
    uid.toUpperCase();
    
    doUpdate(uid);
  }
  
  delay(500);
}

String modeStr(int mode) {
  String modeStr = "";

  modeStr += String(mode);        // Mode #
  modeStr += " - ";               // Separator
  modeStr += MODE_NAME[mode - 1]; // Mode Name
  modeStr += " @ ";               // Separator
  modeStr += MODE_URL[mode - 1];  // Mode URL

  return modeStr;
}

void setMode(int newMode) {
  mode = newMode;
  
  Serial.println("Mode set to "  + modeStr(newMode));
}

const String HTTPCODES[] = {"Client Connection Error", "Informational", "Successful",
                           "Redirection", "Client Error", "Server Error"};
void doUpdate(String uid) {
  HTTPClient conn;

  String request = ARD_URL + "/" + MODE_URL[mode - 1]
                    + "?bid=" + BID
                    + "&uid=" + uid;
                    
  conn.begin(request);
  int httpCode = conn.GET();

  Serial.println(String(httpCode) + " | " + HTTPCODES[max(0, httpCode/100)] + " | " + conn.getString() + "\n"
                 + "\tMode: " + modeStr(mode) + "\n"
                 + "\tUID: " + uid
                 + "\n");
  
  conn.end();
}
