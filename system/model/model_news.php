<?php

class Model_News extends Model
{

    public function get_data()
    {   //$db_host, $db_name, $db_user, $db_password, $db_charset
        $this->selectFunction('localhost', 'lessons', 'root', '');
    }
}
//http://php.net/manual/ru/class.pdo.php
//http://php.net/manual/ru/pdo.query.php
//http://php.net/manual/ru/pdo.prepare.php