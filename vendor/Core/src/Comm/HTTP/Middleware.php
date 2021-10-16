<?php

namespace Core\Comm\HTTP;

use Core\Comm\HTTP\Response;
use Core\Comm\HTTP\ResponseStatusInterface;

class Middleware {
	public function process($request, $handler) {
		return $handler->handle($request);
	}
}