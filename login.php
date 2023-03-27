<?php
// Подключение к базе данных
include("db.php");

// Проверка логина и пароля
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password"])) {
            // Сессия пользователя
            session_start();
            $_SESSION["id"] = $row["id"];
            $_SESSION["username"] = $row["username"];
            header("Location: index.html");
            exit;
        }
        else {
            echo "Неправильный логин или пароль.";
        }
    }
    else {
        echo "Неправильный логин или пароль.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Вход</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Вход</h2>
    <form method="post">
        <label>Имя:</label>
        <input type="text" name="username" required><br>
        <label>Пароль:</label>
        <input type="password" name="password" required><br>
        <input type="submit" value="Войти">
    </form>
    
    <?php
$conn->close();
?>
</body>
</html>
