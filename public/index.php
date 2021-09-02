<?php
define("DEBUG", true);
include "../debug.php";

include "../loader.php";

//(new \Core\App)->run();
(new \Blog\Controller(new \Blog\Model([
		[ "id" => 1, "name" => "One" ],
		[ "id" => 2, "name" => "Two" ],
		[ "id" => 3, "name" => "Free" ],
		[ "id" => 4, "name" => "Four" ]
	]), [
		"action" => function($model) {
			$view = new \Core\MVC\View("../Blog/View/infold.php");
			$view->render(["header" => "Blog", "list" => $model]);
		}	
	]
))->action();
?>