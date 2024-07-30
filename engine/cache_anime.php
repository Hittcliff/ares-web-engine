<?php

// Грузим БД
include ENGINE . "db.php";

// Функция для кэширования данных аниме
function cacheAllAnimeData(){
    global $conn;
	
    // Получаем все записи аниме из базы данных
    $result = mysqli_query($conn, "SELECT id, name_rus FROM releases");

    // Проверяем успешность запроса
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            // Кэшируем данные для каждого аниме
            fetchAnimeInfoFull($row['name_rus'], $row['id'], 'screenshots');
        }
        echo 'Caching complete for all anime.';
    } else {
        echo 'No anime found in the database.';
    }
}

// Кэширование с Kodik
function fetchAnimeInfoFull($name, $id, $get)
{
    $cacheDir = "cache/animecache/";
    $cacheFile = $cacheDir . $id . ".json";

    // Проверяем наличие деректории
    if (!file_exists($cacheDir)) {
        mkdir($cacheDir, 0777, true);
    }

    // Проверка...
    if (file_exists($cacheFile)) {
        // Если файл есть, читаем
        $json = file_get_contents($cacheFile);
        $data = json_decode($json, true);
    } else {
        // Если файла кэша нет, то кэшируем
        $url =
            "https://kodikapi.com/search?token=278e3fce3f59586dfea0c177a1ae2c94&title=" .
            urlencode($name);
        $json = file_get_contents($url);
        $decodedData = json_decode($json, true);

        // Ищем проект по ключу
        $data = null;
        foreach ($decodedData["results"] as $result) {
            if ($result["translation"]["title"] === "AniJoy") {
                $data = $result;
                break;
            }
        }

        // Я заебался писать комментарии, проверяем кэш...
        if ($data) {
            file_put_contents($cacheFile, json_encode($data));
        } else {
            return "Не братишка, ты что-то перепутал. Проект AniJoy не озвучивала данный проект";
        }
    }

    $result = [];
    switch ($get) {
        case "translation":
            $result = $data["translation"]["title"];
            break;
        case "episodes_count":
            $result = $data["episodes_count"];
            break;
        case "last_episode":
            $result = $data["last_episode"];
            break;
        case "last_season":
            $result = $data["last_season"];
            break;
        case "screenshots":
            // Check if cache directory exists, if not, create it
            $cacheDirImage = "cache/image/" . $id . "/";
            if (!file_exists($cacheDirImage)) {
                mkdir($cacheDirImage, 0777, true);
            }

            $screenshotPaths = []; // Массив для хранения путей к загруженным скриншотам

            // Перебираем все скриншоты
            foreach ($data["screenshots"] as $screenshotUrl) {
                // Указываем путь до скриншота
                $screenshotPath =
                    $cacheDirImage . basename($screenshotUrl);

                // Проверяем наличие кэша картинки
                if (!file_exists($screenshotPath)) {
                    // Получаем финальный URL
                    $redirectedUrl = getFinalUrl($screenshotUrl);

                    // Загрузка изображения
                    $screenshotContent = file_get_contents($redirectedUrl);

                    // Сохранения в папку кэша
                    file_put_contents($screenshotPath, $screenshotContent);
                }

                // Добавляем путь к скриншоту в массив
                $screenshotPaths[] = $screenshotPath;
            }

            $result = $screenshotPaths; // Возвращаем массив с путями к загруженным скриншотам
            break;
    }

    return $result;
}

// Вызываем функцию для кэширования данных для всех аниме
cacheAllAnimeData();

?>
