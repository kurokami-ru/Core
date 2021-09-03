<?php
namespace Core\STL;

trait Singleton {
	protected static $instance;
	public static function getInstance() {
        if(static::$instance === null) {
			static::$instance = new static;
		}
        return static::$instance;
	}
	private function __construct() {
	}
    private function __clone() {
    }
    private function __wakeup() {
	}
}
?>