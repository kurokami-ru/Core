<?php
error_reporting(E_ALL);
ini_set('display_errors', true);
ini_set('display_startup_errors', true);

function debug($var) {
	echo("<pre>\n");
	var_dump($var);
	echo("</pre>\n");
}

require_once "../vendor/Core/src/STL/ArrayAccess.php";
require_once "../vendor/Core/src/STL/ContainerInterface.php";
require_once "../vendor/Core/src/STL/Container.php";
require_once "../vendor/Core/src/STL/SingletonTrait.php";
require_once "../vendor/Core/src/App.php";
require_once "../vendor/Core/src/Middleware/MiddlewareInterface.php";
require_once "../vendor/Core/src/Middleware/Loader.php";

\Core\App::getInstance()->process();
/*$adapter = new \Core\DAO\Native("../Blog/data.php");
$obj = $adapter[1];
$obj["title"] = "One+";
$adapter[1] = $obj;
debug($adapter[1]);*/
$adapter = new \Core\DAO\mySQL("test.test");
//$adapter = new \Core\DAO\Native("../Blog/data.php");
echo "<p>it's a test</p>\n";
foreach($adapter as $row) {
	debug($row);
}
//$model = new \Core\MVC\Model($adapter);
//debug($model);
//$controller = new \Core\MVC\Controller($model, include("../Blog/actions.php"));
//debug($controller);
//$controller->ac1();
?>