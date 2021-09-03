<?php
namespace Core;

use \Core\STL\Container;

class App extends Container {
	function process() {
		$response = new \Core\HTTP\Response(new \Core\HTTP\Request);
		foreach($this as $middleware) {
			$response = $middleware->process($response);
		}
	}
}
?>