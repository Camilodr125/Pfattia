async function getData (){

    

    const response = await fetch("data3.php");
    const data = await response.json();
    console.log(data);

    

    document.getElementById("latitude3").innerText=data.temp;
    document.getElementById("hum3").innerText=data.hum;
    document.getElementById("soilhum3").innerText=data.soilhum;
    document.getElementById("lux3").innerText=data.lux;

    

    
}
setInterval(getData,3000);