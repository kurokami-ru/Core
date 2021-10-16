<?php

namespace Core\Comm\HTTP;

use Core\Comm\HTTP\Response;
use Core\Comm\HTTP\ResponseStatusInterface;

class Handler {
	public function handle($request) {
		return new Response(
			ResponseStatusInterface::STATUS_OK,
			'HTTP/1.1',
			[
				'Content-Type' => 'text/plain'
			], 
			"Hello World!\n");		
	}
}