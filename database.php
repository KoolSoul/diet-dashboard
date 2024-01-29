<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$host = "localhost";
$dbname = "login_db";
$username = "root";
$password = "7mfy3HcYn9*yF6aV";

$mysqli = new mysqli(hostname: $host, username: $username, password: $password, database: $dbname);
                     
if ($mysqli->connect_errno) {
    die("Connection error: " . $mysqli->connect_error);
}

return $mysqli;

