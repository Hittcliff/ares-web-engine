<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $content = $_POST['content'];

    // Сохранение содержимого в файле template/credits.php
    file_put_contents('../../template/credits.php', $content);
}

// Перенаправление обратно на страницу редактора
header('Location: credits_edit.php');
?>