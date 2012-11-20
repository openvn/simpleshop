<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');
date_default_timezone_set('America/Los_Angeles');
session_start();

require_once 'model/model.php';
require_once 'view/template.php';
require_once 'util/routertool.php';;
require_once 'controller/main.php';

$settings = array();
$settings['url_pretty'] = FALSE;
$settings['location'] = '//localhost/shop/';
$settings['db_host'] = 'localhost';
$settings['db_user'] = 'root';
$settings['db_pass'] = 'root';
$settings['db_name'] = 'shop';
$settings['default_controller'] = 'Main';

function LoadSetting($key) {
    global $settings;
    if(isset($settings[$key])) {
        return $settings[$key];
    }
    return NULL;
}
$controller = LoadSetting('default_controller');
$action = 'Index';
if(isset($_GET['controller'])) {
    $controller = $_GET['controller'];
}
if(isset($_GET['action'])) {
    $action = $_GET['action'];
}
try {
    if(!is_subclass_of($controller, 'Controller')) {
        throw new Exception('Not found controller for this page');
    }
    $r = new ReflectionClass($controller);
} catch (Exception $exc) {
    $r = new ReflectionClass(LoadSetting('default_controller'));
    call_user_func(array($r->newInstance(), $action));
    error_log($exc->getTraceAsString());
    return;
}
if(!$r->hasMethod($action)) {
    $action = 'Index';
}
call_user_func(array($r->newInstance(), $action));
?>