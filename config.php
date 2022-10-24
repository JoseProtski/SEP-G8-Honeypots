<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$DB_SERVER = "localhost";
$DB_USERNAME = "admin";
$DB_PASSWORD = "securepassword";
$DB_NAME = "bad_sec";

/* Attempt to connect to MySQL database */
$conn = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

// Check connection
if($conn->connect_errno){
    echo "CONNECTION FAILED" . $conn->connect_error;
}
?>