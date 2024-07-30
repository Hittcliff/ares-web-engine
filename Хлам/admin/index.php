<?php session_start();
include 'modules/config.php';

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
        <div class="page-announce valign-wrapper"><h1 class="page-announce-text valign">Админ панель</h1></div>
      <!-- Stat Boxes -->
      <div class="row">
              <div class="container">
                <div class="custom-responsive">
				<br>
				<center> <h3>Уважаемые  администраторы! Не трогать настройки ниже, если не знаете за что они отвечают!</h3> </center><br>
                  <table class="striped hover centered">
                    <thead><tr>
                      <th>Параметр</th>
                      <th>Статус</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Онлайн сайта (выключен / включён)</td>
                      <?php
                      if($config['offline'] == 1){
                       ?>
                    <td><a class="waves-effect waves-light btn-small" href="/engine/admin/modules/set.php?key=offline&value=0">включен</a></div></td>
                    <?php } else { ?>
                      <td><a class="waves-effect waves-light btn-small" style="background-color: red;" href="/engine/admin/modules/set.php?key=offline&value=1">выключен</a></div></td>
                    <?php } ?>
                    </tr>
                    <tr>
                      <td>Дизайн сайта (нормальный / упрощённый)</td>
                      <?php
                      if($config['beautiful'] == 1){
                       ?>
                    <td><a class="waves-effect waves-light btn-small" href="/engine/admin/modules/set.php?key=beautiful&value=0">нормальный</a></div></td>
                    <?php } else { ?>
                      <td><a class="waves-effect waves-light btn-small" style="background-color: blue;" href="/engine/admin/modules/set.php?key=beautiful&value=1">упрощённый</a></div></td>
                    <?php } ?>
                    </tr>
                    <tr>
                      <td>Авторизация (выключен / включён)</td>
                      <?
                      if($config['auth'] == 1){
                       ?>
                    <td><a class="waves-effect waves-light btn-small" href="/engine/admin/modules/set.php?key=auth&value=0">включен</a></div></td>
                    <?php } else { ?>
                      <td><a class="waves-effect waves-light btn-small" style="background-color: red;" href="/engine/admin/modules/set.php?key=auth&value=1">выключен</a></div></td>
                    <?php } ?>
                    </tr>
                    <tr>
                      <td>Чат (выключен / включён)</td>
                      <?
                      if($config['chat'] == 1){
                       ?>
                    <td><a class="waves-effect waves-light btn-small" href="/engine/admin/modules/set.php?key=chat&value=0">включен</a></div></td>
                    <?php } else { ?>
                      <td><a class="waves-effect waves-light btn-small" style="background-color: red;" href="/engine/admin/modules/set.php?key=chat&value=1">выключен</a></div></td>
                    <?php } ?>
                    </tr>
                    <tr>
                      <td>Поиск (выключен / включён)</td>
                      <?
                      if($config['search'] == 1){
                       ?>
                    <td><a class="waves-effect waves-light btn-small" href="/engine/admin/modules/set.php?key=search&value=0">включен</a></div></td>
                    <?php } else { ?>
                      <td><a class="waves-effect waves-light btn-small" style="background-color: red;" href="/engine/admin/modules/set.php?key=search&value=1">выключен</a></div></td>
                    <?php } ?>
                    </tr>
                    <tr>
                      <td>Видеофон (выключен / включён)</td>
                      <?
                      if($config['video'] == 1){
                       ?>
                    <td><a class="waves-effect waves-light btn-small" href="/engine/admin/modules/set.php?key=video&value=0">включен</a></div></td>
                    <?php } else { ?>
                      <td><a class="waves-effect waves-light btn-small" style="background-color: red;" href="/engine/admin/modules/set.php?key=video&value=1">выключен</a></div></td>
                    <?php } ?>
                    </tr>

                    <tr>
                      <td>Радио (выключен / включён)</td>
                      <?
                      if($config['radio'] == 1){
                       ?>
                    <td><a class="waves-effect waves-light btn-small" href="/engine/admin/modules/set.php?key=radio&value=0">включен</a></div></td>
                    <?php } else { ?>
                      <td><a class="waves-effect waves-light btn-small" style="background-color: red;" href="/engine/admin/modules/set.php?key=radio&value=1">выключен</a></div></td>
                    <?php } ?>
                    </tr>
                    <tr>
                      <td>Видео в профиле (выключен / включён)</td>
                      <?
                      if($config['video_profile'] == 1){
                       ?>
                    <td><a class="waves-effect waves-light btn-small" href="/engine/admin/modules/set.php?key=video_profile&value=0">включен</a></div></td>
                    <?php } else { ?>
                      <td><a class="waves-effect waves-light btn-small" style="background-color: red;" href="/engine/admin/modules/set.php?key=video_profile&value=1">выключен</a></div></td>
                    <?php } ?>
                    </tr>
                    <tr>
                      <td>Прилоадер (выключен / включён)</td>
                      <?
                      if($config['preloader'] == 1){
                       ?>
                    <td><a class="waves-effect waves-light btn-small" href="/engine/admin/modules/set.php?key=preloader&value=0">включен</a></div></td>
                    <?php } else { ?>
                      <td><a class="waves-effect waves-light btn-small" style="background-color: red;" href="/engine/admin/modules/set.php?key=preloader&value=1">выключен</a></div></td>
                    <?php } ?>
                    </tr>
                    <tr>
                      <td>Новостная лента (выключен / включён)</td>
                      <?
                      if($config['news'] == 1){
                       ?>
                    <td><a class="waves-effect waves-light btn-small" href="/engine/admin/modules/set.php?key=news&value=0">включен</a></div></td>
                    <?php } else { ?>
                      <td><a class="waves-effect waves-light btn-small" style="background-color: red;" href="/engine/admin/modules/set.php?key=news&value=1">выключен</a></div></td>
                    <?php } ?>
                    </tr>
                    <tr>
                      <td>Скролинг (стандартный / красивый)</td>
                      <?
                      if($config['scroll'] == 1){
                       ?>
                    <td><a class="waves-effect waves-light btn-small" href="/engine/admin/modules/set.php?key=scroll&value=0">включен</a></div></td>
                    <?php } else { ?>
                      <td><a class="waves-effect waves-light btn-small" style="background-color: red;" href="/engine/admin/modules/set.php?key=scroll&value=1">выключен</a></div></td>
                    <?php } ?>
                    </tr>
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
              AniJoy все права проебаны
            </div>
          </div>
        </footer>
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/materialize.min.js"></script>
        </div>
      </body>
    </html>
    <?} else {
      header("Location: /");
    }?>
