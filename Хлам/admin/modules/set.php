<?php

function config($key, $value) {
    // Путь к файлу конфигурации ini
    $configFile = '../../../engine/data/config.ini';

    // Загрузка содержимого файла конфигурации в ассоциативный массив
    $config = parse_ini_file($configFile, true);

    // Изменение параметра
    foreach ($config as $sectionName => $section) {
        if (array_key_exists($key, $section)) {
            $config[$sectionName][$key] = $value;
            break;
        }
    }

    // Преобразование массива обратно в строку формата ini
    $newConfigString = '';
    foreach ($config as $sectionName => $section) {
        $newConfigString .= "[$sectionName]\n";
        foreach ($section as $key => $value) {
            $newConfigString .= "$key = $value\n";
        }
    }

    // Запись обновленной строки в файл конфигурации
    file_put_contents($configFile, $newConfigString);
}
if(isset($_GET['key']) and isset($_GET['value'])){
	config($_GET['key'], $_GET['value']);
}
header("Location: ".$_SERVER['HTTP_REFERER']);
?>
