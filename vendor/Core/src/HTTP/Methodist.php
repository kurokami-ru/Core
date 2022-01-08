<?php

namespace Core\HTTP;

use Core\STL\Container;
use Core\HTTP\HandlerInterface;
use Core\HTTP\Request;
use Core\HTTP\Response;
use Core\CC\URL;
use Core\HTTP\Exception\MethodNotAllowedException;
use Core\HTTP\Exception\PageNotFoundException;

class Methodist extends Container implements HandlerInterface {
	public function __invoke(Request $request, HandlerInterface $callback = null): Response {
		foreach($this as $route) {
			if($route['method'] == $request->method) {
				return $route['action']($request);
			}
		}
		throw new MethodNotAllowedException;
	}
}