<?php

//require "../config.php";
class DB_CONNECTION extends DB_CONFIG
{
    function checkDBconnection($dbconfig->DB_HOST, $DB_NAME, $DB_USER, $DB_PASSWORD)//Метод проверки подключения.
{
    try {
        //Устанавливаем подключение к БД.
        $conn = new PDO("mysql:host=DB_HOST;dbname=DB_NAME;charset=utf8", DB_USER, DB_PASS);
        // Устанавливаем режим перехвата ошибок для PDO.
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Соединение с БД успешно.";
    } catch (PDOException $e) {
        echo "Ошибка соединение с БД: " . $e->getMessage();
    }
    $conn = null; //Закрываем соединение с БД.
}

function createDB(DB_HOST, DB_NAME, $DB_USER, $DB_PASS)//Метод создания БД.
{
    try {
        //Устанавливаем подключение к БД.
        $conn = new PDO("mysql:host=DB_HOST;dbname=DB_NAME;charset=utf8", $DB_USER, $DB_PASS);
        // Устанавливаем режим перехвата ошибок для PDO.
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "CREATE DATABASE DB_NAME"; // Создаем БД с именем DB_NAME.
        // Используем exec(), без него не вернеться результат (result).
        $conn->exec($sql);
        echo "База данных успешно создана.<br>";
    } catch (PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }
    $conn = null;//Закрываем соединение с БД.
}

function createTables(DB_HOST, DB_NAME, $DB_USER, $DB_PASS)//Метод создания таблиц БД.
{
    try {
        //Устанавливаем подключение к БД.
        $conn = new PDO("mysql:host=DB_HOST;dbname=DB_NAME;charset=utf8", $DB_USER, $DB_PASS);
        // Устанавливаем режим перехвата ошибок для PDO.
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // SQL запрос для создания таблицы (users).
        $sql = "CREATE TABLE users (
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

/*  Вызовы методов  */

//checkDBconnection(DB_HOST, DB_NAME, $DB_USER, $DB_PASS);//Вызов метода проверки подключения.
//createDB(DB_HOST, DB_NAME, $DB_USER, $DB_PASS);//Вызов метода создания БД.
//createTables(DB_HOST, DB_NAME, $DB_USER, $DB_PASS);//Вызов метода создания таблиц БД.
//registrationInsert(DB_HOST, DB_NAME, $DB_USER, $DB_PASS, $TABLE_NAME, $TABLE_FIELDS, $TABLE_DATA);//Вызов метода добавления данных в таблицу(регистрация).
//mySqlInsert(DB_HOST, DB_NAME, $DB_USER, $DB_PASS, $TABLE_NAME, $TABLE_FIELDS, $TABLE_DATA);//Метод добавления данных в таблицу.
//mySqlSelect(DB_HOST, DB_NAME, $DB_USER, $DB_PASS);Метод выборки данных с таблиц.
}