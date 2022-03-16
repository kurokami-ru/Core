<?php
error_reporting(E_ALL);
ini_set('display_errors', true);
ini_set('display_startup_errors', true);

function debug($var) {
	echo "<pre>\n";
	var_dump($var);
	echo "</pre>\n";
}

function message($str) {
	echo "<pre>\n";
	echo $str;
	echo "</pre>\n";
}

require_once "../autoload.php";

$null = new Core\HTTP\NullHandler;
$form = new Core\HTTP\FormHandler;

$map = [
	'/' => $null,
	//'/{i}' => [ 'GET' => $null, 'POST' => $null ]
	'/form' => $form,
	'/action' => $null
];
$router = new Core\HTTP\Router\Handler($map);

$session = new Core\HTTP\Session\Handler;

$server = new Core\HTTP\Server;
//session_start();
$server->send($session($server->recive(), $router));
//debug($_SERVER);
?>