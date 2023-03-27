<?php
// Подключение к базе данных
include("db.php");

// Обработка данных формы
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $email = $_POST["email"];

    // Проверка наличия пользователя в базе данных
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "Пользователь с таким именем уже существует.";
    }
    else {
        // Добавление пользователя в базу данных
        $sql = "INSERT INTO users (username, password, email) VALUES ('$username', '$password', '$email')";
        if ($conn->query($sql) === TRUE) {
            echo "Пользователь успешно зарегистрирован.";
            // Перенаправление на страницу входа
            header("Location: login.php");
            exit();
        }
        else {
            echo "Ошибка: " . $sql . "<br>" . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Регистрация</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Регистрация</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label>Имя:</label>
        <input type="text" name="username" required><br>
        <label>Пароль:</label>
        <input type="password" name="password" required><br>
        <label>Почта:</label>        
        <input type="email" name="email" required><br>
        <input type="submit" value="Зарегистрироваться">
    </form>
</body>
</html>
