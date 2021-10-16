<?php
namespace Core;

use \Core\STL\Container;

class Normalizer extends Container {
	public function normalize($data = []) {
		foreach($this as $key => $val) {
			foreach($val as $rule => $param) {
				if(is_callable([$this, $rule])) {
					if(!$this->$rule($data[$key], $param)) {
						message("$rule error for $key");
					}
				}
			}
		}
	}
	protected function default($data, $param) {
		if(is_null($data)) {
			message("Default value $param");
			$data = $param;
		}
	}
	protected function autoincrement($data, $param) {
		$data = $param + 1;
	}
}