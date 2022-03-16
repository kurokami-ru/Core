<?php

namespace Core\HTTP;

use Core\HTTP\HandlerInterface;
use Core\HTTP\Request;
use Core\HTTP\Response;
use Core\HTTP\ResponseStatusInterface;

class NullHandler implements HandlerInterface {
	public function __invoke(Request $request): Response {
		//debug($request);
		$response = new Response(
			ResponseStatusInterface::STATUS_OK,
			'HTTP/1.1', 
			[
				'Expires' => 'Thu, 19 Nov 1981 08:52:00 GMT',
				'Cache-Control' => 'no-store, no-cache, must-revalidate',
				'Pragma' => 'no-cache'
			], 
			"<h1>Hello, world</h1>\n"
		);
		//debug($response);
		return $response;
	}
}