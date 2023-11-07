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

// Crear un array para almacenar los datos
$data = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = array('Fecha' => $row['Fecha'], 'Temp' => $row['Temp'], 'Hum' => $row['Hum'], 'Soilhum' => $row['Soilhum'], 'Lux' => $row['Lux']);
    }
}

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

<main>
<body>
<header>
    <div class="header-left">
      <h1>A'ttia</h1>
    </div>
    <div class="header-right">
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
    </div>
  </header>
    <h2 class="medidas">Amancay</h2>

    

    <div class="chart-container">
        <h3 class="medidas">Temperatura</h3>
    <!-- Canvas para el gráfico -->
        <canvas id="tempChart"></canvas>

    </div>

    <div class="chart-container">
        <h3 class="medidas">Humedad del ambiente</h3>
    <!-- Canvas para el gráfico -->
        <canvas id="humChart" ></canvas>

    </div>

    <div class="chart-container">
        <h3 class="medidas">Humedad del suelo</h3>
    <!-- Canvas para el gráfico -->
        <canvas id="soilChart" ></canvas>

    </div>

    <div class="chart-container">
        <h3 class="medidas">Luminosidad</h3>
    <!-- Canvas para el gráfico -->
        <canvas id="luxChart" ></canvas>

    </div>

            <script>
         // Obtener los datos desde PHP
            var data = <?php echo json_encode($data); ?>;

            // Preparar datos para el gráfico
            var labels = data.map(function(item) { return item.Fecha; });
            var valoresTemp = data.map(function(item) { return item.Temp; });
            var valoresHum = data.map(function(item) { return item.Hum; });
            var valoresSoil = data.map(function(item) { return item.Soilhum; });
            var valoresLux = data.map(function(item) { return item.Lux; });



            var ctxtemp = document.getElementById('tempChart').getContext('2d');

            var lineChart = new Chart(ctxtemp, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Temperatura (°C)',
                        data: valoresTemp,
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1,
                        fill: false
                        },
                

               ]
            },
            options: {
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Condiciones ambientales'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Temperatura (°C)'
                        }
                    }
                }
            }
        });

        var ctxhum = document.getElementById('humChart').getContext('2d');

            var lineChart = new Chart(ctxhum, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Humedad del ambiente (%)',
                        data: valoresHum,
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1,
                        fill: false
                        },
                

               ]
            },
            options: {
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Condiciones ambientales'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Humedad del ambiente (%)'
                        }
                    }
                }
            }
        });

        

        var ctxsoil = document.getElementById('soilChart').getContext('2d');

        var lineChart = new Chart(ctxsoil, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Humedad del suelo (%)',
                        data: valoresSoil,
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1,
                        fill: false
                        },
                

               ]
            },
            options: {
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Condiciones ambientales'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Humedad del suelo (%)'
                        }
                    }
                }
            }
        });

        var ctxlux = document.getElementById('luxChart').getContext('2d');

        var lineChart = new Chart(ctxlux, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Luminosidad (Lux)',
                        data: valoresLux,
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1,
                        fill: false
                        },
                

               ]
            },
            options: {
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Condiciones ambientales'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Luminosidad (Lux)'
                        }
                    }
                }
            }
        });





        </script>

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