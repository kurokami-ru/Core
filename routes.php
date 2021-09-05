<?php
return [
	"/" => function() { message("empty string - new edition"); },
	"/1" => function() { (new \Core\MVC\Controller(null))->action(1); },
	"/2" => [new \Core\MVC\Controller(null), "action"],
	"/hello/(?P<name>[a-zA-Z0-9]+)" => function($name) { message("Hello for $name"); }
];
?>