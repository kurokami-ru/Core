<?php
namespace Core;

use \Core\Log\LogManager;
use \Core\Log\LogLevel;
use \Core\STL\SingletonTrait;

class Logger extends LogManager {
	use SingletonTrait;
	public function __construct() {
		set_error_handler([$this, "errorHandler"]);
		set_exception_handler([$this, "exceptionHandler"]);
	}
	public function init($include) {
		foreach($include as $key => $val) {
			$this[$key] = $val;
		}
	}
	public function errorHandler($errno, $errstr, $errfile, $errline) {
		$this->{LogLevel::getLevel($errno)}($errstr, 
			["exception" => new \ErrorException($errstr, 0, $errno, $errfile, $errline)]);
	}
	public function exceptionHandler($exception) {
		$this->critical($exception->getMessage(), 
			["exception" => $exception]);
	}
}
?>