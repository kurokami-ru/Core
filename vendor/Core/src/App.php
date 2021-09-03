<?php
namespace Core;

use \Core\STL\Container;

class App extends Container {
	function process($data = null) {
		foreach($this as $ware) {
			$data = $ware->process($data);
		}
		return $data;
	}
}
?>