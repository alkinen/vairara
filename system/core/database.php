<?php

class Database extends PDO
{
    //public function __construct()
    //{
    //parent::__construct('mysql:host=localhost;dbname=lessons', 'root', '');
    //}
    public function checkDBconnection($db_host, $db_name, $db_user, $db_password, $db_charset)//Метод проверки подключения.
    {
        try {
            //Устанавливаем подключение к БД.
            $conn = new PDO("mysql:host=$db_host;dbname=$db_name;charset=$db_charset", $db_user, $db_password);
            // Устанавливаем режим перехвата ошибок для PDO.
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Соединение с БД успешно.";
        } catch
        (PDOException $e) {
            echo "Ошибка соединение с БД: " . $e->getMessage();
        }
        $conn = null; //Закрываем соединение с БД.
    }

    function createDB($db_host, $db_name, $db_user, $db_password, $db_charset)//Метод создания БД.
    {
        try {
            //Устанавливаем подключение к БД.
            $conn = new PDO("mysql:host=$db_host;dbname=$db_name;charset=$db_charset", $db_user, $db_password);
            // Устанавливаем режим перехвата ошибок для PDO.
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "CREATE DATABASE $db_name"; // Создаем БД с именем DB_NAME.
            // Используем exec(), без него не вернеться результат (result).
            $conn->exec($sql);
            echo "База данных успешно создана.<br>";
        } catch (PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
        $conn = null;//Закрываем соединение с БД.
    }

    function createTables($db_host, $db_name, $db_user, $db_password, $db_charset, $table_prefix)//Метод создания таблиц БД.
    {
        try {
            //Устанавливаем подключение к БД.
            $conn = new PDO("mysql:host=$db_host;dbname=$db_name;charset=$db_charset", $db_user, $db_password);
            // Устанавливаем режим перехвата ошибок для PDO.
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // SQL запрос для создания таблицы (users).
            $sql = "CREATE TABLE $table_prefix . users (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    login VARCHAR(30) NOT NULL UNIQUE,
    password VARCHAR(30) NOT NULL,
    email VARCHAR(50) NOT NULL UNIQUE,
    reg_date TIMESTAMP
    )";
            // Используем exec(), без него не вернеться результат (result).
            $conn->exec($sql);
            echo "Таблица users успешно создана.<br>";
        } catch (PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
        $conn = null;//Закрываем соединение с БД.
    }

}

$database = new Database('mysql:host=localhost;dbname=lessons', 'root', '');

//https://myrusakov.ru/php-osnovy.html
//http://www.php.su/functions/?cat=pdo
//http://www.php.su/functions/?pdo-construct