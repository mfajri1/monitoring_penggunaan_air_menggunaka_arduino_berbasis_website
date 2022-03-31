#include <SoftwareSerial.h>
//libarary rfid
#include <LiquidCrystal_I2C.h>
#include <Wire.h>
#include <Servo.h>
#include <NewPing.h>
#define btn1 6
#define btn2 7
#define TRIGGER_PIN  25  // Arduino pin tied to trigger pin on the ultrasonic sensor.
#define ECHO_PIN     27  // Arduino pin tied to echo pin on the ultrasonic sensor.
#define MAX_DISTANCE 200 // Maximum distance we want to ping for (in centimeters). Maximum sensor distance is rated at 400-500cm.

NewPing sonar(TRIGGER_PIN, ECHO_PIN, MAX_DISTANCE);


//konfig lcd
LiquidCrystal_I2C lcd(0x27, 16, 2);

Servo servo1;  // create servo object to control a servo
Servo servo2;  // create servo object to control a servo
int sensorPin = A0;
int waterpump = 5;
int kran1 = 0;
int kran2 = 0;
int nilai1 = 0;
int nilai2 = 0;
String kirim;
String dataNode = "";
//untuk milis
unsigned long previousMillis = 0;
const long interval = 2000;

volatile int pulsa_sensor;
volatile int pulsa_sensor2;
unsigned int literPerjam;
unsigned int literPerjam2;
unsigned char pinFlowsensor = 2;
unsigned char pinFlowsensor2 = 3;
unsigned long waktuAktual;
unsigned long waktuAktual2;
unsigned long waktuLoop;
unsigned long waktuLoop2;
double liter;
int data1 = 0;
int data2 = 0;
bool stat = false;
int us1 = 0;
int jarakawal = 27;
int jarak = 0;
void setup() {
  // put your setup code here, to run once:
  Serial.begin(9600);
  Serial1.begin(9600);
  pinMode(sensorPin, INPUT);
  pinMode(waterpump, OUTPUT);
  pinMode(btn1, INPUT);
  pinMode(btn2, INPUT);
  pinMode(pinFlowsensor, INPUT);
  pinMode(pinFlowsensor2, INPUT);
  
  servo1.attach(8);  // attaches the servo on pin 9 to the servo object
  servo2.attach(9);
  servo1.write(0);
  servo2.write(0);
  
  
  digitalWrite(pinFlowsensor, HIGH);
  digitalWrite(pinFlowsensor2, HIGH);
  attachInterrupt(0, cacahPulsa, RISING);
  attachInterrupt(1, cacahPulsa2, RISING);
  sei();
  waktuAktual = millis();
  waktuLoop = waktuAktual;
  waktuAktual2 = millis();
  waktuLoop2 = waktuAktual2;
  lcd.begin();
  lcd.backlight();      
  lcd.clear();
  lcd.setCursor(0,0);
  lcd.print("Selamat Datang");
  lcd.setCursor(0,1);
  lcd.print("Pada Sistem Monitor");
  delay(2000);
}

void loop() {
  waktuAktual = millis();
  if(waktuAktual >= (waktuLoop + 1000))
  {
    waktuLoop = waktuAktual;
    literPerjam = (pulsa_sensor*60/7.5);
    pulsa_sensor = 0;
    waktuLoop2 = waktuAktual2;
    literPerjam2 = (pulsa_sensor2*60/7.5);
    pulsa_sensor2 = 0;
  }
  us1 = sonar.ping_cm();
  int sensorValue = analogRead(sensorPin);
  int turbidity = map(sensorValue, 0,640, 100, 0);
  
  if(turbidity >= 50){
    digitalWrite(waterpump, HIGH);
  }else{
    digitalWrite(waterpump, LOW);
  }

  jarak = jarakawal - us1;
  Serial.println(jarak);
  if(jarak < 5){
    lcd.clear();
    lcd.setCursor(0,0);
    lcd.print("Air Kurang");
    lcd.setCursor(0,0);
    lcd.print("Silahkan Isi");
    delay(2000);
  }else{
    kran1 = digitalRead(btn1);
    kran2 = digitalRead(btn2);
  
    if(kran1 == 0){
      nilai1++;
      if(nilai1 == 1){
        servo1.write(80);
      
      }else if(nilai1 == 2){
        servo1.write(0);
        nilai1 = 0;
        data1 = 0;
      }
    }
    if(kran2 == 0){
      nilai2++;
      if(nilai2 == 1){
        servo2.write(60);
      
      }else if(nilai2 == 2){
        servo2.write(0);
        nilai2 = 0;
        delay(100);
        data2 = 0; 
      }
    }
  }
  data1 += literPerjam;
  data2 += literPerjam2;
  kirim ="";
  lcd.clear();
  lcd.setCursor(0,0);
  lcd.print("Kran 1 = ");
  lcd.print(data1);
  lcd.setCursor(0,1);
  lcd.print("Kran 2 = ");
  lcd.print(data2);
  kirim = String(literPerjam) + '#' + String(literPerjam2) ;
  
  Serial.println(kirim);
  Serial1.print(kirim);

  delay(3000);
}

void cacahPulsa()
{
  pulsa_sensor++;
}

void cacahPulsa2()
{
  pulsa_sensor2++;
}

String bacaDataNode(){
  while(Serial1.available() > 0) {
    dataNode += char(Serial1.read());
  }
  dataNode.trim();

  return dataNode;
}
