<?php
require_once('bd.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Проверка наличия данных перед их обработкой
    if (isset($_POST['name'], $_POST['surname'], $_POST['pass'], $_POST['repeatpass'])) {
        $name = $_POST['name'];
        $pass = $_POST['pass'];
        $surname = $_POST['surname'];
        $repeatpass = $_POST['repeatpass'];

        // Добавляем проверку на заполнение всех полей
        if (empty($name) || empty($surname) || empty($pass) || empty($repeatpass)) {
            echo "Пожалуйста, заполните все поля";
            exit;
        }

        // Добавляем проверку пароля
        if ($pass !== $repeatpass) {
            echo "Пароли не совпадают";
            exit;
        }

        // Вставка данных в базу данных
        $sql = "INSERT INTO `userss` (name, surname, pass) VALUES ('$name', '$surname', '$pass')";
        $conn->query($sql);

        // Перенаправление на страницу login.html
        header("Location: login.html");
        exit; // Убедитесь, что скрипт останавливается после перенаправления
    }
}
?>