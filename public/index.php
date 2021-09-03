<?php
include __DIR__ . "/../debug.php";

include __DIR__ . "/../vendor/autoload.php";

/*$app = new \Core\App([
	"Loader" => new \Core\Middleware\Loader,
	"Router" => new \Core\Middleware\Router	
]);*/
(new \Core\App(include("../application.php")))->process();
?>