<?php

namespace Core\HTTP;

use Core\HTTP\ClientInterface;
use Core\HTTP\Request;
use Core\HTTP\Response;

class Client implements ClientInterface {
	public function __construct($stream) {
		$this->stream = $stream;
	}
	public function send(Request $request) {
		$this->stream->write($request);
	}
	public function recive():Response {
		return new Response($this->stream->read());
	}
}
?>