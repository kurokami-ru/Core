<?php

namespace Core\STL;

use Core\STL\Exception\UnexpectedValueException;

trait ImmutableTrait {
	public function __get(string $name): mixed {
		return $this->$name;
	}
	public function __set(string $name, mixed $value): void {
		throw new UnexpectedValueException;
	}
	public function __isset(string $name): bool {
		return isset($this->$name);
	}
	public function __unset(string $name): void {
		throw new UnexpectedValueException;
	}
}
?>