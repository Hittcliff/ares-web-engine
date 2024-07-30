<?php

function can_upload($file){
    // Если имя пустое, значит файл не выбран
    if ($file['name'] == '') {
        return 'Вы не выбрали файл.';
    }

    /* Если размер файла 0, значит его не пропустили настройки
    сервера из-за того, что он слишком большой */
    if ($file['size'] == 0) {
        return 'Файл слишком большой.';
    }

    // Разбиваем имя файла по точке и получаем массив
    $getMime = explode('.', $file['name']);
    // Нас интересует последний элемент массива - расширение
    $mime = strtolower(end($getMime));
    // Объявляем массив допустимых расширений
    $types = array('jpg', 'png', 'gif', 'bmp', 'jpeg');

    // Если расширение не входит в список допустимых - возвращаем ошибку
    if (!in_array($mime, $types)) {
        return 'Недопустимый тип файла.';
    }

    return true;
}

function make_upload($file, $name) {
    // Формируем уникальное имя картинки: случайное число и name
    $uploadedFilePath = '../../../template/posters/' . $name . '.jpg';

    // Получаем информацию о загруженном файле
    $imageInfo = getimagesize($file['tmp_name']);
    $width = $imageInfo[0];
    $height = $imageInfo[1];
    $type = $imageInfo[2];

    // Создаем изображение на основе загруженного файла
    switch ($type) {
        case IMAGETYPE_JPEG:
            $image = imagecreatefromjpeg($file['tmp_name']);
            break;
        case IMAGETYPE_PNG:
            $image = imagecreatefrompng($file['tmp_name']);
            break;
        case IMAGETYPE_GIF:
            $image = imagecreatefromgif($file['tmp_name']);
            break;
        default:
            // Если тип файла не поддерживается, выходим из скрипта
            exit("Unsupported file type");
    }

    // Уменьшаем качество изображения до 50%
    imagejpeg($image, $uploadedFilePath, 50);

    // Изменяем размер изображения на 320x450
    $newWidth = 320;
    $newHeight = 450;
    $newImage = imagecreatetruecolor($newWidth, $newHeight);
    imagecopyresampled($newImage, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

    // Сохраняем новое изображение в файл
    imagejpeg($newImage, $uploadedFilePath);

    // Освобождаем память
    imagedestroy($image);
    imagedestroy($newImage);
}

// Используйте функции can_upload и make_upload для загрузки и обработки изображения
if (isset($_FILES["file"])) {
    $uploadResult = can_upload($_FILES["file"]);

    if ($uploadResult === true) {
        make_upload($_FILES["file"], 'new_filename'); // Замените 'new_filename' на желаемое имя файла
    } else {
        echo $uploadResult; // Вывод ошибки, если загрузка не удалась
    }
}


?>
