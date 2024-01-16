<?php
$database_host = 'localhost';    
$database_user = 'root';          
$database_password = '';  
$database_name = 'shopkeeper_db'; 

// Create a connection to the database
function get_db_connection() {
    global $database_host, $database_user, $database_password, $database_name;

    $conn = new mysqli($database_host, $database_user, $database_password, $database_name);

  
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}
?>
