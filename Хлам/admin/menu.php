    <ul id="slide-out" class="side-nav fixed z-depth-4">
      <li>
        <div class="userView">
          <a href="#!user"><img class="circle" src="<?php echo $_SESSION['avatar']; ?>" ></a>
          <a href="#!name"><span class="white-text name">Привет, </span></a>
          <a href="#!email"><span class="white-text email"><?php echo $_SESSION["name"]; ?></span></a>
        </div>
      </li>

      <li><a class="active" href="index.php"><i class="material-icons pink-item">dashboard</i>Гланая страница</a></li>
      
      <li><a class="active" href="/"><i class="material-icons purple-item">exit_to_app</i>Назад на сайт AniJoy</a></li>

      <li><div class="divider"></div></li>

      <li><a class="subheader">Дополнительно</a></li>
      <li><a class="active" href="list_user.php"><i class="material-icons pink-item">person</i>Настройка пользователей</a></li>
	  <li><a class="active" href="credits_edit.php"><i class="material-icons pink-item">diversity_1</i>Список команды</a></li>

      <li><a class="subheader">Аниме настройки</a></li>
      <li><a class="active" href="add_anime.php"><i class="material-icons pink-item">add_circle</i>Добавить аниме</a></li>
      <li><a class="active" href="list_anime.php"><i class="material-icons pink-item">format_list_bulleted</i>Список аниме</a></li>
	  
	  <li><a class="subheader">Оптимизация сайта</a></li>
	  <li><a class="active" href="otimizaition.php"><i class="material-icons pink-item">compare</i>Сжатие постеров</a></li>
	  <li><a class="active" href="chat_clear.php"><i class="material-icons pink-item">forum</i>Очистка чата</a></li>
	  <li><a class="active" href="comments_list.php"><i class="material-icons pink-item">rate_review</i>Список коментариев</a></li>
    </ul>