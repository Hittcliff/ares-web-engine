<?php
// Подключаем файл с настройками базы данных
require_once '../engine/data/db.php';

// Получаем данные из тела запроса в формате JSON
$data = json_decode(file_get_contents('php://input'), true);

// Получаем id и новое значение из переданных данных
$id = $data['id'];
$value = $data['value'];

// Обновляем значение в базе данных
$query = "UPDATE table_name SET value = '$value' WHERE id = $id";
$result = mysqli_query($link, $query);

// Проверяем результат выполнения запроса
if ($result) {
  // Если запрос успешен, возвращаем новое значение в виде JSON-объекта
  echo json_encode(['value' => $value]);
} else {
  // Если произошла ошибка, возвращаем ошибку в виде JSON-объекта
  echo json_encode(['error' => 'Ошибка при обновлении данных']);
}
?>
