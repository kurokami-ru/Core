<?php
namespace Core\Middleware;

use \Core\STL\Container;
use \Core\Middleware\MiddlewareInterface;
use \Core\App;

class Loader extends Container implements MiddlewareInterface {
	public function __construct() {
		parent::__construct(include("../autoload.php"));
		spl_autoload_register([$this, "autoload"]);
	}
	public function autoload($classname) {
		$root = "C:/OpenServer/domains/core";
		$classname = trim($classname, "\\");
		foreach($this as $prefix => $path) {
			if(empty($prefix) || strpos($classname, $prefix) === 0) {
				$filename = "$root/";
				$filename .= (empty($path) ? "" : "$path/");
				$filename .= strtr(substr($classname, strlen($prefix)), "\\", "/") . ".php";
				//debug($filename);
				if(file_exists($filename)) {
					require_once $filename;
					return;
				}
			}
		}	
	}
	public function process($response) {
		App::getInstance()["logger"]->info(__CLASS__);
		return $response;
	}
}
?>