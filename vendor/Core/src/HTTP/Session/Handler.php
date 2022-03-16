<?php

namespace Core\HTTP\Session;

use Core\HTTP\MiddlewareInterface;
use Core\HTTP\Request;
use Core\HTTP\HandlerInterface;
use Core\HTTP\Response;
//use Core\HTTP\Session\Model;

class Handler implements MiddlewareInterface {
	public function __invoke(Request $request, HandlerInterface $callback): Response {
		session_start();
		$response = $callback($request);
		return $response;
	}
}
?>