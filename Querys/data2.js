async function getData (){

    

    const response = await fetch("data2.php");
    const data = await response.json();
    console.log(data);

    

    document.getElementById("latitude2").innerText=data.temp;
    document.getElementById("hum2").innerText=data.hum;
    document.getElementById("soilhum2").innerText=data.soilhum;
    document.getElementById("lux2").innerText=data.lux;

    

    
}
setInterval(getData,3000);