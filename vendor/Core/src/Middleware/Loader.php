<?php
namespace Core\Middleware;

use \Core\STL\Container;
use \Core\Middleware\MiddlewareInterface;

class Loader extends Container implements MiddlewareInterface {
	public function process($response) {
		message(__CLASS__);
		//debug($response);
		return $response;
	}
}
?>