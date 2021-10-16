<?php
namespace Core\Log;

use \Core\Log\AbstarctLogger;

class Stdout extends AbstractLogger
{
	public function log($level, $message, array $context= []) {
		//$datetime = (\DateTime::createFromFormat('U.u', number_format(microtime(true), 6, '.', '')))->format("m-d-Y H:i:s.u");
		$datetime = date('Y-m-d H:i:s');
		echo "<p>$datetime <b>$level</b> : $message";
		if(isset($context['exception']) && is_a($context['exception'], 'Exception')) {
			//echo ' with code ' . $context['exception']->getCode();
			echo ' in ' . $context['exception']->getFile();
			echo '(' . $context['exception']->getLine() . ')';
			echo str_replace('#', '<br>#', $context["exception"]->getTraceAsString());
		}
		echo "<p>\n";
	}
}
