<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Добавление аниме</title>
    <link rel="stylesheet" type="text/css" href="view.css" media="all">
</head>

<body id="main_body">
    <div id="form_container">
        <h1><a>Добавление аниме</a></h1>
        <form id="form" class="appnitro" enctype="multipart/form-data" method="post" action="">
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
                    <label class="description" for="element_4">Таймеры </label>
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
                <li id="li_6">
                    <label class="description" for="element_6">Код для вставки видеоплеера </label>
                    <div>
                        <textarea id="element_6" name="element_6" class="element textarea medium"></textarea>
                    </div>
                </li>
                <li id="li_7">
                    <label class="description" for="element_7">Постер </label>
                    <div>
                        <input id="element_7" name="element_7" class="element file" type="file" />
                    </div>
                </li>

                <li class="buttons">
                    <input type="hidden" name="form_id" value="45869" />
                    <input id="saveForm" class="button_text" type="submit" name="submit" value="Загрузить" />
                </li>
            </ul>
        </form>
    </div>
</body>
</html>