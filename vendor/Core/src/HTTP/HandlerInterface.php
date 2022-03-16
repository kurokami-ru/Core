<?php

namespace Core\HTTP;

use Core\HTTP\Request;
use Core\HTTP\Response;

interface HandlerInterface {
	public function __invoke(Request $request): Response;
}