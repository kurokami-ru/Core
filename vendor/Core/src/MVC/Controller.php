<?php
namespace Core\MVC;

use \Core\STL\Container;

class Controller extends Container {
	private $model;
	public function __construct($model, $input = []) {
		parent::__construct($input);
		$this->model = $model;
	}
	public function __call($name, $arguments) {
		message("Call $name with");
		debug($arguments);
	}
}
?>