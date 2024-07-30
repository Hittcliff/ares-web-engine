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
				<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Подключитесь к вашей базе данных
	include '../data/db.php';
	
    if (!$conn) {
        die("Ошибка подключения к базе данных: " . mysqli_connect_error());
    }

    // Очистите содержимое таблицы "chat"
    $query = "TRUNCATE TABLE chat";

    if (mysqli_query($conn, $query)) {
        echo "Содержимое таблицы 'chat' успешно очищено.";
    } else {
        echo "Ошибка при очистке таблицы 'chat': " . mysqli_error($conn);
    }

    mysqli_close($conn);
}

// Получите количество сообщений в чате
$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (!$conn) {
    die("Ошибка подключения к базе данных: " . mysqli_connect_error());
}

$query = "SELECT COUNT(*) AS message_count FROM chat";
$result = mysqli_query($conn, $query);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $messageCount = $row["message_count"];
} else {
    $messageCount = "Ошибка при получении количества сообщений.";
}

mysqli_close($conn);
?>


<html>
<body>
    <div class="opti_form">
    <p>Количество сообщений в чате: <?php echo $messageCount; ?></p>
    <p>Нажмите кнопку ниже, чтобы очистить содержимое чата.</p>
    <form method="post">
        <input type="submit" name="clear_chat" value="Очистить чат">
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
