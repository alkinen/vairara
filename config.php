<?php

class DB_CONFIG
{
    /** Имя базы данных */
    const DB_NAME = "lessons";
    /** Имя пользователя MySQL */
    const DB_USER = "root";
    /** Пароль к базе данных MySQL */
    const DB_PASSWORD = "";
    /** Имя сервера MySQL */
    const DB_HOST = "localhost";
    /** Кодировка базы данных для создания таблиц. */
    const DB_CHARSET = "utf8";
    /** Схема сопоставления. */
    const DB_COLLATE = "utf8_general_ci";
    /** Префикс таблиц в БД */
    private $table_prefix = 'f_';

}

$dbconfig = new DB_CONFIG();

echo $dbconfig::DB_NAME;
echo $this->DB_NAME;