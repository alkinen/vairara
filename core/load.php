<?php
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

echo "HELLO WORLD!";
