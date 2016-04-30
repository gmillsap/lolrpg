<?php
function lolrpg_autoloader($class) {
    $filename = $_SERVER['DOCUMENT_ROOT'] . '\Class\\' . $class . '.php';
    if(file_exists($filename)) {
        include($filename);
        if (class_exists($class)) {
            return true;
        }
    } else {
        $filename = $_SERVER['DOCUMENT_ROOT'] .  '/Class/' . str_replace('\\', '/', $class) . '.php';
        if(file_exists($filename)) {
            include($filename);
            if (class_exists($class)) {
                return true;
            }
        }
        return false;
    }
}

function not_found_redirect() {
    http_response_code(404);
    include($_SERVER['DOCUMENT_ROOT'] . '/404.html');
    exit();
}

function lolrpg_log($data) {
    $log = "\r\n" . '!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!' . "\r\n";
    $log .= print_r($data, true);
    $log .= "\r\n" .'!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!' . "\r\n";
    error_log($log);
}

spl_autoload_register('lolrpg_autoloader');
include($_SERVER['DOCUMENT_ROOT'] . '/config/api_key.php');
define('LOL_API_KEY', getApiKey());
