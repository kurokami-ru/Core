<?php
namespace Core;

use \Core\STL\Middleware;
use \Core\STL\Container;

class Router extends Container implements Middleware {
	function process($data) {
		message(__CLASS__);
		return $data;
	}
}
?>