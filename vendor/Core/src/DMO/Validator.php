<?php
namespace Core\DMO;

use Core\STL\Container;

class Validator extends Container {
	public function validate($data = []) {
		foreach($data as $key => $val) {
			if(!isset($this[$key])) {
				message("$key не определен");
			}
		}
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
	protected function required($data, $param = true) {
		return !is_null($data);
	}
	protected function type(&$data, $param) {
		if(is_null($data)) {
			return true;
		}
		if($param == 'int' && is_int($data)) {
			return true;
		}
		if($param == 'string' && is_string($data)) {
			return true;
		}
		return false;
	}
	protected function format($data, $param) {
		return true;
	}
	protected function minlen($data, $param) {
		return (strlen($data) >= $param);
	}
	protected function maxlen($data, $param) {
		return (strlen($data) <= $param);
	}
	protected function enum($data, $param) {
		//return in_array($data, explode(",", $param));
		return in_array($data, $param);
	}
	protected function unique($data, $param) {
		return !in_array($data, $param);
	}
}