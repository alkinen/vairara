<?php
ini_set('display_errors', 1);
require_once 'system/load.php';




/*
error_reporting(E_CORE_ERROR | E_CORE_WARNING | E_COMPILE_ERROR | E_ERROR | E_WARNING | E_PARSE | E_USER_ERROR | E_USER_WARNING | E_RECOVERABLE_ERROR);
function site_url()
{
    return sprintf(
        "%s://%s%s",
        isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
        $_SERVER['SERVER_NAME'],
        $_SERVER['REQUEST_URI']
    );
}
if (!isset($header)) {
    $header = true;
    if ('HEAD' === $_SERVER['REQUEST_METHOD'])
        exit();
}
if (!defined('SEPARATOR')) {
    define('SEPARATOR', '/');
}
if (!defined('MAINPATH')) {
    define('MAINPATH', dirname(__FILE__) . '/');
}
if (!defined('SYSTEMPATH')) {
    define('SYSTEMPATH', dirname(__FILE__) . '/system' . SEPARATOR);
}
if (!defined('CONTROLLER_DIR')) {
    define('CONTROLLER_DIR', SYSTEMPATH . '/controllers' . SEPARATOR); // no trailing slash, full paths only - CONTENT_URL is defined further down
}
if (!defined('VIEWERS_DIR')) {
    define('VIEWERS_DIR', SYSTEMPATH . '/viewers' . SEPARATOR); // no trailing slash, full paths only - CONTENT_URL is defined further down
}
if (file_exists(MAINPATH . 'config.php')) {
    require_once(MAINPATH . 'config.php');
}
include(SYSTEMPATH . 'const.php');
require(CONTROLLER_DIR . 'controller_main.php');
*/
//echo phpinfo();