<?php
defined('MAINPATH') OR exit('Прямой доступ к скрипту запрещен.');
include(SYSTEMPATH . '/db_conn.php');

class MAIN_CONTROLLER extends DB_CONN
{
    public function main_Function()
    {

    }

}

$main_controller = new MAIN_CONTROLLER();
$main_controller->checkDBconnection($db_host, $db_name, $db_user, $db_password, $db_charset);