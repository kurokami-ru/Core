<?php
namespace Core\DMO;

use Core\STL\Container;

class Normalizer extends Container {
	public function normalize(&$data = []) {
		foreach($this as $key => $val) {
			foreach($val as $rule => $param) {
				if(is_callable([$this, $rule])) {
					/*$data[$key] = */$this->$rule($data[$key], $param);
				}
			}
		}
	}
	protected function default(&$data, $param) {
		if(empty($data)) {
			$data = $param;
		}
	}
	protected function autoincrement(&$data, $param) {
		if(is_null($data)) {
			$data = $param + 1;
		}
	}
}