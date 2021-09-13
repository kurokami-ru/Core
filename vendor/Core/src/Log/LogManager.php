<?php
namespace Core\Log;

use \Core\STL\Container;
use \Core\Log\LogLevel;
use \Core\Log\LoggerInterface;

class LogManager extends Container implements LoggerInterface {
	private $container;
	public function __construct($input = []) {
		parent::__construct($input);
		set_error_handler([$this, "errorHandler"]);
		set_exception_handler([$this, "exceptionHandler"]);
	}
	public function errorHandler($errno, $errstr, $errfile, $errline) {
		$this->log(LogLevel::getLevel($errno), $errstr, 
			["exception" => new \ErrorException($errstr, 0, $errno, $errfile, $errline)]);
	}
	public function exceptionHandler($exception) {
		$this->log(LogLevel::CRITICAL, $exception->getMessage(), 
			["exception" => $exception]);
	}
    public function emergency($message, array $context = []) {
        $this->log(LogLevel::EMERGENCY, $message, $context);
    }
    public function alert($message, array $context = []) {
        $this->log(LogLevel::ALERT, $message, $context);
    }
    public function critical($message, array $context = []) {
        $this->log(LogLevel::CRITICAL, $message, $context);
    }
    public function error($message, array $context = []) {
        $this->log(LogLevel::ERROR, $message, $context);
    }
    public function warning($message, array $context = []) {
        $this->log(LogLevel::WARNING, $message, $context);
    }
    public function notice($message, array $context = []) {
        $this->log(LogLevel::NOTICE, $message, $context);
    }
    public function info($message, array $context = []) {
        $this->log(LogLevel::INFO, $message, $context);
    }
    public function debug($message, array $context = []) {
        $this->log(LogLevel::DEBUG, $message, $context);
    }
	public function log($level, $message, array $context= []) {
		foreach($this as $logger) {
			$logger->log($level, $message, $context);
		}
	}
}
?>