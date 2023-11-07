async function getData (){

    

    const response = await fetch("data.php");
    const data = await response.json();
    console.log(data);

    

    document.getElementById("latitude").innerText=data.temp;
    document.getElementById("hum").innerText=data.hum;
    document.getElementById("soilhum").innerText=data.soilhum;
    document.getElementById("lux").innerText=data.lux;

    

    
}
setInterval(getData,3000);