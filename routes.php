<?php
return [
	"/" => [ 'GET' => function() { message("main page"); } ],
	//"/1" => function() { (new \Core\MVC\Controller(null))->action(1); },
	//"/2" => [new \Core\MVC\Controller(null), "action"],
	//"/blog/ac1" => function() { (new \Core\MVC\Controller(new \Core\MVC\Model(new \Core\DAO\Native("../Blog/data.php")), include("../Blog/actions.php")))->ac1(); },
	//"/hello/(?P<name>[a-zA-Z0-9]+)" => function($name) { \Core\App::getInstance()["logger"]->info("Hello for $name"); },
	"/users/list" => [ 'GET' => function() { (new \Users\Controller)->list(); } ],
	"/users/login" => [
		'GET' => function() { (new \Users\Controller)->login(); },
		'POST' => function() { (new \Users\Controller)->loginprocess(); } 
	],
	"/users/logout" => [ 'GET' => function() { (new \Users\Controller)->logoutprocess(); } ],
	"/users/signup" => [
		'GET' => function() { (new \Users\Controller)->signup(); },
		'POST' => function() { (new \Users\Controller)->signupprocess(); } 
	]
];
?>