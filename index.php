<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jobappdb";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Lidhja deshtoi" . $conn->connect_error);
}?>