<?php
// Подключение к БД
$host = 'localhost'; // Для хостингов обычно localhost
$dbname = 'nikitadol2';
$username = 'nikitadol2';
$password = 'ZAP^2MYaGENSDAL1'; // Пароль с символами

// Создаем соединение
$conn = new mysqli($host, $username, $password, $dbname);

// Проверяем соединение
if ($conn->connect_error) {
    die("❌ Ошибка подключения: " . $conn->connect_error);
}

// Устанавливаем кодировку
$conn->set_charset("utf8mb4");

// Если всё ок, можно использовать $conn в других файлах
// Например: $result = $conn->query("SELECT * FROM users");
?>