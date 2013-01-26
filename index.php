<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');
date_default_timezone_set('America/Los_Angeles');
session_start();

require_once 'settings.php';

require_once 'model/model.php';

require_once 'view/template.php';
//require the util tools so we can use it for all file
require_once 'util/routertool.php';
require_once 'util/modeltool.php';
require_once 'util/auth.php';
//require all the controller
//All the controller need to be here for the reflection
require_once 'controller/main.php';
require_once 'controller/about.php';
require_once 'controller/admin.php';
require_once 'controller/viewproduct.php';
require_once 'controller/user.php';

/**
 * LoadSetting use to load setting in settings.php
 * @global type $settings
 * @param type $key
 * @return null
 */
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
    echo $exc->getTraceAsString();
    return;
}
if(!$r->hasMethod($action)) {
    $action = 'Index';
}
call_user_func(array($r->newInstance(), $action));
?>