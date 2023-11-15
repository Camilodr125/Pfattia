#include <lorawan.h>
#include <DHT.h>
#include <BH1750.h>



//ABP Credentials 
const char *devAddr = "260CE4BB";
const char *nwkSKey = "D7187DA1DF8EC2FEDF04FCA44816A487";
const char *appSKey = "C41408FD9B3AC6D01C2D4BC43712DD50";

//variables sensores
#define DHTPIN            11       
#define DHTTYPE           DHT11
DHT dht(DHTPIN, DHTTYPE);
BH1750 Luxometro;
int moisture_percentage;
int sensor_analog;
int temp;
int hum;
int lux;
const int sensor_pin = A0;
byte rele = 9;   
//int onriego=0;

const unsigned long interval = 5000;    // 10 s interval to send message
unsigned long previousMillis = 0;  // will store last time message sentchar myStr[50];

unsigned int counter = 0;     // message counter

char myStr[50];
char outStr[255];
byte recvStatus = 0;

const sRFM_pins RFM_pins = {
  .CS = 8,
  .RST = 4,
  .DIO0 = 7,
  .DIO1 = 5,
  .DIO2 = 10,
  .DIO5 = 15,
};

void setup() {
  // Setup loraid access
  Serial.begin(9600);
  dht.begin();
  Luxometro.begin();
  pinMode(rele, OUTPUT);
  while(0);
  if(!lora.init()){
    Serial.println("RFM95 not detected");
    delay(5000);
    return;
  }

  Wire.begin();  

  // Set LoRaWAN Class change CLASS_A or CLASS_C
  lora.setDeviceClass(CLASS_C);
  


  // Set Data Rate
  lora.setDataRate(SF10BW125);

  // set channel to random
  lora.setChannel(MULTI);
  
  // Put ABP Key and DevAddress here
  lora.setNwkSKey(nwkSKey);
  lora.setAppSKey(appSKey);
  lora.setDevAddr(devAddr);

}

void loop() {
  
  //Variables 
  temp = dht.readTemperature();
  hum = dht.readHumidity();
  lux = Luxometro.readLightLevel();
  sensor_analog = analogRead(sensor_pin);
  moisture_percentage = ( 100 - ( (sensor_analog/1023.00) * 100 ) );
  //int recvStatus;
  //int offriego=0;


  // Check interval overflow
  if(millis() - previousMillis > interval) {
    previousMillis = millis(); 

    sprintf(myStr, "/1/%d/%d/%d/%d", temp,hum,lux,moisture_percentage);
    
    Serial.print("Sending: ");
    Serial.println(myStr);
    
    lora.sendUplink(myStr, strlen(myStr), 0, 1);
    counter++;
  }

  
  // Check Lora RX
  lora.update();

  
     if (moisture_percentage < 30){ 
      digitalWrite(rele, LOW);
       Serial.println("Rele activado");
      delay(720000);
  } else{
    digitalWrite(rele, HIGH);
  }
    
}
