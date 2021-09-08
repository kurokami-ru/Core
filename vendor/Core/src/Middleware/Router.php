<?php
namespace Core\Middleware;

use \Core\STL\Container;
use \Core\Middleware\MiddlewareInterface;

class Router extends Container implements MiddlewareInterface {
	public function process($response) {
		\Core\App::getInstance()["logger"]->info(__CLASS__/*,['file' => __FILE__, 'line' => __LINE__, 'var' => $response]*/);
		foreach($this as $path => $route) {
			$request = $response->request;
			$args = [];
			if(preg_match("#^$path$#", $request->target, $args)) {
				foreach($args as $key => $val) {
					if(!is_string($key)) {
						unset($args[$key]);
					}
				}				
				call_user_func_array($route, $args);
				break;
			}
		}
		return $response;
	}
}
?>