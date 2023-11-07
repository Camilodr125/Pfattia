<?php   
define('TIMEZONE', 'America/Bogota');
date_default_timezone_set(TIMEZONE);
define('DB_HOST', 'localhost');
define('DB_USERNAME', 'sammy'); 
define('DB_PASSWORD', 'password');
define('DB_NAME', 'attia');

// Create connection
$conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
// Check connection
if ($conn->connect_error) {
    echo "Failure";
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Connected succesfully";
}

?>
