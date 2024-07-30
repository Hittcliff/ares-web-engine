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
        <div class="page-announce valign-wrapper"><h1 class="page-announce-text valign">Список аниме</h1></div>

      <!-- Stat Boxes -->
      <div class="row">
              <div class="container">
                <div class="custom-responsive">
                  <table class="striped hover centered">
                    <thead><tr>
                      <th>ID Аниме</th>
                      <th>Название</th>
                      <th>Редактор</th>
                      <th>Ссылка</th>
                      <?php if($_SESSION['permisions'] == 1){ ?>
                          <th>Удалить</th>
                      <?php } ?>
                    </tr>
                  </thead>
                  <tbody>

                      <?php
                      // Подключаемся к базе
                      $conn = mysqli_connect($db_addr, $db_user, $db_pass, $db_name);
                      $sql = 'SELECT id, poster, name_rus, name_eng, genre, videoprev, description FROM releases ORDER BY ID DESC';
                      $result = mysqli_query($conn, $sql);
                      while ($row = mysqli_fetch_array($result)) {
                        echo  '<tr>';
                        echo  '<td>'.$row['id'].'</td>';
                        echo  '<td>'.$row['name_rus'].'</td>';
                        echo  '<td><a class="waves-effect waves-light btn-small" target="_blank" href="/anime?page='.$row['id'].'">Смотреть на сайте</a></div></td>';
                        echo  '<td><a class="waves-effect waves-light btn-small" target="_blank" href="/anime?page='.$row['id'].'&edit=1">Редактировать аниме</a></div></td>';
                        if($_SESSION['permisions'] == 2){
                          echo  '<td><a class="waves-effect waves-light btn-small" style="background-color: red;" href="rem_anime.php?id='.$row['id'].'">удалить</a></div></td>';
                        }
                        echo  '</tr>';
                      }
                       ?>

                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </section>
        </main>
        <footer class="page-footer">
          <div class="footer-copyright">
            <div class="container">
              AniJoy хули смотришь. Смотри хентай.
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
