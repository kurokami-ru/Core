<?php
return [
	"loader" => new \Core\Middleware\Loader,
	"logger" => new \Core\Middleware\Logger,
	"router" => new \Core\Middleware\Router(include("routes.php"))
];
?>