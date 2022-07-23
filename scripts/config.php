<?php

// Database credentials 
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'leadformadmin');
define('DB_PASSWORD', 'Password');
define('DB_NAME', 'leadform1');
 
// Attempt to connect to MySQL database
$mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($mysqli === false){
    die("ERROR: Could not connect. " . $mysqli->connect_error);
}
?>