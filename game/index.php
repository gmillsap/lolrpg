<?php
include($_SERVER['DOCUMENT_ROOT'] . '/config/app.php');

$route = str_replace('/', '\\', $_SERVER['REQUEST_URI']);
$route = explode('?', $route);
$route = $route[0];
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
    $route = ltrim($route, '\\');
    $pieces = explode('\\', $route);
    $class = '';
    $length = count($pieces) - 1;
    for($i=0; $i<$length; $i++) {
        $class .= '\\' . $pieces[$i];
    }
    $controller_class = '\LolRpg\Controllers' . $class;
    if(class_exists($controller_class)) {
        $method = $prefix . ucfirst(array_pop($pieces));
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
