<?php

namespace Core\Session;

class GlobalSession {
	public function __get(string $name): mixed {
		return $_SESSION[$name];
	}
	public function __set(string $name, mixed $value): void {
		$_SESSION[$name] = $value;
	}
	public function __isset(string $name): bool {
		return isset($_SESSION[$name]);
	}
	public function __unset(string $name): void {
		unset($_SESSION[$name]);
	}
}
?>