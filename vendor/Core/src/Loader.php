<?php
namespace Core;

class Loader extends Container {
	protected static $instance;
	public static function getInstance() {
        if(static::$instance === null) {
			static::$instance = new static;
		}
        return static::$instance;
	}
	private function __construct() {
		parent::__construct();
		spl_autoload_register();
		spl_autoload_register([$this, "autoload"]);
	}
    private function __clone() {
    }
    private function __wakeup() {
	}
	public function autoload($classname) {
		$classname = trim($classname, "\\");
		foreach($this as $prefix => $path) {
			if(strpos($classname, $prefix) === 0) {
				$filename = strtr(__DIR__ . "/" . $path . "/" . trim(substr($classname, strlen($prefix)), "\\"),"\\","/") . ".php";
				if(file_exists($filename)) {
					require_once $filename;
				}
			}
		}	
	}
}

set_include_path(__DIR__);
//$loader = new Loader;
//$loader["Core"] = "vendor/Core/src";
Loader::getInstance()["Core"] = "vendor/Core/src";
?>