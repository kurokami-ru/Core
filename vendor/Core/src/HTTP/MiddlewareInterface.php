<?php

namespace Core\HTTP;

use Core\HTTP\Request;
use Core\HTTP\Response;

interface MiddlewareInterface {
	public function __invoke(Request $request, HandlerInterface $callback): Response;
}