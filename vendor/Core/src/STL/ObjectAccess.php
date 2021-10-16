<?php

namespace Core\STL;

interface ObjectAccess {
	public function __set($name, $value);
	public function __get($name);
	public function __isset($name);
	public function __unset($name);
}
?>