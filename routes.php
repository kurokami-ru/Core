<?php
return [
	"/" => function() { \Core\App::getInstance()["logger"]->info("empty string"); },
	"/1" => function() { (new \Core\MVC\Controller(null))->action(1); },
	"/2" => [new \Core\MVC\Controller(null), "action"],
	"/hello/(?P<name>[a-zA-Z0-9]+)" => function($name) { \Core\App::getInstance()["logger"]->info("Hello for $name"); }
];
?>