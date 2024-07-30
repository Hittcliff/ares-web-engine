<!--/nav-->
<nav class="navbar navbar-expand-lg navbar-light fill px-lg-0 py-0 px-3">
  <div class="container">
    <a class="navbar-brand anipre" href="/">ANI<span>JOY</span> </a>

    <button class="navbar-toggler collapsed" type="button" data-toggle="collapse"
      data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
      aria-label="Toggle navigation">
      <span class="fa icon-expand fa-bars"></span>
      <span class="fa icon-close fa-times"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto">
      <li class="nav-item"><a class="nav-link anipre" href="about">О нас</a></li>
      <li class="nav-item"><a class="nav-link anipre" href="https://vk.com/anijoy_tv?w=app6471849_-215540377">Поддержать нас</a></li>
      </ul>

      <!--/search-right-->
      <!--/search-right-->
      <div class="search-right">
        <a href="#search" class="btn search-hny mr-lg-3 mt-lg-0 mt-4" title="search">Поиск <span
            class="fa fa-search ml-3" aria-hidden="true"></span></a>
        <!-- search popup -->
        <div id="search" class="pop-overlay">
          <div class="popup">
            <form action="search" method="get" class="search-box">
              <input type="search" placeholder="Чего изволите?" name="animename" required="required" autofocus="">
              <button type="submit" class="btn"><span class="fa fa-search"
                  aria-hidden="true"></span></button>
            </form>
            <div class="browse-items">
              <!-- <h3 class="hny-title two mt-md-5 mt-4">Показать все:</h3> -->
              <br>
              <ul class="search-items">
                <li><a href="search?genre=Драма">Драма</a></li>
                <li><a href="search?genre=Семейный">Семейный</a></li>
                <li><a href="search?genre=Триллер">Триллер</a></li>
                <li><a href="search?genre=Комедия">Комедия</a></li>
                <li><a href="search?genre=Романтика">Романтика</a></li>
                <li><a href="search?genre=ТВ-шоу">ТВ-шоу</a></li>
                <li><a href="search?genre=Ужасы">Ужасы</a></li>
              </ul>
            </div>
          </div>
          <a class="close" href="#close">×</a>
        </div>
        <!-- /search popup -->
        <!--/search-right-->
      </div>


    </div>
    <!-- toggle switch for light and dark theme -->
    <div class="mobile-position">
      <nav class="navigation">
        <div class="theme-switch-wrapper">
          <label class="theme-switch" for="checkbox">
            <input type="checkbox" id="checkbox">
            <div class="mode-container">
              <i class="gg-sun"></i>
              <i class="gg-moon"></i>
            </div>
          </label>
        </div>
      </nav>
    </div>
    <!-- //toggle switch for light and dark theme -->
    <div class="profile_icon_nav">
      <input type="checkbox" id="profile_dropdown_toggle">
      <label for="profile_dropdown_toggle" class="profile_dropdown_trigger">
        <div class="profile_status_online"></div>
        <img src="template/avatar/Hittcliff.jpg" class="icon_profile" alt="">
      </label>
      <ul class="profile_dropdown_menu">
        <li><a href="/admin/index.php">Админ панель</a></li>
        <li><a href="#">Профиль</a></li>
        <li><a href="#">Выход</a></li>
      </ul>
    </div>
  </div>
</nav>
<!--//nav-->
