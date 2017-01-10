<?php
include('config.php');

class DB_CONN
{
    public function checkDBconnection($db_host, $db_name, $db_user, $db_password, $db_charset)//Метод проверки подключения.
{
    try {
        //Устанавливаем подключение к БД.
        $conn = new PDO("mysql:host=$db_host;dbname=$db_name;charset=$db_charset", $db_user, $db_password);
        // Устанавливаем режим перехвата ошибок для PDO.
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Соединение с БД успешно. <br>";
    } catch
    (PDOException $e) {
        echo "Ошибка соединение с БД: " . $e->getMessage() . " <br>";
    }
    $conn = null; //Закрываем соединение с БД.
}

    public function selectFunction($db_host, $db_name, $db_user, $db_password, $db_charset)//Метод проверки подключения.
    {
        try {
            //Устанавливаем подключение к БД.
            $conn = new PDO("mysql:host=$db_host;dbname=$db_name;charset=$db_charset", $db_user, $db_password);
            // Устанавливаем режим перехвата ошибок для PDO.
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->query('SELECT * from users');
            return $rows = $stmt->fetchAll();
        } catch
        (PDOException $e) {
            echo "Ошибка соединение с БД: " . $e->getMessage() . " <br>";
        }
        $conn = null; //Закрываем соединение с БД.
    }

    /*
//Простые запросы
$db->query("SET CHARACTER SET utf8");
$db->query("SELECT * FROM users");

//Можно вычислить количество строк
$stmt = $db->query('SELECT * FROM table');
$row_count = $stmt->rowCount();
echo $row_count.' rows selected';

//Еще вариант с количеством
$stmt = $db->query('SELECT * from users');
$rows = $stmt->fetchAll();
$count = count($rows);
foreach($rows as $row)
{
print_r($row);
}
//Запрос с условием и экранированием
$conn->query('SELECT * FROM table WHERE id = ' . $conn->quote($id));
*/
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
        echo $sql . "<br>" . $e->getMessage() . " <br>";
    }
    $conn = null;//Закрываем соединение с БД.

}


    public function createTables($db_host, $db_name, $db_user, $db_password, $db_charset)//Метод создания таблиц БД.
{
    try {
        //Устанавливаем подключение к БД.
        $conn = new PDO("mysql:host=$db_host;dbname=$db_name;charset=$db_charset", $db_user, $db_password);
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
        echo $sql . "<br>" . $e->getMessage() . " <br>";
    }
    $conn = null;//Закрываем соединение с БД.

}
}

$db_conn = new DB_CONN();
//$conn->STH->rowCount() > 0;
//$db_conn->checkDBconnection($db_host, $db_name, $db_user, $db_password, $db_charset);
//$db_conn->createDB($db_host, $db_name, $db_user, $db_password, $db_charset);
//$db_conn->createTables($db_host, $db_name, $db_user, $db_password, $db_charset);

/*  Вызовы методов  */

//checkDBconnection($db_host, $db_name, $db_user, $db_password, $db_charset);//Вызов метода проверки подключения.
//createDB(DB_HOST, DB_NAME, $DB_USER, $DB_PASS);//Вызов метода создания БД.
//createTables(DB_HOST, DB_NAME, $DB_USER, $DB_PASS);//Вызов метода создания таблиц БД.
//registrationInsert(DB_HOST, DB_NAME, $DB_USER, $DB_PASS, $TABLE_NAME, $TABLE_FIELDS, $TABLE_DATA);//Вызов метода добавления данных в таблицу(регистрация).
//mySqlInsert(DB_HOST, DB_NAME, $DB_USER, $DB_PASS, $TABLE_NAME, $TABLE_FIELDS, $TABLE_DATA);//Метод добавления данных в таблицу.
//mySqlSelect(DB_HOST, DB_NAME, $DB_USER, $DB_PASS);Метод выборки данных с таблиц.
