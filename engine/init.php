<?php
// Язык сайта
$jsonFilePath = LANG . 'ru_RU';

// Определяем путь к файлу index.php относительно корневой директории сайта
$indexPath = 'template/index.php';

// Грузим список файлов
include_once ENGINE . 'functions.php';

// Добавляю прилоаудер
include ENGINE . 'preloader.php';

// Проверяем, установлен ли параметр 'page' в URL
if(isset($_GET['page'])) {
    switch($_GET['page']) {
        case 'about':
            $indexPath = 'template/about.php';
            break;
        case 'precache':
                $indexPath = 'template/cache_interface.php';
            break;
        case 'anime':
            if(isset($_GET['id'])) {
                $indexPath = 'template/anime.php';
            } else {
                $indexPath = 'template/error/404.php';
            }
            break;
        case 'search':
            if(isset($_GET['genre']) or isset($_GET['voice']) or isset($_GET['animename'])) {
                $indexPath = 'template/search.php';
            } else {
                $indexPath = 'template/error/404.php';
            }
            break;
        case 'admin':
            $indexPath = 'admin/index.php';
        break;
        default:
            $indexPath = 'template/error/404.php';
            break;
    }
} else {
    $indexPath = 'template/index.php';
}




// Файл требуется для загрузки сайта
$s = TEMPLATE . 'index.php'; // Ищем главный файл

// Ищем в случае чего выводим
if (file_exists($s)) {

    // Теперь можно загрузить index.php, и он будет думать, что запущен из корневой директории
    include_once $indexPath;

    // Логирование
    logError($interfaceData['success_01'], 'logs.log');

    // Ну да, ну да, пошёл я нахуй.
} else {

    // Ошибка, логируем выводим на экран
    echo $interfaceData['error_01'];
    logError($interfaceData['error_01']);
}


?>

<!-- Убираем прилоадер -->
<script type="text/javascript">
  $(window).load(function() {
    $('#prepreloader').fadeOut('slow');
  });
  // Обработчик события для всех ссылок с классом "anipre" на странице
  document.querySelectorAll('a.anipre').forEach(link => {
    link.addEventListener('click', function(event) {
      // Отменяем стандартное поведение перехода по ссылке
      event.preventDefault();

      // Затемняем экран
      document.body.style.transition = 'opacity 0.4s';
      document.body.style.opacity = '0';

      // Получаем URL ссылки, по которой был совершен клик
      const url = this.getAttribute('href');

      // Задержка перед переходом на следующую страницу (время анимации затемнения)
      setTimeout(() => {
        // Переходим по ссылке
        window.location.href = url;
      }, 500); // Задержка в миллисекундах (в данном случае 500 мс)
    });
  });


</script>
