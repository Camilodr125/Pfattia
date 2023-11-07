<?php   

$servername = "localhost";
$username = "sammy";
$password = "password";
$dbname = "attia";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM  node3 ORDER  BY Fecha DESC LIMIT  1";  
$result = $conn->query($sql);


if ($result->num_rows > 0) {
    // output data of each row
  $row = $result->fetch_assoc();

  $arr3 = array(
    'temp' => $row["Temp"],
    'hum' => $row["Hum"],
    'soilhum' => $row["Soilhum"],
    'lux' => $row["Lux"],
    
    
    
  );
  echo json_encode($arr3);
  } else {
    echo "0 results";
  }
  $conn->close();

?>