<?php
// Variables for database
$db_name = "loginregister";
$password = "";
$username = "root";
$hostname = "localhost";

// Connect to database
$database_conn = mysqli_connect($hostname, $username, $password, $db_name);

// Check connection
if (!$database_conn) {
    die("<div class='alert alert-danger'> ❌ Failed to connect to database: '{$db_name}'</div>");
}
?>
