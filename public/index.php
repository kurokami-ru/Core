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

require_once "../autoload.php";
$null = new Core\HTTP\NullHandler;
$users = new Users\Controller;
$blog = new Blog\Controller;

$router = new Core\HTTP\Router([
	[ 'rules' => [ 'path' => '/' ], 'action' => $null ],
	[ 'rules' => [ 'path' => '/users' ], 'action' => [ $users, 'index' ] ],
	[ 'rules' => [ 'path' => '/login' ], 'action' => [ $users, 'login' ] ],
	[ 'rules' => [ 'path' => '/logout' ], 'action' => [ $users, 'logout' ] ],
	[ 'rules' => [ 'path' => '/signup' ], 'action' => [ $users, 'signup' ] ],
	[ 'rules' => [ 'path' => '/blog' ], 'action' => [ $blog, 'index' ] ],
	[ 'rules' => [ 'path' => '/post/{id}' ], 'action' => [ $blog, 'read' ] ]
]);

session_start();
$server = new Core\HTTP\Server;
$request = $server->recive();
//debug($request);
//debug($_SESSION);
$response = $router($request);
//debug($response);
$server->send($response);
?>