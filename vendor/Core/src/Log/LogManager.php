<?php
namespace Core\Log;

use \Core\STL\Container;
use \Core\Log\LogLevel;
use \Core\Log\LoggerInterface;

class LogManager extends Container implements LoggerInterface {
	/*public function __call($name, $arguments) {
		foreach($this as $logger) {
			if(is_callable([$logger, $name])) {
				call_user_func_array([$logger, $name], $arguments);
			}
		}
	}*/
    public function emergency($message, array $context = []) {
		foreach($this as $logger) {
			$logger->emergency($message, $context);
		}
        //$this->log(LogLevel::EMERGENCY, $message, $context);
    }
    public function alert($message, array $context = []) {
		foreach($this as $logger) {
			$logger->alert($message, $context);
		}
        //$this->log(LogLevel::ALERT, $message, $context);
    }
    public function critical($message, array $context = []) {
		foreach($this as $logger) {
			$logger->critical($message, $context);
		}
        //$this->log(LogLevel::CRITICAL, $message, $context);
    }
    public function error($message, array $context = []) {
		foreach($this as $logger) {
			$logger->error($message, $context);
		}
        //$this->log(LogLevel::ERROR, $message, $context);
    }
    public function warning($message, array $context = []) {
		foreach($this as $logger) {
			$logger->warning($message, $context);
		}
        //$this->log(LogLevel::WARNING, $message, $context);
    }
    public function notice($message, array $context = []) {
		foreach($this as $logger) {
			$logger->notice($message, $context);
		}
        //$this->log(LogLevel::NOTICE, $message, $context);
    }
    public function info($message, array $context = []) {
		foreach($this as $logger) {
			$logger->info($message, $context);
		}
        //$this->log(LogLevel::INFO, $message, $context);
    }
    public function debug($message, array $context = []) {
		foreach($this as $logger) {
			$logger->debug($message, $context);
		}
        //$this->log(LogLevel::DEBUG, $message, $context);
    }
	/*public function log($level, $message, array $context= []) {
		foreach($this as $logger) {
			$logger->log($level, $message, $context);
		}
	}*/
}
?>