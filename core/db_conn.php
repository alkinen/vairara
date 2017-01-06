<?php
require("config.php");
function checkDBconnection($DB_HOST, $DB_NAME, $DB_USER, $DB_PASS)//Метод проверки подключения.
{
    try {
        //Устанавливаем подключение к БД.
        $conn = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME;charset=utf8", $DB_USER, $DB_PASS);
        // Устанавливаем режим перехвата ошибок для PDO.
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Соединение с БД успешно.";
    } catch (PDOException $e) {
        echo "Ошибка соединение с БД: " . $e->getMessage();
    }
    $conn = null; //Закрываем соединение с БД.
}

function createDB($DB_HOST, $DB_NAME, $DB_USER, $DB_PASS)//Метод создания БД.
{
    try {
        //Устанавливаем подключение к БД.
        $conn = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME;charset=utf8", $DB_USER, $DB_PASS);
        // Устанавливаем режим перехвата ошибок для PDO.
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "CREATE DATABASE $DB_NAME"; // Создаем БД с именем $DB_NAME.
        // Используем exec(), без него не вернеться результат (result).
        $conn->exec($sql);
        echo "База данных успешно создана.<br>";
    } catch (PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }
    $conn = null;//Закрываем соединение с БД.
}

function createTables($DB_HOST, $DB_NAME, $DB_USER, $DB_PASS)//Метод создания таблиц БД.
{
    try {
        //Устанавливаем подключение к БД.
        $conn = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME;charset=utf8", $DB_USER, $DB_PASS);
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

function registrationInsert($DB_HOST, $DB_NAME, $DB_USER, $DB_PASS, $TABLE_NAME, $TABLE_FIELDS, $TABLE_DATA)//Метод добавление данных в таблицу(регистрация).
{
    try {
        $TABLE_NAME = "users";
        $TABLE_FIELDS = array('login', 'password', 'email');
        $tableFields_sorted = implode(", ", $TABLE_FIELDS);
        //Устанавливаем подключение к БД.
        $conn = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME;charset=utf8", $DB_USER, $DB_PASS);
        // Устанавливаем режим перехвата ошибок для PDO.
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $TABLE_DATA = array
        (
            "login" => "'AgressoRTM'",
            "password" => "'1234567890'",
            "email" => "'help@twog.pp.ua'"
        );
        $tableData_sorted = implode(", ", $TABLE_DATA);
        // SQL запрос для добавления данных в таблицу.
        $sql = "INSERT INTO $TABLE_NAME ($tableFields_sorted)
    VALUES ($tableData_sorted)";
        // Используем exec(), без него не вернеться результат (result).
        $conn->exec($sql);
        $last_id = $conn->lastInsertId();
        echo "Запись успешно добавлена в таблицу БД. Последний, добавленный ID: " . $last_id;
    } catch (PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }

    $conn = null;//Закрываем соединение с БД.
}

function mySqlInsert($DB_HOST, $DB_NAME, $DB_USER, $DB_PASS, $TABLE_NAME, $TABLE_FIELDS, $TABLE_DATA)//Метод добавление данных в таблицу группой.
{
    try {
        $TABLE_NAME = "users";
        //Устанавливаем подключение к БД.
        $conn = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME;charset=utf8", $DB_USER, $DB_PASS);
        // Устанавливаем режим перехвата ошибок для PDO.
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // Подготавливаем SQL запрос для добавления данных в таблицу.
        $stmt = $conn->prepare("INSERT INTO $TABLE_NAME (login, password, email)
    VALUES (:login, :password, :email)");
        $stmt->bindParam(':login', $login);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':email', $email);

        // Добавляем первый ряд.
        $login = "John";
        $password = "Doe";
        $email = "john@example.com";
        $stmt->execute();

        // Добавляем второй ряд.
        $login = "Mary";
        $password = "Moe";
        $email = "mary@example.com";
        $stmt->execute();

        // Добавляем третий ряд.
        $login = "Julie";
        $password = "Dooley";
        $email = "julie@example.com";
        $stmt->execute();

        echo "Новые записи успешно добавлены.";
    } catch (PDOException $e) {
        echo "Ошибка: " . $e->getMessage();
    }
    $conn = null;
}

/*
function mySqlSelect($DB_HOST, $DB_NAME, $DB_USER, $DB_PASS){

    class TableRows extends RecursiveIteratorIterator {

    }
    try {
        //Устанавливаем подключение к БД.
        $conn = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME;charset=utf8", $DB_USER, $DB_PASS);
        // Устанавливаем режим перехвата ошибок для PDO.
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT id, login, password FROM users");
        $stmt->execute();

        // set the resulting array to associative
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        foreach($stmt->fetchAll() as $k=>$v) {
        }
    }
    catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conn = null;
}*/

/*  Вызовы методов  */

//checkDBconnection($DB_HOST, $DB_NAME, $DB_USER, $DB_PASS);//Вызов метода проверки подключения.
//createDB($DB_HOST, $DB_NAME, $DB_USER, $DB_PASS);//Вызов метода создания БД.
//createTables($DB_HOST, $DB_NAME, $DB_USER, $DB_PASS);//Вызов метода создания таблиц БД.
//registrationInsert($DB_HOST, $DB_NAME, $DB_USER, $DB_PASS, $TABLE_NAME, $TABLE_FIELDS, $TABLE_DATA);//Вызов метода добавления данных в таблицу(регистрация).
//mySqlInsert($DB_HOST, $DB_NAME, $DB_USER, $DB_PASS, $TABLE_NAME, $TABLE_FIELDS, $TABLE_DATA);//Метод добавления данных в таблицу.
//mySqlSelect($DB_HOST, $DB_NAME, $DB_USER, $DB_PASS);Метод выборки данных с таблиц.
?>