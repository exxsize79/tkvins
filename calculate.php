<?php

// Получение данных из формы
$vehicle_value = $_POST['vehicle_value'];
$insurance_type = $_POST['insurance_type'];

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

// Получение коэффициента из базы данных
$sql = "SELECT coefficient FROM insurance_coefficients WHERE insurance_type = '$insurance_type'";
$result = $conn->query($sql);

// Проверка наличия данных
if ($result->num_rows > 0) {
    // Извлечение данных из базы данных
    $row = $result->fetch_assoc();
    $coefficient = $row['coefficient'];
} else {
    // Если данных нет
    $coefficient = 70.0;
}

// Вычисление стоимости полиса
$policy_cost = $vehicle_value * $coefficient;

// Вывод результата
echo "Стоимость полиса: " . round($policy_cost, 2);

// Закрытие соединения с базой данных
$conn->close();

?>