<?php
namespace Core\Log;

use \Core\Log\AbstarctLogger;

class Stdout extends AbstractLogger
{
	public function log($level, $message, array $context= []) {
		$datetime = date('Y.m.d H:i:s');
		echo "<p>$datetime <b>$level</b> : $message";
		if(isset($context['exception']) && is_a($context['exception'], 'Exception')) {
			//echo ' with code ' . $context['exception']->getCode();
			echo '<br>in ' . $context['exception']->getFile();
			echo '(' . $context['exception']->getLine() . ')';
			echo str_replace('#', '<br>#', $context["exception"]->getTraceAsString());
		}
		echo "<p>\n";
	}
}
