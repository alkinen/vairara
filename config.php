<?php
//Конфигурация подключения к Базе Данных
define('DB_NAME', 'lessons');
/** Имя пользователя MySQL */
define('DB_USER', 'root');
/** Пароль к базе данных MySQL */
define('DB_PASSWORD', '');
/** Имя сервера MySQL */
define('DB_HOST', 'localhost');
/** Кодировка базы данных для создания таблиц. */
define('DB_CHARSET', 'utf8');
/** Схема сопоставления. */
define('DB_COLLATE', '');
/** Префикс таблиц в БД */
$table_prefix = 'f_';

if (!defined('MAINPATH'))
    define('MAINPATH', dirname(__FILE__) . '/');

/** Инициализирует переменные и подключает файлы. */
require_once(MAINPATH . 'core/load.php');