<?php

namespace Core\Comm\HTTP;

use Core\Comm\HTTP\ResponseStatusInterface;

class Server {
	public function get() {
		return new Request(
			$_SERVER["REQUEST_METHOD"],
			$_SERVER["REQUEST_URI"],
			$_SERVER["SERVER_PROTOCOL"],
			new Head([
				"Host" => $_SERVER['SERVER_NAME'] . ":" . $_SERVER['SERVER_PORT']
			]),
			null
		);
	}
	public function send($response) {
		$reason = ResponseStatusInterface::REASONS[$response->status];
		header("{$response->version} {$response->status} $reason", true, $response->status);
		foreach($response->head as $key => $val) {
			header("$key: $val");
		}
		echo $response->body;
	}
}
?>