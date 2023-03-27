<?php
// Подключение к базе данных
$servername = "192.168.0.200";
$username = "stis3-44";
$password = "FAA1p3eimukm!";
$dbname = "tkvins";


$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка подключения
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>