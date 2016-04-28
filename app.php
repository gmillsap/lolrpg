<?php
function lolrpg_autoloader($class) {
    $filename = 'Class\\' . $class . '.php';
    if(file_exists($filename)) {
        include($filename);
        if (class_exists($class)) {
            return true;
        }
    } else {
        $filename = 'Class/' . str_replace('\\', '/', $class) . '.php';
        if(file_exists($filename)) {
            include($filename);
            if (class_exists($class)) {
                return true;
            }
        }
        return false;
    }
}

spl_autoload_register('lolrpg_autoloader');
include('api_key.php');
define('LOL_API_KEY', getApiKey());
define('LOL_REGION', 'na');
