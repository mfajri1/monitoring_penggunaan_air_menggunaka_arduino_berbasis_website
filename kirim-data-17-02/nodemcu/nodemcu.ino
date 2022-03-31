#include <SoftwareSerial.h>
//library wifi
#include <ESP8266HTTPClient.h>
#include <ESP8266WiFi.h>

//Network SSID
const char* ssid = "empty";
const char* password = "fajri1001";

//pengenal host (server) = IP Address komputer server
const char* host = "192.168.43.118";

SoftwareSerial node(14, 12); // RX, TX
unsigned long previousMillis = 0;
const long interval = 2000;
String dataMega = "";
String arrMega[2];
int indexMega = 0;
String debit1 = "";
String debit2 = "";
int ledMerah = 5;
int ledHijau = 4;
void setup() {
  Serial.begin(9600);
  pinMode(ledMerah, OUTPUT);
  pinMode(ledHijau, OUTPUT);
  node.begin(9600);

//  //setting koneksi wifi
  WiFi.mode(WIFI_STA);
  WiFi.hostname("NodeMCU");
  WiFi.begin(ssid, password);

  //cek koneksi wifi
  while(WiFi.status() != WL_CONNECTED)
  {
    //progress sedang mencari WiFi
    delay(500);
    Serial.print(".");
    digitalWrite(ledMerah, HIGH);
  }

  Serial.println("Wifi Connected");
  Serial.println("IP Address : ");
  Serial.println(WiFi.localIP());
  digitalWrite(ledMerah, LOW);
  digitalWrite(ledHijau, HIGH);

}

void loop() {
//  dataMega = "";
  dataMega = bacaDataMega();
  dataMega.trim();
  if(dataMega != ""){
    Serial.println(dataMega);
    for(int i = 0; i <= dataMega.length(); i++){
      char delimiter = '#';
      if(dataMega[i] != delimiter){
        arrMega[indexMega] += dataMega[i];    
      }else{
        indexMega++;
      }
    }
    Serial.println(arrMega[0]);
    Serial.println(arrMega[1]);
    
    WiFiClient client;
    const int httpPort = 80;
    if(!client.connect(host, httpPort))
    {
      Serial.println("Connection Failed");
      return;
    }

    String Link;
    HTTPClient http;
    Link = "http://192.168.43.118/yosi/dataSensor.php?data1=" + arrMega[0] + "&data2=" + arrMega[1];
    http.begin(Link);

    int httpCode = http.GET();
    String payload = http.getString();
    if(payload != ""){
      Serial.println(payload);  
    }
//    node.println(payload);
    http.end();
    delay(1000);
  }
  delay(2000);
    dataMega = "";
    arrMega[0] = "";
    arrMega[1] = "";
    indexMega = 0;
}


String bacaDataMega(){
  while(node.available() > 0) {
    dataMega += char(node.read());
  }

  return dataMega;
}
