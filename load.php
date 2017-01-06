<?php
if (!defined('MAINPATH')) {
    define('MAINPATH', dirname(__FILE__) . '/');
}
if (!defined('COREPATH')) {
    define('COREPATH', dirname(__FILE__) . '/core');
}
error_reporting(E_CORE_ERROR | E_CORE_WARNING | E_COMPILE_ERROR | E_ERROR | E_WARNING | E_PARSE | E_USER_ERROR | E_USER_WARNING | E_RECOVERABLE_ERROR);

if (file_exists(MAINPATH . 'config.php')) {

    /** The config file resides in MAINPATH */
    require_once(MAINPATH . 'config.php');

} elseif (@file_exists(dirname(MAINPATH) . 'config.php') && !@file_exists(dirname(COREPATH) . '/db_conn.php')) {

    /** The config file resides one level above ABSPATH but is not part of another install */
    require_once(dirname(MAINPATH) . 'config.php');
    require_once(dirname(COREPATH) . '/db_conn.php');
}
if (!isset($header)) {

    $header = true;

    if ('HEAD' === $_SERVER['REQUEST_METHOD'])
        exit();
}

function get_file($path)
{

    if (function_exists('realpath')) {
        $path = realpath($path);
    }

    if (!$path || !@is_file($path)) {
        return '';
    }

    return @file_get_contents($path);
}
