<?php
defined('MAINPATH') OR exit('Прямой доступ к скрипту запрещен.');


function initial_constants()
{

    define('KB_IN_BYTES', 1024);
    define('MB_IN_BYTES', 1024 * KB_IN_BYTES);
    define('GB_IN_BYTES', 1024 * MB_IN_BYTES);
    define('TB_IN_BYTES', 1024 * GB_IN_BYTES);
    /**#@-*/

    $current_limit = @ini_get('memory_limit');

    // Define memory limits.
    if (!defined('MEMORY_LIMIT')) {
        define('MEMORY_LIMIT', '512M');
    }

    if (!defined('MAX_MEMORY_LIMIT')) {
        define('MAX_MEMORY_LIMIT', '3070M');
    }

    // Set memory limits.
    $limit_int = MEMORY_LIMIT;
    if (-1 !== $current_limit && (-1 === $limit_int || $limit_int > $current_limit)) {
        @ini_set('memory_limit', MEMORY_LIMIT);
    }

    define('MINUTE_IN_SECONDS', 60);
    define('HOUR_IN_SECONDS', 60 * MINUTE_IN_SECONDS);
    define('DAY_IN_SECONDS', 24 * HOUR_IN_SECONDS);
    define('WEEK_IN_SECONDS', 7 * DAY_IN_SECONDS);
    define('MONTH_IN_SECONDS', 30 * DAY_IN_SECONDS);
    define('YEAR_IN_SECONDS', 365 * DAY_IN_SECONDS);

}
