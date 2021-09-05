<?php
include __DIR__ . "/../debug.php";

include __DIR__ . "/../vendor/autoload.php";

//(new \Core\App(include("../application.php")))->process();
$model = new \Core\MVC\Model(new \Core\DAO\Native("../Blog/data.php"));
debug($model);
$controller = new \Core\MVC\Controller($model);
debug($controller);
?>