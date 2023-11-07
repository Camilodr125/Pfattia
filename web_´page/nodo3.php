<?php
$servername = "localhost";
$username = "sammy";
$password = "password";
$dbname = "attia";


// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consultar la base de datos
$sql = "SELECT * FROM node3";
$result = $conn->query($sql);



$conn->close();
?>

<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="styles.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <title>Datos de Usuarios</title>
</head>
<body>
<header>
    <div class="header-left">
      <h1>A'ttia</h1>
    </div>
    
      <nav>
        <ul>
          <li><a href="index.php">Inicio</a></li>
          <li><div class="dropdown">
            <a href="#">Datos históricos</a>
            <div id = "historicosDropdown" class="dropdown-content">
                <a href="nodo1.php">Mangle rojo</a>
                <a href="nodo2.php">Pitamo real</a>
                <a href="nodo3.php">Amancay</a>
            </div>
        </div></li>
          <li><a href="quies-somos.html">Quiénes Somos</a></li>
        </ul>
      </nav>
    
  </header>
  <main>
    <h2 class="medidas">Amancay</h2>

    <div class="scroll table container">


    <table border="1">

    
        <tr>
            <th>Fecha</th>
            <th>Temperatura</th>
            <th>Humedad del ambiente</th>
            <th>Humedad del suelo</th>
            <th>Luminosidad</th>
        </tr>

        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["Fecha"]. "</td><td>" . $row["Temp"]. "</td><td>" . $row["Hum"]. "</td><td>" . $row["Soilhum"]. "</td><td>" . $row["Lux"]. "</td></tr>";
            }
        } else {
            echo "0 resultados";
        }
        ?>

    
    </table>

    </div>
    

    <a href="chart3.php" class="close-button button-container">Ver gráficos</a>

    </main>

    <script>
        function toggleDropdown() {
            const dropdown = document.getElementById('historicosDropdown');
            dropdown.style.display = (dropdown.style.display === 'block') ? 'none' : 'block';
        }
    </script>

    <footer>
    <p>&copy; 2023 A'ttia - Monitoreo de Cultivos</p>
    </footer>

    
</body>
</html>