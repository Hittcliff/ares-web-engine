<?php

# Грузим базу
include '../../data/db.php';

// Подключаем модуль загрузки
include 'img.php';

// Подключаемся к базе
$conn = mysqli_connect($db_addr, $db_user, $db_pass, $db_name);
// Название на английском
if ($_POST["element_1"]) {
    // Название на русском
    if ($_POST["element_2"]) {
        // Актёры
        if ($_POST["element_3"]) {
            // Таймеры
            if ($_POST["element_4"]) {
                // Жанры
                if ($_POST["element_5"]) {
                    // Код вставки плеера
                    if ($_POST["element_6"]) {

												// если была произведена отправка формы
											   if(isset($_FILES['file'])) {

													 	// Создаём рандомный ID
													 	$id_random = rand(1, 10000001001100);

														// Проверим есть ли такой постер
														if(file_exists('../../../template/posters/'.$id_random.'.jpg')){
															$id_random = rand($id_random+1, 10000001001100);
														}

											      // проверяем, можно ли загружать изображение
											      $check = can_upload($_FILES['file']);

											      if($check === true){

											        // загружаем изображение на сервер
											        make_upload($_FILES['file'], $id_random);
											      } else {

											        // выводим сообщение об ошибке
											        echo "<strong>$check</strong>";
											      }
											    }

													// Обработчик
													$query = "INSERT INTO `releases`(`poster`, `name_rus`, `videoprev`, `description`, `name_eng`, `data`, `today`, `voice`, `genre`, `amount`, `videocode`, `original_link`, `rating`)
													VALUES ('{$id_random}', '{$_POST["element_2"]}', 'NULL', '{$_POST["element_8"]}', '{$_POST["element_1"]}', 'TODAY', 'TODAY', '{$_POST["element_3"]}', '{$_POST["element_5"]}', '12', '{$_POST["element_6"]}', '{$_POST["element_9"]}', '{$_POST["element_12"]}')";

													if(mysqli_query($conn, $query)){
                            include '../successful.php';

													} else {
														printf("Сообщение ошибки: %s\n", mysqli_error($conn));
													}

                        // Если не будет данных
                    } else {
                        echo "Ошибка добавления!";
                    }
                } else {
                    echo "Ошибка добавления!";
                }
            } else {
                echo "Ошибка добавления!";
            }
        } else {
            echo "Ошибка добавления!";
        }
    } else {
        echo "Ошибка добавления!";
    }
} else {
    echo "Ошибка добавления!";
}
?>
