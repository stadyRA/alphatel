<?php
define('HOST', 'localhost');
define('DB', 'alfa_db');
define('USER', 'root');
define('PASS', '');

if (! defined ( 'BOOST' )) { exit ( "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" /> Эй, не озоруй. К данному файлу я тебе запрещаю прямой доступ. Теперь-то мне ясно, кто ковыряет мой сайт." ); }

# Часовой пояс
date_default_timezone_set('Europe/Moscow');

# Классы
require_once "include/engine.php";
require_once "classes/DB.class.php";
require_once "classes/UserTools.class.php";


?>