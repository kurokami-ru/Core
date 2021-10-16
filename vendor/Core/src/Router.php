<?php
namespace Core\Middleware;

use \Core\STL\Container;
use \Core\Middleware\MiddlewareInterface;
use \Core\App;

class Router extends Container implements MiddlewareInterface {
	public function __construct($input = []) {
		parent::__construct($input);
	}
	public function process($response, $callback = null) {
		message(__CLASS__);
		foreach($this as $path => $route) {
			$request = $response->request;
			$args = [];
			if(preg_match("#^$path$#", $request->target, $args)) {
				foreach($args as $key => $val) {
					if(!is_string($key)) {
						unset($args[$key]);
					}
				}				
				if(isset($route[$request->method])) {
					call_user_func_array($route[$request->method], $args);
					return $response;
				} else {
					message("405 Method not allowed");
					return $response;
				}
			}
		}
		message("404 Not found");
		return $response;
	}
}
?>