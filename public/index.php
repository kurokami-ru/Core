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

function http_parse_query(?string $query):?array {
	if(!isset($query)) {
		return null;
	}
	if(empty($query)) {
		return [];
	}
	parse_str($query, $ret);
	return $ret;
}

function encode($data) {
	return "=?utf-8?Q?".str_replace("+","_",str_replace("%","=",urlencode($data)))."?=";
}

require_once "../autoload.php";


$null = new Core\HTTP\NullHandler;
$users = new Users\Controller;
$blog = new Blog\Controller;

$router = new Core\HTTP\Router([
	[ 'path' => '/' , 'action' => $null ],
	[ 'path' => '/users', 'action' => [ $users, 'index' ] ],
	[ 'path' => '/login', 'action' => new Core\HTTP\Methodist([
		[ 'method' => 'GET', 'action' => [ $users, 'login' ] ],
		[ 'method' => 'POST',  'action' => [ $users, 'login' ] ]
	]) ],
	[ 'path' => '/blog', 'action' => [ $blog, 'index' ] ],
	[ 'path' => '/post/{id}', 'action' => $null ]
]);

session_start();
$server = new Core\HTTP\Server;
$request = $server->recive();
//debug($request);
//$response = $null($request);
$response = $router($request);
//debug($response);
$server->send($response);
?>