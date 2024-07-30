<?php
// Открываем сессию
session_start();

// Грузим настройки
$config = parse_ini_file(  '../../engine/data/config.ini' );

// Записываем настройки в переменные
$config_1 = $config['offline'];
$config_2 = $config['chat'];
$config_3 = $config['register'];
$config_4 = $config['auth'];
$config_5 = $config['search'];
$config_6 = $config['news'];
$config_7 = $config['video'];
$config_8 = $config['beautiful'];
$config_9 = $config['radio'];
$config_10 = $config['scroll'];
$config_11 = $config['preloader'];

?>
