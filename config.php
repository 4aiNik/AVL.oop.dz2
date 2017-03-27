<?php
//настройки БД
define('HOST', 'localhost');
define('USER', 'root');
define('PASS', '');
define('DB', 'oop');

//определение путей
//корневая папка
define('DIR', pathinfo($_SERVER['SCRIPT_FILENAME'],PATHINFO_DIRNAME ));
//используемый протокол
define('SCHEME', is_null($_SERVER['REQUEST_SCHEME']) ? 'http' : $_SERVER['REQUEST_SCHEME'] . '://');
//имя сервера (домена)
define('SERVER', $_SERVER['SERVER_NAME'] . '/');
//информация о поддомене
define('SUBSERVER', str_replace('/index.php', '', $_SERVER['SCRIPT_NAME'] . '/'));
//базовая часть адреса
define('BASE', str_replace('//', '/', SERVER . SUBSERVER));
//путь к корню ресурса
define('MAIN', SCHEME . BASE);
define('IS_AJAX', isset($_SERVER['HTTP_X_REQUESTED_WITH']));

//основная секция
define('MODEL',      DIR  . 'model/');
define('CONTROLLER', DIR  . 'controller/');
define('VIEW',       DIR  . '/view/');
define('CSS',        MAIN . 'css/');
define('JS',         MAIN . 'js/');
define('IMG',        MAIN . 'img/');
define('FAVIC',      MAIN . 'favicon/');
define('FONT',       MAIN . 'fonts/');
define('AJAX',       MAIN . 'ajax/');
define('LOG',        DIR  . 'log/');
define('USERFILES',  MAIN . 'userfiles/');
define('DIRFILES',   DIR  . 'userfiles/');

//установка русской локали и московского времени
setlocale(LC_ALL, 'rus_rus');
date_default_timezone_set('Europe/Moscow');

// echo 'DIR ' . DIR .'<br>';
// echo 'SCHEME ' . SCHEME .'<br>';
// echo 'SERVER ' . SERVER .'<br>';
// echo 'SUBSERVER ' . SUBSERVER .'<br>';
// echo 'BASE ' . BASE .'<br>';
// echo 'MAIN ' . MAIN .'<br>';