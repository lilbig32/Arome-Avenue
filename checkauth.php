<?php
session_start();

// Пример: Установка значения переменной сессии login
$_SESSION['login'] = 'username';

// Проверка наличия значения переменной сессии login
if (isset($_SESSION['login'])) {
    // Пользователь авторизован, отправляем на личный кабинет
    header("Location: account.php");
    exit();
} else {
    // Пользователь не авторизован, отправляем на страницу входа
    header("Location: login.html");
    exit();
}
?>