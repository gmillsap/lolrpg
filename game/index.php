<?php
include($_SERVER['DOCUMENT_ROOT'] . '/app.php');

new \LolRpg\Resources\Champion();
new \LolRpg\Controllers\ProfileIcons();
$route = str_replace('/', '\\', $_SERVER['REQUEST_URI']);
$is_index = substr($route, -1) == '\\' ? true : false;
if($is_index) {
    $controller_class = '\LolRpg\Controllers' . substr($route, 0, strlen($route) -1);
    if(class_exists($controller_class)) {
        $controller = new $controller_class();
        if(method_exists($controller, 'getIndex')) {
            return $controller->getIndex();
        } else {
            not_found_redirect();
        }
    } else {
        not_found_redirect();
    }
} else {
    $prefix = strtolower($_SERVER['REQUEST_METHOD']);
    $pieces = explode('\\', $route);
    $controller_class = '\LolRpg\Controllers\\';
    $length = count($pieces) - 1;
    for($i=0; $i<$length; $i++) {
        $controller_class .= $pieces[$i];
    }
    error_log($controller_class);
    if(class_exists($controller_class)) {
        $method = $prefix . ucfirst(array_pop($pieces));
        error_log($method);
        $controller = new $controller_class;
        if(method_exists($controller, $method)) {
            $controller->$method();
        } else {
            not_found_redirect();
        }
    } else {
        not_found_redirect();
    }
}
