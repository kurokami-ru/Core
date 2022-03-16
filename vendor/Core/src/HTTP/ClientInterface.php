<?php

namespace Core\HTTP;

use Core\HTTP\Request;
use Core\HTTP\Response;

interface ClientInterface {
	public function send(Request $request):void;
	public function recive():Response;
}
?>