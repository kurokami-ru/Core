<?php
namespace Core\Log;

class LogLevel
{
    const EMERGENCY = 'emergency';
    const ALERT     = 'alert';
    const CRITICAL  = 'critical';
    const ERROR     = 'error';
    const WARNING   = 'warning';
    const NOTICE    = 'notice';
    const INFO      = 'info';
    const DEBUG     = 'debug';
	/*public static function getLevel($errno) {
		switch($errno) {
            case E_ERROR:
			case E_CORE_ERROR:
			case E_USER_ERROR:
			case E_RECOVERABLE_ERROR:
				return LogLevel::CRITICAL;
            case E_WARNING:
			case E_CORE_WARNING:
			case E_COMPILE_WARNING:
			case E_USER_WARNING:
				return LogLevel::WARNING;
            case E_PARSE:
			case E_COMPILE_ERROR:
				return LogLevel::ALERT;
			case E_NOTICE: 
			case E_USER_NOTICE: 
			case E_STRICT:
			case E_DEPRECATED:
			case E_USER_DEPRECATED:
				return LogLevel::NOTICE;
			default:
				return 'unknown';
		}
	}*/
}
