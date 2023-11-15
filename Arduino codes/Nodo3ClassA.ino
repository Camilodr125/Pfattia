#include <lorawan.h>
#include <DHT.h>
#include <BH1750.h>


//ABP Credentials 
const char *devAddr = "260CBF26";
const char *nwkSKey = "8BF7BBB31EF20F7C4C6C4883E0FBD7B2";
const char *appSKey = "07AA7B742D1C87B4A7DE7AA9F39D7062";


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

const unsigned long interval = 5000;    // 10 s interval to send message
unsigned long previousMillis = 0;  // will store last time message sent
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
  while(0);
  if(!lora.init()){
    Serial.println("RFM95 not detected");
    delay(5000);
    return;
  }

  Wire.begin();  

  // Set LoRaWAN Class change CLASS_A or CLASS_C
  lora.setDeviceClass(CLASS_A);
  


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



  
  // Check interval overflow
  if(millis() - previousMillis > interval) {
    previousMillis = millis(); 

    sprintf(myStr, "/1/%d/%d/%d/%d", temp,hum,lux,moisture_percentage);
    
    Serial.print("Sending: ");
    Serial.println(myStr);
    
    lora.sendUplink(myStr, strlen(myStr), 0, 1);
    counter++;
  }

  recvStatus = lora.readData(outStr);
  if(recvStatus) {
    Serial.println(outStr);
  }
  
  // Check Lora RX
  lora.update();
}
