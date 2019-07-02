#include <SPI.h>
#include <Ethernet.h>
#include <MySQL_Connection.h>
#include <MySQL_Cursor.h>
#include <MySQL_Encrypt_Sha1.h>
#include <MySQL_Packet.h>
#include <LiquidCrystal_I2C.h>
#include <DHT.h>
#include <DHT_U.h>
#include <Adafruit_Sensor.h>

//variables
int temperatura1;
int temperatura2;
int temperaturapromedio;
int humedad1;
int humedad2;
int humedadpromedio;
const int ledPIN = 9;
const int ventiladorPIN = 8;
const int bombaPIN = 7;

//stados
int historiaHumedad = 0;
int historiaTemperatura = 0;
int statusVentilador = 0;
int historiaVentilador = 0;
int statusMotor = 0;
int historiaMotor = 0;
int historiaLed = 0;

//variable de control
int control = 0;

//intancia de objetos
LiquidCrystal_I2C lcd(0x3f,16,2); 
DHT dht1(4,DHT11);
DHT dht2(3,DHT11);

//datos para conexion a servidor
byte mac_addr[] = { 0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED };

IPAddress server_mysql(192,168,1,14);// IP of the MySQL *server* here
IPAddress server_addr(192,168,1,50);// IP of the arduiono *server* here
char user[] = "arduino";              // MySQL user login username
char password[] = "arduino";        // MySQL user login password

// Sample query
char INSERT_DHT[] = "INSERT INTO db_arduino.temperatura_humedad(temperatura,humedad) VALUES (%d,%d)";
char INSERT_LED[] = "INSERT INTO db_arduino.conexion_electrica(estado) VALUES (%d)";
char INSERT_MT[] = "INSERT INTO db_arduino.bomba_hidraulica(estado) VALUES (%d)";
char INSERT_VT[] = "INSERT INTO db_arduino.ventilador(estado) VALUES (%d)";
char query[128];

EthernetClient client;
MySQL_Connection conn((Client *)&client);

void setup() {
  Serial.begin(9600);
  Serial.println("Empezamos...");
  while (!Serial); // wait for serial port to connect
  Ethernet.begin(mac_addr,server_addr);
  Serial.println("Connecting...");
  if (conn.connect(server_mysql,3306, user,password)) {
    delay(1000);
  }
  else{
    Serial.println("Connection failed.");}
  
  lcd.init();
  lcd.backlight();
  
  dht1.begin();
  dht2.begin();
  
  pinMode(ledPIN,OUTPUT);
  pinMode(ventiladorPIN,OUTPUT);
  pinMode(bombaPIN,OUTPUT);
  control = 1;
}


void loop() {
  if(statusMotor == 0){
    
      int estadoLed = digitalRead(ledPIN);
      if(estadoLed == 0 && control == 1){
        digitalWrite(ledPIN,HIGH);// encendemos la luz
        control = 2;
        historiaLed = 1;  
        saveEstadoLed();
      }
      if(estadoLed != historiaLed){
        digitalWrite(ledPIN,HIGH);// encendemos la luz
        historiaLed = estadoLed;  
        saveEstadoLed();
      }
      delay(1000);  
  }

  
  temperatura1 = dht1.readTemperature();
  temperatura2 = dht2.readTemperature();
  temperaturapromedio = (temperatura1 + temperatura2)/2;
  
  humedad1 = dht1.readHumidity();
  humedad2 = dht2.readHumidity();
  humedadpromedio = (humedad1 + humedad2)/2;
  
  lcd.clear();
  lcd.setCursor(0,0);
  lcd.print("TEMPERATURA = ");
  lcd.print(temperaturapromedio); 
  lcd.setCursor (0,1);
  lcd.print("HUMEDAD = ");
  lcd.print(humedadpromedio);
  lcd.display();
  delay(500);

  
  if(temperaturapromedio != historiaTemperatura || humedadpromedio != historiaHumedad){
    saveTemperaturaHumedad();
    historiaTemperatura = temperaturapromedio;
    historiaHumedad = humedadpromedio;
    
  }
  if(temperaturapromedio >= 20 && temperaturapromedio <=27){
    //solo hace calor
    statusVentilador = 1;
    digitalWrite(ventiladorPIN,HIGH); //encendemos el ventilador
    if(statusVentilador != historiaVentilador){
        historiaVentilador = statusVentilador;      
        saveEstadoVentilador(); 
    }
    delay(2000);
    
  }
  if(temperaturapromedio <= 19 && statusVentilador == 1){
    digitalWrite(ventiladorPIN,LOW);// apagamos ventilador
    delay(1000);
    statusVentilador = 0;
    historiaVentilador = statusVentilador;      
    saveEstadoVentilador();
  }
  if(temperaturapromedio >= 28){
    if(statusVentilador = 1){
      digitalWrite(ventiladorPIN,LOW);// apagamos ventilador
      delay(1000);
      statusVentilador = 0;
      historiaVentilador = statusVentilador;      
      saveEstadoVentilador();
    }
    //entonces hay un incendio
    int estadoLed = digitalRead(ledPIN);
      if(estadoLed != historiaLed){
        digitalWrite(ledPIN,LOW);//apagamos la luz simulando cortando al conexion electrica
        historiaLed = estadoLed;  
        saveEstadoLed();
      }
    statusMotor = 1;
    if(statusMotor != historiaMotor){
      digitalWrite(bombaPIN,HIGH);//encendemos la bomba de agua;  
      historiaMotor = statusMotor;
      saveEstadoMotor();
      delay(3000);
    }
    
  }
  
  if(temperaturapromedio <=27 && statusMotor == 1){
    digitalWrite(bombaPIN,LOW);//apagamos la bomba de agua;
    statusMotor = 0;
    historiaMotor = statusMotor;
    saveEstadoMotor();
    delay(2000);
    
  }
}
void saveTemperaturaHumedad(){
    Serial.println("Empezando a guardar humedad y temperatura");
    MySQL_Cursor *cur_mem = new MySQL_Cursor(&conn);
    sprintf(query, INSERT_DHT,temperaturapromedio,humedadpromedio);
    cur_mem->execute(query);
    delete cur_mem;
}
void saveEstadoLed(){
    Serial.println("Empezando a guardar estado led");
    MySQL_Cursor *cur_mem = new MySQL_Cursor(&conn);
    sprintf(query, INSERT_LED,historiaLed);
    cur_mem->execute(query);
    delete cur_mem;
}
void saveEstadoVentilador(){
    Serial.println("Empezando a guardar estado ventilador");
    MySQL_Cursor *cur_mem = new MySQL_Cursor(&conn);
    sprintf(query, INSERT_VT,historiaVentilador);
    cur_mem->execute(query);
    delete cur_mem;
}
void saveEstadoMotor(){
    Serial.println("Empezando a guardar estado Motor");
    MySQL_Cursor *cur_mem = new MySQL_Cursor(&conn);
    sprintf(query, INSERT_MT,historiaMotor);
    cur_mem->execute(query);
    delete cur_mem;
}
