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
	<style>
	.text_comments{
	margin:0;
	white-space: nowrap;
	float:left;
}
	</style>

    <main>
      <section class="content">
        <div class="page-announce valign-wrapper"><h1 class="page-announce-text valign">Удаление комментариев</h1></div>

      <!-- Stat Boxes -->
      <div class="row">
              <div class="container">
                <div class="custom-responsive">
<?php

// Проверка подключения
if (!$conn) {
    die("Ошибка подключения к базе данных: " . mysqli_connect_error());
}

// Запрос для извлечения комментариев и связанных с ними аниме
$sql = "SELECT c.id, c.nick, c.message, c.idnews, r.name_rus FROM comments c
        LEFT JOIN releases r ON c.idnews = r.id
        ORDER BY c.idnews, c.id";

$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Ошибка выполнения запроса: " . mysqli_error($conn));
}

$animeName = ""; // Переменная для хранения текущего аниме
?>

<!DOCTYPE html>
<html lang="en">
<body>

<div class="opti_form">
    <?php
while ($row = mysqli_fetch_assoc($result)) {
    $id = $row['id'];
    $nick = $row['nick'];
    $message = $row['message'];
    $anime = $row['name_rus'];

    // Если текст комментария не пустой, выводим его
    if (!empty($message)) {
        // Если текущее аниме отличается от предыдущего, выводим его имя
        if ($anime != $animeName) {
            echo "<hr><b><h5>$anime</h5></b>";
            $animeName = $anime;
        }

        // Выводим комментарий и кнопку удаления
        echo "<div>";
        echo "<p><strong>$nick  Написал: $message </strong></p>";
        echo "<button onclick=\"deleteComment($id)\">Удалить</button>";
        echo "</div>";
    }
}
    ?>
</div>
    <script>
        function deleteComment(commentId) {
            // Отправляем запрос на удаление комментария с помощью AJAX
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "delete_comment.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Обновляем страницу после успешного удаления
                    location.reload();
                }
            };
            xhr.send("comment_id=" + commentId);
        }
    </script>
</body>
</html>

<?php
// Закрываем соединение с базой данных
mysqli_close($conn);
?>



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
