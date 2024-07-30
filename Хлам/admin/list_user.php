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
        <div class="page-announce valign-wrapper"><h1 class="page-announce-text valign">Список пользователей сайта</h1></div>

      <!-- Stat Boxes -->
      <div class="row">
              <div class="container">
                <div class="custom-responsive">
                  <table class="striped hover centered">
                    <thead><tr>
                      <th>ID пользователя</th>
                      <th>Реальное имя</th>
                      <th>Ник на сайте</th>
                      <th>Почта</th>
                      <th>Права доступа</th>
                      <th>Бан</th>
                      <th>Аватар</th>
                    </tr>
                  </thead>
                  <tbody>

                      <?php
                      // Подключаемся к базе
                      $conn = mysqli_connect($db_addr, $db_user, $db_pass, $db_name);
                      $sql = 'SELECT id, email, name, permisions, realname, avatar, ban_status FROM users ORDER BY ID';
                      $result = mysqli_query($conn, $sql);
					  echo '<br><center><b>Общие количество пользователей сайта на 27.09.23 (30) : Сейчас : ' . mysqli_num_rows($result) . '<b><center><br>';
                      while ($row = mysqli_fetch_array($result)) {
                        if($row['name'] != "Hittcliff"){
                        echo  '<tr>';
                        echo  '<td>'.$row['id'].'</td>';
                        echo  '<td>'.$row['realname'].'</td>';
                        echo  '<td>'.$row['name'].'</td>';
                        echo  '<td>'.$row['email'].'</td>';
                        if($row['permisions'] == 2){
                          echo '<td style="color:red;">Создатель</td>';
                        } elseif($row['permisions'] == 1){
                          echo '<td>Администратор</td>';
                        } elseif($row['permisions'] == 0){
                          echo '<td>Пользователь</td>';
                        }

                        if($row['ban_status'] == 0){?>
                          <td><a class="waves-effect waves-light btn-small" style="background-color: red;" href="/engine/admin/ban_set.php?id=<?echo $row['id'];?>&ban=1">забанить</a></div></td>
                       <?php } else { ?>
                          <td><a class="waves-effect waves-light btn-small" style="background-color: blue;" href="/engine/admin/ban_set.php?id=<?echo $row['id'];?>&ban=0">разбанить</a></div></td>
                       <?php }

                        echo  '<td><img src="'.$row['avatar'].'" style="border-radius:60px;width:64px;height:64px;"></td>';
                        echo  '</tr>';
                        }
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
