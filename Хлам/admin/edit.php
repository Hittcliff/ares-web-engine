<?php session_start(); ?>
<?php if($_SESSION['permisions'] > 1){ ?>
  <!DOCTYPE html>
  <html>
  <head>
    <meta charset="UTF-8">
    <title>Редактор <?php echo $data['name_rus']; ?></title>
    <style>
    .table-container {
      width: 100%;
      height: 100%;
      overflow: auto;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      border-spacing: 0;
    }
    tbody{
      color:#fff;
    }
    th, td {
      padding: 10px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }
    th {
      background-color: #f2f2f2;
      font-weight: bold;
    }
    textarea {
      width: 100%;
      height: 150px;
      box-sizing: border-box;
      padding: 5px;
      border: none;
      resize: none; /* блокировка изменения размеров */
    }
    .movie-image_img_edit {
      width: 15%;
      height: auto;
    }
    .exit_edit {
      display: flex;
      justify-content: center;
      align-items: center;
      width: 200px;
      height: 50px;
      background-color: #4CAF50;
      color: white;
      font-size: 18px;
      font-weight: bold;
      border-radius: 5px;
      cursor: pointer;
      margin: auto; /* добавлено */
      transition: 0.3s;
    }

    .exit_edit:hover {
      background-color: #3e8e41;
    }
    </style>
  </head>
  <body>
    <div class="table-container">
      <table>
        <thead>
          <tr>
            <th>Функция</th>
            <th>Значение</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Постер</td>
            <td><img src="template/posters/<?php echo $data['poster']; ?>.jpg" class="movie-image_img_edit" alt="Movie Poster"></td>
          </tr>
          <tr>
            <td>ID Новости</td>
            <td><textarea disabled id="id"><?php echo $data['id']; ?></textarea></td>
            <input type="hidden" id="movie_id" value="<?php echo $data['id']; ?>">
          </tr>
          <tr>
            <td>Название на русском</td>
            <td><textarea id="name_rus"><?php echo $data['name_rus']; ?></textarea></td>
          </tr>
          <tr>
            <td>Название на английском</td>
            <td><textarea id="name_eng"><?php echo $data['name_eng']; ?></textarea></td>
          </tr>
          <tr>
            <td>Роли озвучивали</td>
            <td><textarea id="voice"><?php echo $data['voice']; ?></textarea></td>
          </tr>
          <tr>
            <td>Состояние</td>
            <td><select id="status" name="status">
              <option value="Продолжается">Продолжается</option>
              <option value="Завершен">Завершен</option>
              <option value="Отменен">Отменен</option>
              <option value="Ожидается">Ожидается</option>
              <option value="Приостановлен">Приостановлен</option>
              <option value="В обработке">В обработке (скрыть от пользователей)</option>
            </select></td>
          </tr>
          <tr>
            <td>Жанры</td>
            <td><textarea id="genre"><?php echo $data['genre']; ?></textarea></td>
          </tr>
          <tr>
            <td>Описание</td>
            <td><textarea id="description"><?php echo $data['description']; ?></textarea></td>
          </tr>
          <tr>
            <td>Плеер</td>
            <td><textarea id="videocode"><?php echo $data['videocode']; ?></textarea></td>
          </tr>
          <!-- Добавьте сколько угодно строк -->
        </tbody>
      </table>
      <br>
      <center><h7 style="color:#fff;opacity:0.6;">** все изменения меняются на лету **</h7></center><br>
      <a href="anime?page=<?echo $_GET['id']?>" class="exit_edit">Выйти из редактора</a>
      <br><br><br><br><br><br><br><br>
    </div>
  </body>
  </html>
<?php } else {
  header("Location: anime?page=" . $_GET['id']);
} ?>
