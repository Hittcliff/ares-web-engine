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
        <div class="page-announce valign-wrapper"><h1 class="page-announce-text valign">Добавить аниме</h1></div>
      <!-- Stat Boxes -->
      <div class="row">
              <div class="container">
                <div class="custom-responsive">
                  <form id="form" class="appnitro" enctype="multipart/form-data" method="post" action="modules/functions.php">
                      <div class="form_description">
                          <h2>Добавление аниме</h2>
                          <p>Заполните поля*</p>
                      </div>
                      <ul>
                          <li id="li_1">
                              <label class="description" for="element_1">Название на английском </label>
                              <div>
                                  <input id="element_1" name="element_1" class="element text medium" type="text" maxlength="255" value="" />
                              </div>
                          </li>
                          <li id="li_2">
                              <label class="description" for="element_2">Название на русском </label>
                              <div>
                                  <input id="element_2" name="element_2" class="element text medium" type="text" maxlength="255" value="" />
                              </div>
                          </li>
                          <li id="li_3">
                              <label class="description" for="element_3">Актёры </label>
                              <div>
                                  <input id="element_3" name="element_3" class="element text medium" type="text" maxlength="255" value="" />
                              </div>
                          </li>
                          <li id="li_4">
                              <label class="description" for="element_4">Таймер </label>
                              <div>
                                  <input id="element_4" name="element_4" class="element text medium" type="text" maxlength="255" value="" />
                              </div>
                          </li>
                          <li id="li_5">
                              <label class="description" for="element_5">Жанры </label>
                              <div>
                                  <input id="element_5" name="element_5" class="element text medium" type="text" maxlength="255" value="" />
                              </div>
                          </li>
                          <li id="li_12">
                                      <label class="description" for="element_12">Рейтинг (возрастное ограничение)</label>
                                      <div>
                                          <input id="element_12" name="element_12" class="element text medium" />
                                  </div>
                            </li>
                   <li id="li_9">
                              <label class="description" for="element_9">Ссылка на Kodik </label>
                              <div>
                                  <input id="element_9" name="element_9" class="element text medium" type="text" maxlength="655" value="" />
                              </div>
                          </li>
                  <li id="li_8">
                              <label class="description" for="element_8">Описание</label>
                              <div>
                                  <textarea id="element_8" name="element_8" class="element textarea medium"></textarea>
                              </div>
                          </li>
                          <li id="li_6">
                              <label class="description" for="element_6">Код для вставки видеоплеера </label>
                              <div>
                                  <textarea id="element_6" name="element_6" class="element textarea medium"></textarea>
                              </div>
                          </li>
                          <li id="li_7">
                              <label class="description" for="element_7">Постер </label>
                              <div>
                                  <input id="element_7" name="file" class="element file" type="file" />
                              </div>
                          </li><br>
                          <label class="description" for="element_7">Скриншоты для аниме: </label><br>
                          <input type="file" id="file">
                          <div id="upload_img">Загрузить изображение</div>
                          <div id="progress"></div>
                          <br><br><br>
                          <center>
                          <li class="buttons">
                              <input type="hidden" name="form_id" value="45869" />
                              <input id="saveForm" class="button_text" type="submit" name="submit" value="Загрузить аниме" />
                          </li>
                        </center>
                      </ul>
                  </form>

                  <style media="screen">
                  progress {
                      width: 100%;
                      height: 20px;
                  }
                  #upload_img {
                    background-color: #4CAF50;
                    border: none;
                    color: white;
                    padding: 10px 20px;
                    text-align: center;
                    text-decoration: none;
                    display: inline-block;
                    font-size: 12px;
                    margin: 4px 2px;
                    cursor: pointer;
                  }
                  </style>
                  <script type="text/javascript" src="../../template/js/jquery.js"></script>
                  <script type="text/javascript">
                  $(document).ready(function() {
                      $('#upload_img').click(function() {
                          var file_data = $('#file').prop('files')[0];
                          var form_data = new FormData();
                          form_data.append('file', file_data);
                          $.ajax({
                              url: 'modules/screenshot.php?id=1',
                              type: 'POST',
                              xhr: function() {
                                  var xhr = new window.XMLHttpRequest();
                                  xhr.upload.addEventListener("progress", function(evt) {
                                      if (evt.lengthComputable) {
                                          var percentComplete = evt.loaded / evt.total;
                                          percentComplete = parseInt(percentComplete * 100);
                                          $('#progress').html('<progress value="' + percentComplete + '" max="100">' + percentComplete + '%</progress>');
                                      }
                                  }, false);
                                  return xhr;
                              },
                              success: function(data) {
                                  $('#progress').html(data);
                              },
                              data: form_data,
                              cache: false,
                              contentType: false,
                              processData: false
                          });
                      });
                  });
                  </script>
              </div>
            </div>
          </div>
        </section>
        </main>
        <footer class="page-footer">
          <div class="footer-copyright">
            <div class="container">
              AniJoy ваша реклама, наша жратва.
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
