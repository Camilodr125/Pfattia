// Simulación de datos
function generarDatosAleatorios() {
    return {
      humedad: Math.random() * 100,
      humedadSuelo: Math.random()*100,
      temperatura: Math.random() * 40,
      luminosidad: Math.random() * 1000

    };
  }

 
  
  function actualizarDatosNodo(nodoId) {
    const datos = generarDatosAleatorios();
  
    document.getElementById(`humedad-${nodoId}`).textContent = datos.humedad.toFixed(2) + " %";
    document.getElementById(`humedad-suelo-${nodoId}`).textContent = datos.humedadSuelo.toFixed(2) + " %"; 

    document.getElementById(`temperatura-${nodoId}`).textContent = datos.temperatura.toFixed(2) + " °C";
    document.getElementById(`luminosidad-${nodoId}`).textContent = datos.luminosidad.toFixed(2) + " Lux";
  }

   // Obtener los elementos de los botones "Cerrar Válvula" (uno por cada nodo)
const closeButton1 = document.querySelector('.sensor-column:nth-child(1) .close-button');
const closeButton2 = document.querySelector('.sensor-column:nth-child(2) .close-button');
const closeButton3 = document.querySelector('.sensor-column:nth-child(3) .close-button');

// Obtener los elementos que muestran la humedad en el suelo para cada nodo
const soilHumidityElement1 = document.querySelector('.sensor-column:nth-child(1) .soil-humidity');
const soilHumidityElement2 = document.querySelector('.sensor-column:nth-child(2) .soil-humidity');
const soilHumidityElement3 = document.querySelector('.sensor-column:nth-child(3) .soil-humidity');

// Función para comprobar la humedad en el suelo y habilitar/deshabilitar el botón para cada nodo
function checkSoilHumidity() {
  // Obtener los valores de la humedad en el suelo para cada nodo (convertir a número)
  const soilHumidity1 = parseFloat(soilHumidityElement1.innerText);
  const soilHumidity2 = parseFloat(soilHumidityElement2.innerText);
  const soilHumidity3 = parseFloat(soilHumidityElement3.innerText);

  // Verificar y actualizar el estado del botón "Cerrar Válvula" para cada nodo
  closeButton1.disabled = soilHumidity1 > 40;
  closeButton2.disabled = soilHumidity2 > 40;
  closeButton3.disabled = soilHumidity3 > 40;
}

// Llamar a la función cuando la página se carga inicialmente
checkSoilHumidity();
  
  // Actualizar cada 5 segundos para cada nodo
  setInterval(() => {
    actualizarDatosNodo('nodo1');
    actualizarDatosNodo('nodo2');
    actualizarDatosNodo('nodo3');

    checkSoilHumidity();
  }, 5000);

  
  function cerrarValvula(nodoId) {
    alert(`Se ha cerrado la válvula en ${nodoId}`);
  }

  

