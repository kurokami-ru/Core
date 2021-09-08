<?php
namespace Core\Middleware;

use \Core\Log\AbstractLogger;
use \Core\Middleware\MiddlewareInterface;

class Logger extends AbstractLogger implements MiddlewareInterface {
	public function process($response) {
		\Core\App::getInstance()["logger"]->info(__CLASS__);
		return $response;
	}
}
?>