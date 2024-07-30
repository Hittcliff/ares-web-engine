<?php
// Проверяем доступ
# defined($keyaccess) or die ('Извените! У вас нет доступа к этому файлу!');

# Информаиця о подключении к БД
$db_addr = 'localhost';
$db_user = 'root';
$db_pass = 'dvdSp21sx@LR_suA';
$db_name = 'ani4290831_arengine';

// Проверка соединения
if ($conn === false) {
  die("Ошибка: " . mysqli_connect_error());
}
// Конец соединения

// Подключаемся к БД
$conn = mysqli_connect($db_addr, $db_user, $db_pass, $db_name);
// Конец соединения
?>
