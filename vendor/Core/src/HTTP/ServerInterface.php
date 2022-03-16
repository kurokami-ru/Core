<?php

namespace Core\HTTP;

use Core\HTTP\Request;
use Core\HTTP\Response;

interface ServerInterface {
	public function recive():Request;
	public function send(Response $response):void;
}
?>