<?php
error_reporting(E_ALL);
ini_set('display_errors', true);
ini_set('display_startup_errors', true);

function message($msg) {
	echo "<pre>$msg</pre>";
}

function debug($var) {
	echo("<pre>\n");
	var_dump($var);
	echo("</pre>\n");
}
?>