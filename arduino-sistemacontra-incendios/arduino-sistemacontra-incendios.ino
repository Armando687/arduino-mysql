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
int status1 = 0;
int status2 = 0;

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
char INSERT_LED[] = "INSERT INTO db_arduino.conexion_electrica(estado) VALUES (%h)";
char INSERT_MT[] = "INSERT INTO db_arduino.bomba_hidraulica(estado) VALUES (%h)";
char INSERT_VT[] = "INSERT INTO db_arduino.ventilador(estado) VALUES (%h)";
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
}


void loop() {
  digitalWrite(ledPIN,HIGH);// encendemos la luz
  delay(1000);
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
  //lcd.noDisplay();
  //delay(500);
  if(temperaturapromedio >= 20 && temperaturapromedio <=27){
    saveTemperaturaHumedad();
    //solo hace calor
    status1 = 1;
    digitalWrite(ventiladorPIN,HIGH); //encendemos el ventilador
    
    delay(5000);
    
  }
  if(temperaturapromedio <= 19 && status1 == 1){
    digitalWrite(ventiladorPIN,LOW);// apagamos ventilador
    delay(1000);
    status1 = 0;
  }
  if(temperaturapromedio >= 28){
    if(status1 = 1){
      digitalWrite(ventiladorPIN,LOW);// apagamos ventilador
      delay(1000);
      status1 = 0;
    }
    //entonces hay un incendio
    digitalWrite(ledPIN,LOW);//apagamos la luz simulando cortando al conexion electrica
    delay(1000);
    digitalWrite(bombaPIN,HIGH);//encendemos la bomba de agua;
    delay(5000);
    status2 = 1;
  }
  
  if(temperaturapromedio <=27 && status2 == 1){
    digitalWrite(bombaPIN,LOW);//apagamos la bomba de agua;
    delay(2000);
    status2 = 0;
  }
}
void saveTemperaturaHumedad(){
    Serial.println("Empezando a guardar");
    MySQL_Cursor *cur_mem = new MySQL_Cursor(&conn);
    //dtostrf(50.125, 1, 1, 16);
    sprintf(query, INSERT_DHT,24,16);
    // Execute the query
    cur_mem->execute(query);
    // Note: since there are no results, we do not need to read any data
    // Deleting the cursor also frees up memory used
    delete cur_mem;
    Serial.println("Data recorded.");
}
