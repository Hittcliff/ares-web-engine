<?php session_start();
include 'modules/config.php';
include '../data/db.php';

if($_SESSION["permisions"] == 2 or $_SESSION["permisions"] == 1){
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>[AniJoy] Админ панель</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="assets/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="assets/css/materialize.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="assets/css/custom.css" rel="stylesheet" type="text/css" />
  </head>

  <body>
	<?php include 'menu.php'; ?>
	

    <main>
      <section class="content">
        <div class="page-announce valign-wrapper"><h1 class="page-announce-text valign">Оптимизация сайта</h1></div>

      <!-- Stat Boxes -->
      <div class="row">
              <div class="container">
                <div class="custom-responsive">
<html>

<body>
    <?php
    // Отключаем вывод предупреждений (warnings)
    error_reporting(E_ERROR);

    $directory = '../../template/posters/';
    $maxWidth = 320;
    $maxHeight = 450;
    $quality = 60;
    $optimizedFilesCount = 0;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (is_dir($directory)) {
            if ($dh = opendir($directory)) {
                while (($file = readdir($dh)) !== false) {
                    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
                    $info = pathinfo($file);
                    $extension = strtolower($info['extension']);

                    if (in_array($extension, $allowedExtensions)) {
                        $filePath = $directory . $file;

                        // Получаем размер изображения до сжатия
                        $originalSize = filesize($filePath);

                        list($width, $height) = getimagesize($filePath);

                        if ($width > $maxWidth || $height > $maxHeight) {
                            $ratio = min($maxWidth / $width, $maxHeight / $height);
                            $newWidth = round($width * $ratio);
                            $newHeight = round($height * $ratio);

                            $sourceImage = imagecreatefromjpeg($filePath);
                            $newImage = imagecreatetruecolor($newWidth, $newHeight);

                            if (imagecopyresampled($newImage, $sourceImage, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height)) {
                                // Сжатие успешно
                                imagejpeg($newImage, $filePath, $quality);

                                // Получаем размер изображения после сжатия
                                $compressedSize = filesize($filePath);

                                // Рассчитываем процент сжатия
                                $percentReduced = 100 - (($compressedSize / $originalSize) * 100);

                                imagedestroy($sourceImage);
                                imagedestroy($newImage);

                                $optimizedFilesCount++; // Увеличиваем счетчик сжатых файлов
                            }
                        }
                    }
                }
                closedir($dh);
            }
        }
    }
    ?>

    <div class="opti_form">
        <?php if ($optimizedFilesCount > 0): ?>
            <p>Оптимизация завершена. Сжато файлов: <?php echo $optimizedFilesCount; ?></p>
        <?php else: ?>
            <p>Нет изображений, подлежащих оптимизации.</p>
        <?php endif; ?>
        <form action="otimizaition.php" method="POST">
            <input type="submit" name="optimize" value="Оптимизировать изображения">
        </form>
    </div>
</body>

</html>


              </div>
            </div>
          </div>
        </section>
        </main>
        <footer class="page-footer">
          <div class="footer-copyright">
            <div class="container">
              AniJoy сколько тут дол*ебов? :)
            </div>
          </div>
        </footer>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
      </body>
    </html>
<?} else {
    header("Location: /");
}?>
