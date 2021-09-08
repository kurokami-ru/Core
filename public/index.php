<?php
error_reporting(E_ALL);
ini_set('display_errors', true);
ini_set('display_startup_errors', true);

require_once "../vendor/Core/src/STL/ArrayAccess.php";
require_once "../vendor/Core/src/STL/ContainerInterface.php";
require_once "../vendor/Core/src/STL/Container.php";
require_once "../vendor/Core/src/STL/SingletonTrait.php";
require_once "../vendor/Core/src/App.php";
require_once "../vendor/Core/src/Middleware/MiddlewareInterface.php";
require_once "../vendor/Core/src/Middleware/Loader.php";

\Core\App::getInstance()->process();
//$model = new \Core\MVC\Model(new \Core\DAO\Native("../Blog/data.php"));
//debug($model);
//$controller = new \Core\MVC\Controller($model, include("../Blog/actions.php"));
//debug($controller);
//$controller->ac1();
?>