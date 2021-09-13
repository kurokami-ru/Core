<?php
namespace Core\Middleware;

use \Core\Log\LogManager;
use \Core\Middleware\MiddlewareInterface;
use \Core\App;

class Logger extends LogManager implements MiddlewareInterface {
	public function __construct() {
		parent::__construct(include("../loggers.php"));
	}
	public function process($response) {
		App::getInstance()["logger"]->info(__CLASS__);
		return $response;
	}
}
?>