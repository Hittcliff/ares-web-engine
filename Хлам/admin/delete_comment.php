<?php
// Подключение к базе данных
include '../data/db.php';

// Проверка подключения
if (!$conn) {
    die("Ошибка подключения к базе данных: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $commentId = $_POST["comment_id"];
    
    // Запрос на удаление комментария по его ID
    $sql = "DELETE FROM comments WHERE id = $commentId";
    
    $result = mysqli_query($conn, $sql);
    
    if (!$result) {
        die("Ошибка выполнения запроса: " . mysqli_error($conn));
    }
}

// Закрываем соединение с базой данных
mysqli_close($conn);
?>
