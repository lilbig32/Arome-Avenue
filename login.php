<?php
session_start();
// Подключение к базе данных
require_once('bd.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name']; // Получение логина из формы
    $surname = $_POST['surname']; // Получение фамилии из формы
    $pass = $_POST['pass']; // Получение пароля из формы

    // Добавляем проверку на заполнение всех полей
    if (empty($name) || empty($surname) || empty($pass)) {
        echo "Пожалуйста, заполните все поля";
        exit;
    }

    // Защита от SQL инъекций
    $name = $conn->real_escape_string($name);
    $pass = $conn->real_escape_string($pass);
    $surname = $conn->real_escape_string($surname);

    // SQL запрос для проверки логина и пароля
    $sql = "SELECT name, surname, pass FROM `userss` WHERE name = '$name' AND pass = '$pass' AND surname = '$surname'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Извлечение данных и сохранение в переменные
        $user = $result->fetch_assoc();
        $name = $user['name'];
        $surname = $user['surname'];
        $_SESSION['name'] = $name;
        $_SESSION['surname'] = $surname;

        // Переход на account.php
        header("Location: account.php");
        exit();
    } else {
        echo "Неправильный логин или пароль";
    }
}
?>



