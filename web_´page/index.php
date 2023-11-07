<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Monitoreo de Cultivos</title>
  <link rel="stylesheet" href="styles.css">
  <script src="script.js" defer></script>
  <script src="data.js" defer></script>
  <script src="data2.js" defer></script>
  <script src="data3.js" defer></script>
  <script src="cerrar.js" defer></script>
</head>

<?php   
ob_start();
include("data.php");
$arr=json_decode(ob_get_clean());
?>

<?php   
ob_start();
include("data2.php");
$arr2=json_decode(ob_get_clean());
?>

<?php   
ob_start();
include("data3.php");
$arr3=json_decode(ob_get_clean());
?>

<header>
  <h1>A'ttia</h1>

  <nav>
    <ul>
      <li><a href="index.php">Datos en tiempo real</a></li>
      <li><div class="dropdown">
            <a href="#">Datos históricos</a>
            <div id = "historicosDropdown" class="dropdown-content">
                <a href="nodo1.php">Mangle rojo</a>
                <a href="nodo2.php">Pitamo real</a>
                <a href="nodo3.php">Amancay</a>
            </div>
        </div></li>
      <li><a href="quies-somos.html">Sobre nosotros</a></li>
    </ul>
  </nav>
</header>

<div>
  <main>
  <h1 class="tilte-header">Datos tiempo real</h1>
  <div class="sensor-columns">
    <div class="sensor-column">
      <h2 class="sensor-title">Mangle rojo</h2>
      <div class="sensor-container humidity-bg">
        <h3 class="sensor-label">Humedad del ambiente (%) </h3>
        <p class="sensor-data" id="humedad-nodo1"><span id="hum"<?php echo $arr->{"hum"}?></span> %</p>
      </div>
      <div class="sensor-container soil-humidity-bg">
        <h3 class="sensor-label">Humedad en el Suelo (%)</h3>
        <p class="sensor-data soil-humidity" id="humedad-suelo-nodo1" ><span id="soilhum"<?php echo $arr->{"soilhum"}?></span> %</p>
      </div>
      <div class="sensor-container temperature-bg">
        <h3 class="sensor-label">Temperatura (°C) </h3>
        <p class="sensor-data" id="temperatura-nodo1"><span id="latitude"<?php echo $arr->{"temp"}?></span> °C</p>
        
      </div>
      <div class="sensor-container light-bg">
        <h3 class="sensor-label">Luminosidad (Lux)</h3>
        <p class="sensor-data" id="luminosidad-nodo1"><span id="lux"<?php echo $arr->{"lux"}?></span> </p>

      </div>

      

      
      
    </div>

    <div class="sensor-column">
        <h2 class="sensor-title">Pitamo real</h2>
        <div class="sensor-container humidity-bg">
          <h3 class="sensor-label">Humedad del ambiente(%)</h3>
          <p class="sensor-data" id="humedad-nodo2"><span id="hum2"<?php echo $arr2->{"hum"}?></span> %</p>
        </div>
        <div class="sensor-container soil-humidity-bg">
          <h3 class="sensor-label">Humedad en el Suelo (%)</h3>
          <p class="sensor-data soil-humidity" id="humedad-suelo-nodo2"><span id="soilhum2"<?php echo $arr2->{"soilhum"}?></span> %</p>
        </div>
        <div class="sensor-container temperature-bg">
          <h3 class="sensor-label">Temperatura (°C)</h3>
          <p class="sensor-data" id="temperatura-nodo2"><span id="latitude2"<?php echo $arr2->{"temp"}?></span> °C</p>
        </div>
        <div class="sensor-container light-bg">
          <h3 class="sensor-label">Luminosidad (Lux)</h3>
          <p class="sensor-data" id="luminosidad-nodo2"><span id="lux2"<?php echo $arr2->{"lux"}?></span> </p>
        </div>

        
        
      </div>

      <div class="sensor-column">
        <h2 class="sensor-title">Amancay</h2>
        <div class="sensor-container humidity-bg">
          <h3 class="sensor-label">Humedad del ambiente (%)</h3>
          <p class="sensor-data" id="humedad-nodo3"><span id="hum3"<?php echo $arr3->{"hum"}?></span> %</p>
        </div>
        <div class="sensor-container soil-humidity-bg">
          <h3 class="sensor-label">Humedad en el Suelo (%)</h3>
          <p class="sensor-data soil-humidity" id="humedad-suelo-nodo3" ><span id="soilhum3"<?php echo $arr3->{"soilhum"}?></span> %</p>
        </div>
        <div class="sensor-container temperature-bg">
          <h3 class="sensor-label">Temperatura (°C)</h3>
          <p class="sensor-data" id="temperatura-nodo3"><span id="latitude3"<?php echo $arr3->{"temp"}?></span> °C</p>
        </div>
        <div class="sensor-container light-bg">
          <h3 class="sensor-label">Luminosidad (Lux)</h3>
          <p class="sensor-data" id="luminosidad-nodo3"><span id="lux3"<?php echo $arr3->{"lux"}?></span></p>
        </div>

        
        
      </div>
   
  </div>

  </div>

  <h1 class="solicitudes">Realizar solicitudes</h1>

  <div class="container">

  
  <div id="loginForm" class="form-group">
        <label for="username">Usuario:</label>
        <input type="text" id="username" placeholder="Ingrese su usuario" class="entrada"><br><br>
        <label for="password">Contraseña:</label>
        <input type="password" id="password" placeholder="Ingrese su contraseña" class="entrada"><br><br>
        <button onclick="verificarCredenciales()" class="close-button">Iniciar Sesión</button>
    </div>
    <div id="mensajeForm" style="display: none;" class="form-group">
    <button onclick="enviarDownlink()" class="close-button">Desactivar riego automático</button>
        
        <button onclick="enviarMensajeWhatsApp()" class="close-button">Realizar solicitud</button>
    </div>

  </div>
 
</body>
</main>

      <script>
        function toggleDropdown() {
            const dropdown = document.getElementById('historicosDropdown');
            dropdown.style.display = (dropdown.style.display === 'block') ? 'none' : 'block';
        }
      </script>

<footer>
  <p class="footer-info">  A'ttia</p>
  <p class="footer-info"> Universidad del Norte</p>
  <p class="footer-info">  2023</p>
</footer>
</html>