<?php


ini_set('display_errors', 1);
error_reporting(E_ALL);

use Master\Router\Router as App;

try {


/**
 * STARTING SESSION
 */


session_start();


/**
 * REQUIRING FILE AUTOLOAD
 */

 require_once 'System/vendor/autoload.php';



 /**
  * STARTING APP
  */


$whoops = new \Whoops\Run();
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();



makeHelper();



$app = new App();


$app->router();

} catch (\Exception $e) {
    return $e->getMessage();
}