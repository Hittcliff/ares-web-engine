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
        <div class="page-announce valign-wrapper">
          <h1 class="page-announce-text valign">Список команды</h1></div>

        <!-- Stat Boxes -->
		      <div class="row">
              <div class="container">
                <div class="custom-responsive">
            <form action="save_credits.php" method="post">
              <textarea id="textEditor" name="content" rows="20" cols="80"></textarea>
              <br>
              <input type="submit" value="Сохранить"><br>
            </form>

            <script>
              // Функция для форматирования текста перед отображением в поле ввода
              function formatTextForEditor(text) {
                // Здесь вы можете добавить свой код для форматирования текста, если необходимо
                return text;
              }
              // Загрузка содержимого файла при загрузке страницы
              window.addEventListener('DOMContentLoaded', function() {
                var textEditor = document.getElementById('textEditor');
                // Загрузка содержимого из файла template/credits.php
                fetch('../../template/credits.php')
                  .then(response => response.text())
                  .then(data => {
                    // Форматирование текста перед отображением в поле ввода
                    textEditor.value = formatTextForEditor(data);
                  })
                  .catch(error => console.error('Ошибка при загрузке файла: ' + error));
              });
            </script>
			</div></div></div>
        </div>
        </div>
      </section>
    </main>
	<style>
	 /* Стили для кнопки */
    input[type="submit"] {
        background-color: #007bff; /* Цвет фона */
        color: #fff; /* Цвет текста */
        padding: 10px 20px; /* Внутренние отступы (верх и низ 10px, слева и справа 20px) */
        border: none; /* Убрать границу кнопки */
        cursor: pointer; /* Изменить курсор при наведении */
        border-radius: 5px; /* Закругленные углы */
    }

    /* Центрирование кнопки */
    form {
        text-align: center; /* Выравнивание текста по центру */
    }

    /* Отступ от кнопки */
    input[type="submit"] {
        margin-top: 5px; /* Отступ сверху 5px */
    }
	#textEditor{
	height:500px;
	weight:100%;
	resize:none;
	}
	/* Основные стили для текстовой области */
textarea {
  width: 100%;
  height: 400px;
  padding: 10px;
  font-family: monospace;
}

/* Стили для подсветки синтаксиса */
textarea.code {
  background-color: #f8f8f8;
}

/* Стили для подсветки ключевых слов */
textarea.code .keyword {
  color: #0077cc;
  font-weight: bold;
}

/* Стили для строковых литералов */
textarea.code .string {
  color: #00a000;
}

/* Стили для комментариев */
textarea.code .comment {
  color: #999;
  font-style: italic;
}

/* Стили для выделения ошибок */
textarea.code .error {
  background-color: #ffdddd;
}

/* Стили для автозавершения кода */
textarea.code .autocomplete {
  background-color: #f0f0f0;
  border-top: 1px solid #ddd;
  position: absolute;
  z-index: 1;
  max-height: 200px;
  overflow-y: auto;
}

/* Стили для выделения активного варианта автозавершения */
textarea.code .autocomplete .active {
  background-color: #0077cc;
  color: #fff;
}

/* Стили для кнопки форматирования кода */
button.format {
  background-color: #0077cc;
  color: #fff;
  border: none;
  padding: 5px 10px;
  cursor: pointer;
  margin-top: 10px;
}

	</style>
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