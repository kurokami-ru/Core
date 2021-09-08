<?php
namespace Core\Log;

use \Core\Log\LoggerInterface;
use \Core\Log\LogLevel;
/*
	public function __construct() {
		set_error_handler([$this, "errorHandler"]);
		set_exception_handler([$this, "exceptionHandler"]);
	}
	public function errorHandler($errno, $errstr, $errfile, $errline) {
		$this->log(LogLevel::getLevel($errno), $errstr, 
			["exception" => new \ErrorException($errstr, 0, $errno, $errfile, $errline)]);
	}
	public function exceptionHandler($exception) {
		$this->log(LogLevel::getLevel($errno), $errstr, 
			["exception" => new \ErrorException($errstr, 0, $errno, $errfile, $errline)]);
	}
		if(isset($context["exception"]) && is_a($context["exception"], "Exception")) {
			echo " with code " . $context["exception"]->getCode();
			echo " in file " . $context["exception"]->getFile();
			echo " on line " . $context["exception"]->getLine();
			echo "<pre>\n";
			print_r($context["exception"]->getTrace());
			echo "</pre>\n";
		}
*/
abstract class AbstractLogger implements LoggerInterface
{
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
		$datetime = date("Y.m.d H:i:s");
		echo "<p>$datetime <b>$level</b> : $message";
		if(!empty($content)) {
			echo "<pre>\n";
			var_dump($context);
			echo "</pre>\n";
		}
		echo "<p>\n";
	}
}
