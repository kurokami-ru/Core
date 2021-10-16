<?php

namespace Core\STL;

use RuntimeException;

trait ImmutableTrait {
	public function __get($name) {
		return $this->$name;
	}
	public function __set($name, $value) {
		throw new RuntimeException("$name read only");
	}
	public function __isset($name) {
		return isset($this->$name);
	}
	public function __unset($name) {
		throw new RuntimeException("$name read only");
	}
}
?>