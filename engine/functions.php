<?php
// Путь к файлу JSON
$jsonFilePath = $jsonFilePath . ".json";

// Загрузка и декодирование JSON файла
$jsonData = file_get_contents($jsonFilePath);
$interfaceData = json_decode($jsonData, true);

// Проверка на ошибки при загрузке и декодировании JSON
if ($interfaceData === null && json_last_error() !== JSON_ERROR_NONE) {
    die("Ошибка при загрузке или декодировании JSON файла.");
}

// Генерируем пару открытого и закрытого ключей
$keyPair = openssl_pkey_new([
    "private_key_bits" => 2048,
    "private_key_type" => OPENSSL_KEYTYPE_RSA,
]);

// Получаем открытый ключ
openssl_pkey_export($keyPair, $privateKey);
$publicKey = openssl_pkey_get_details($keyPair)["key"];

// Печатаем открытый ключ (для шифрования)
// echo "Public Key: $publicKey <br>";

// $txt = 'Тестируем обратимое шифрование на php';
//
// $encrypted = encrypt($txt, $publicKey);
// echo $encrypted . '<br>';
//
//
// $decrypted = decrypt($encrypted, $privateKey);
// echo $decrypted;

function encrypt($decrypted, $publicKey)
{
    openssl_public_encrypt($decrypted, $encrypted, $publicKey);
    return base64_encode($encrypted);
}

function decrypt($encrypted, $privateKey)
{
    openssl_private_decrypt(base64_decode($encrypted), $decrypted, $privateKey);
    return $decrypted;
}
// Генерируем пару открытого и закрытого ключей

// Логирование
function logError($errorMessage, $logFile = "error_log.txt")
{
    // Формируем путь к файлу лога
    $logFilePath = ENGINE . "cache/" . $logFile;

    // Формируем сообщение об ошибке с датой и временем
    $errorLogMessage = date("Y-m-d H:i:s") . " - " . $errorMessage . PHP_EOL;

    // Открываем файл для записи (если не существует, он будет создан)
    $fileHandle = fopen($logFilePath, "a");

    // Записываем сообщение об ошибке в файл
    fwrite($fileHandle, $errorLogMessage);

    // Закрываем файл
    fclose($fileHandle);
}
// Логирование

// Хуйня без которой, не будет работать нихуя.
function getFinalUrl($url)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_exec($ch);
    $finalUrl = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
    curl_close($ch);
    return $finalUrl;
}

// Кэширование с Kodik
function fetchAnimeInfo($name, $id, $get)
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
            } else {
              break;
            }
        }

        // Я заебался писать комментарии, проверяем кэш...
        if ($data) {
            file_put_contents($cacheFile, json_encode($data));
        } else {
            return 0;
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
        case "quality":
            $result = $data["quality"];
            break;
        case "type":
            $result = $data["translation"]["type"];
            break;
        case "year":
            $result = $data["year"];
            break;
        case "screenshots":
                // Check if cache directory exists, if not, create it
                $cacheDirImage = "cache/image/" . $id . "/";
                if (!file_exists($cacheDirImage)) {
                    mkdir($cacheDirImage, 0777, true);
                }

                // Выбираем рандомный скриншот
                $randomScreenshot = $data["screenshots"][array_rand($data["screenshots"])];

                // Указываем путь до скриншота
                $screenshotPath = $cacheDirImage . basename($randomScreenshot);

                // Проверяем наличие кэша картинки
                if (!file_exists($screenshotPath)) {
                    // Получаем финальный URL
                    $redirectedUrl = getFinalUrl($randomScreenshot);

                    // Загрузка изображения
                    $screenshotContent = file_get_contents($redirectedUrl);

                    // Сохранения в папку кэша
                    file_put_contents($screenshotPath, $screenshotContent);
                }

                $result = $screenshotPath; // Передаем только путь к загруженному скриншоту
            break;
        default:
            // Если переданый неверные параметры выдывать ошибку
            $result = "Параметр не найден, или просто про#бан.";
            break;
    }

    // Выводим этот ебаныный результат
    return $result;
}

// Загружаем список аниме
function animeList($params = [])
{
    // Грузим БД
    include ENGINE . "db.php";

    $sql =
        "SELECT id, poster, name_rus, genre, description, view, status FROM releases";

    // Формируем условие запроса в зависимости от параметров
    if (!empty($params)) {
        if (isset($params["жанр"])) {
            $genre = $params["жанр"];
            $genreCondition = "`genre` LIKE '%$genre%'";
            $sql .= " WHERE $genreCondition";
        }

        if (isset($params["актёры"])) {
            $voice = $params["актёры"];
            $genreCondition = "`voice` LIKE '%$voice%'";
            $sql .= " WHERE $genreCondition";
        }

        if (isset($params["популярные"])) {
            $sql .= " ORDER BY view DESC";
            if (is_numeric($params["популярные"])) {
                $limit = intval($params["популярные"]);
                $sql .= " LIMIT $limit";
            }
        }

        if (isset($params["anime"])) {
            $search = $_GET["animename"];
            $searchCondition = "(`name_eng` LIKE '%$search%' OR `name_rus` LIKE '%$search%' OR `voice` LIKE '%$search%' OR `genre` LIKE '%$search%')";
            $sql = "SELECT * FROM releases WHERE $searchCondition";
        }
    }

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // Если есть результаты, выводим их
        while ($row = mysqli_fetch_assoc($result)) {
            $posterPath = "template/posters/" . $row["poster"] . ".jpg";
            $fullLink = "/anime" . $row["id"];

            echo '<div class="item vhny-grid">';
            echo '<div class="box16">';
            echo '<a class="anipre" href="' . $fullLink . '">';
            echo "<figure>";
            echo '<img loading="lazy" alt="..." class="img-fluid" src="' .
                $posterPath .
                '" alt="">';
            echo "</figure>";
            echo '<div class="box-content">';
            echo '<h3 class="title">' . $row["name_rus"] . "</h3>";
            echo "<h4>";
            echo '<span class="post">';
            echo '<span class="fa fa-clock-o"> </span> Количество серии ' .
                fetchAnimeInfo($row["name_rus"], $row["id"], "last_episode");
            echo "</span>";
            echo '<span class="post fa fa-heart text-right"></span>';
            echo "</h4>";
            echo "</div>";
            echo '<span class="fa fa-play video-icon" aria-hidden="true"></span>';
            echo "</a>";
            echo "</div>";
            echo "</div>";
        }
    } else {
        // Если результаты не найдены
        echo "По вашему запросу ничего не найдено";
    }

    mysqli_close($conn);
}

// Функция для обработки хэштегов
function hashtag($type, $data)
{
    switch ($type) {
        case "genre":
            // Разделяем строку на отдельные жанры
            $genres = explode(",", $data);
            // Обрабатываем каждый жанр отдельно
            foreach ($genres as $genre) {
                // Убираем лишние пробелы в начале и конце строки
                $genre = trim($genre);
                echo "<a class='anipre' href='/search?genre=$genre'>$genre</a>  ";
            }
            break;
        case "voice":
            // Разделяем строку на отдельные жанры
            $voices = explode(",", $data);

            // Обрабатываем каждого актёра отдельно
            foreach ($voices as $voice) {
                // Убираем лишние пробелы в начале и конце строки
                $voice = trim($voice);
                echo "<a class='anipre' href='/search?voice=$voice'>$voice</a>  ";
            }
            break;
        case "other":
            // Для других типов можно добавить собственную логику обработки
            echo $data;
            break;
        default:
            // Если передан неподдерживаемый тип, можно вывести ошибку или выполнить другое действие
            echo "Unsupported type: $type";
            break;
    }
}

// Загружаем аниме
function animeFull()
{
    // Определяем ID аниме
    $animeId = $_GET["id"];

    // Грузим БД
    include ENGINE . "db.php";

    // Защита от SQL инъекций
    $animeId = mysqli_real_escape_string($conn, $animeId);

    $sql = "SELECT id, poster, name_rus, name_eng ,genre, description, view, status, videocode, voice FROM releases WHERE id = '$animeId'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Выводим информацию по ID
        $posterPath = "template/posters/" . $row["poster"] . ".jpg";
        $fullLink = "/anime" . $row["id"];
        echo '<div class="bgimg"><img class="PosterBackground" loading="lazy" src="' .
            fetchAnimeInfo($row["name_rus"], $row["id"], "screenshots") .
            '" alt="Anime Poster"></div>';

        echo '<div class="anime-container">';
        echo '<div class="poster">';
        echo '<img loading="lazy" src="' .
            $posterPath .
            '" alt="Anime Poster">';


        echo '<div class="rating_anime">';
        echo '<div class="rating_border"></div>';
        echo '<h2>4.5</h2> <h4>Сформировано на основе 1 голоса</h4><br><br>';
        include TEMPLATE . 'checkRating.php';
        echo '</div>';

        echo "</div>";
        echo '<div class="info">';
        echo "<h2>" . $row["name_rus"] . "</h2>" . "<h19>" . $row["name_eng"] . "</h19><hr>";
        echo "<p>Качество: ";
        echo fetchAnimeInfo($row["quality"], $row["id"], "quality");
        echo "</p>";
        echo "<p>Год: ";
        echo fetchAnimeInfo($row["year"], $row["id"], "year");
        echo "</p>";
        echo "<p>Жанр: ";
        // Используем функцию hashtag для обработки хэштегов в жанрах
        hashtag("genre", $row["genre"]);
        echo "</p>";
        echo "<p>Роли озвучивали: ";
        hashtag("voice", $row["voice"]);
        echo "</p>";
        // В случае если не нашли инфу
        if(fetchAnimeInfo($row["name_rus"], $row["id"], "episodes_count") or fetchAnimeInfo($row["name_rus"], $row["id"], "episodes_count") != 0){
          echo '<p>Эпизоды: ';
              if(fetchAnimeInfo($row["name_rus"], $row["id"], "episodes_count") == fetchAnimeInfo($row["name_rus"], $row["id"], "last_episode")){
                echo fetchAnimeInfo($row["name_rus"], $row["id"], "episodes_count") .' / ' . fetchAnimeInfo($row["name_rus"], $row["id"], "last_episode") ;
              } else {
                echo fetchAnimeInfo($row["name_rus"], $row["id"], "episodes_count") .' / ' . fetchAnimeInfo($row["name_rus"], $row["id"], "last_episode") ;
              }
          echo '</p>';
        }
        echo "<p>Описание: " . $row["description"] . "</p>";
        echo "</div>";
        echo '<div class="player">';
        echo $row["videocode"];
        echo "</div>";
        echo "</div>";
    } else {
        echo "Аниме не найдено";
    }

    mysqli_close($conn);
}

?>
