<?php
// Подключение к базе данных
include("db.php");

// Определение операции
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Добавление записи
    if (isset($_POST["add"])) {
        $username = $_POST["username"];
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
        $email = $_POST["email"];
        $sql = "INSERT INTO users (username, password, email) VALUES ('$username', '$password', '$email')";
        if ($conn->query($sql) === TRUE) {
            header("Location: users.php");
            exit;
        }
        else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    // // Изменеие записи
    // elseif (isset($_POST["edit"])) {
    //     $id = $_POST["id"];
    //     $username = $_POST["username"];
    //     $email = $_POST["email"];
    //     $sql = "UPDATE users SET username='$username', email='$email' WHERE id=$id";
    //     if ($conn->query($sql) === TRUE) {
    //         header("Location: users.php");
    //         exit;
    //     }
    //     else {
    //         echo "Error: " . $sql . "<br>" . $conn->error;
    //     }
    // }
    // Удаление записи
    elseif (isset($_POST["delete"])) {
        $id = $_POST["id"];
        $sql = "DELETE FROM users WHERE id=$id";
        if ($conn->query($sql) === TRUE) {
            header("Location: users.php");
            exit;
        }
        else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

// Получение данных из базы данных
$sql = "SELECT * FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Пользователи</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Список пользователей</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Имя пользователя</th>
            <th>Пароль</th>
            <th>Email</th>
            <th>Действия</th>
        </tr>
        <?php
if ($result->num_rows > 0) {
    // Вывод данных в таблицу
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["username"] . "</td>";
        echo "<td>" . $row["password"] . "</td>";
        echo "<td>" . $row["email"] . "</td>";
        echo "<td>";
        echo "<form method='post'>";
        echo "<input type='hidden' name='id' value='" . $row["id"] . "'>";
        echo "<input type='submit' name='edit' value='Изменить'>";
        echo "<input type='submit' name='delete' value='Удалить'>";
        echo "</form>";
        echo "</td>";
        echo "</tr>";
    }
}
else {
    echo "Нет пользователей.";
}
?>
    </table>
    
    <h2>Добавление пользователя</h2>
    <form method="post">
        <label>Имя пользователя:</label>
        <input type="text" name="username" required>
        <br><br>
        <label>Пароль:</label>
        <input type="password" name="password" required>
        <br><br>
        <label>Email:</label>
        <input type="email" name="email" required>
        <br><br>
        <input type="submit" name="add" value="Добавить">
    </form>
    
    <?php
$conn->close();
?>
</body>
</html>