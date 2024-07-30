<?php
// Подключение к базе данных
include '../data/db.php';

$conn = mysqli_connect($db_addr, $db_user, $db_pass, $db_name);
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

// Получение значения переменной $ban
$ban = $_GET['ban']; // предполагается, что значение $ban получено из формы или другого источника
$id = $_GET['id'];

if($id != 18){
$sql = "UPDATE users SET ban_status = '$ban' WHERE id = '$id'";

if ($conn->query($sql) === TRUE) {
    echo "Значение поля 'ban_status' успешно обновлено.";
} else {
    echo "Ошибка при обновлении значения поля 'ban_status': " . $conn->error;
}
  header("Location: ".$_SERVER['HTTP_REFERER']);
}
$conn->close();
?>
