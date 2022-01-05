<?php

namespace Core\STL;

interface ObjectAccess {
	public function __set(string $name, mixed $value): void;
	public function __get(string $name): mixed;
	public function __isset(string $name): bool;
	public function __unset(string $name): void;
}
?>