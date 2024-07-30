<?php
if(isset($_FILES['file'])) {

  # Грузим базу
  include '../../data/db.php';

  $mysqli = mysqli_connect($db_addr, $db_user, $db_pass, $db_name);

  // Проверяем соединение
  if ($mysqli->connect_errno) {
      echo 'Не удалось подключиться к MySQL: ' . $mysqli->connect_error;
      exit();
  }

  // Выполняем запрос на получение количества новостей
  $query = $mysqli->query('SELECT COUNT(*) FROM releases');

  // Получаем результат запроса
  $count = $query->fetch_array()[0];
  $count = $count + 1;

  // Закрываем соединение
  $mysqli->close();

    $target_dir = "../../../template/screenshot/" . $count . "/";

    if(!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $files = glob($target_dir . "*.jpg");
    if (count($files) == 0) {
        // Если папка пуста, создаем файл 1.jpg
        $new_file_name = "1.jpg";
    } else {
        // Иначе находим последний файл и увеличиваем порядковый номер
        $last_file = end($files);
        $last_file_name = basename($last_file);
        $last_file_num = (int)substr($last_file_name, 0, -4); // удаляем ".jpg" и преобразуем в число
        $new_file_num = $last_file_num + 1;
        $new_file_name = $new_file_num . ".jpg";
    }

    $target_file = $target_dir . basename($_FILES["file"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $uploadOk = 1;
    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["file"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        $uploadOk = 0;
    }
    // Check if file already exists
    if (file_exists($target_file)) {
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["file"]["size"] > 5000000) {
        $uploadOk = 0;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Простите. Этот файл не может быть загружен.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_dir . $new_file_name)) {
            echo "Файл: ". basename( $_FILES["file"]["name"]). " загружен!";
        } else {
            echo "Извените. Во время загрузки произошла ошибка.";
        }
    }
}
?>
