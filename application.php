<?php
return [
	"session" => new \Core\Middleware\Session(),
	"router" => new \Core\Middleware\Router(include('routes.php'))
];
?>