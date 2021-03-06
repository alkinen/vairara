<?php

class Model
{
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

    public function selectFunction($db_host, $db_name, $db_user, $db_password)//Метод создания БД.
    {
        try {
            //Устанавливаем подключение к БД.
            $conn = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8", $db_user, $db_password);
            // Устанавливаем режим перехвата ошибок для PDO.
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //$sql = "SELECT * FROM users ORDER BY login";
            //$conn->exec($sql);
            $sql = $conn->query('SELECT * from users ORDER BY login');
            $rows = $sql->fetchAll();
            return $rows;
            //echo "База данных успешно создана.<br>";
        } catch (PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
        $conn = null;//Закрываем соединение с БД.
    }

    public function createDB($db_host, $db_name, $db_user, $db_password, $db_charset)//Метод создания БД.
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

    // метод выборки данных
    public function get_data()
    {
        // todo
    }
}