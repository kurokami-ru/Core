<?php

namespace Core\HTTP;

use Core\HTTP\HandlerInterface;
use Core\HTTP\Request;
use Core\HTTP\Response;
use Core\HTTP\ResponseStatusInterface;
use Core\Comm\Head;

class NullHandler implements HandlerInterface {
	public function __invoke(Request $request, HandlerInterface $callback = null): Response {
		return new Response(
			ResponseStatusInterface::STATUS_OK,
			'1.1', 
			[
				'Content-type' => 'text/html'
			],
			"<h1>Hello, world</h1>\n<p>{$request->target}</p>\n"
		);
	}
}