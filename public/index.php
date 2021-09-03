<?php
include __DIR__ . "/../debug.php";

include __DIR__ . "/../vendor/autoload.php";

$app = new \Core\App;
$app["Router"] = new \Core\Router;
$app->process();
?>