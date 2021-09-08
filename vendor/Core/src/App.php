<?php
namespace Core;

use \Core\STL\Container;
use \Core\STL\SingletonTrait;

class App extends Container {
	use SingletonTrait;
	private function __construct() {
		parent::__construct(include("../application.php"));
	}
	function process() {
		$request = new \Core\HTTP\Request(
			$_SERVER["REQUEST_METHOD"],
			$_SERVER["REQUEST_URI"],
			$_SERVER["SERVER_PROTOCOL"],
			new \Core\HTTP\Headers([
				"Host" => $_SERVER['SERVER_NAME'] . ":" . $_SERVER['SERVER_PORT']
			])
		);
		$response = new \Core\HTTP\Response(
			$request,
			\Core\HTTP\ResponseStatus::HTTP_OK,
			$request->protokol,
			new \Core\HTTP\Headers([
				"Host" => $request->headers["Host"]
			])
		);
		$response = new \Core\HTTP\Response($request);
		foreach($this as $middleware) {
			$response = $middleware->process($response);
		}
	}
}
?>