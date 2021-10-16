<?php
error_reporting(E_ALL);
ini_set('display_errors', true);
ini_set('display_startup_errors', true);

function debug($var) {
	echo("<pre>\n");
	var_dump($var);
	echo("</pre>\n");
}

function message($str) {
	echo "<pre>\n$str</pre>\n";
}

require_once "../autoload.php";

$server = new Core\Comm\HTTP\Server;
$request = $server->get();
$handler = new Core\Comm\HTTP\Handler;
$middleware = new Core\Comm\HTTP\Middleware;
$response = $middleware->process($request, $handler);
$server->send($response);
?>