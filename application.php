<?php
return [
	"Loader" => new \Core\Middleware\Loader,
	"Router" => new \Core\Middleware\Router(include("routes.php"))
];
?>