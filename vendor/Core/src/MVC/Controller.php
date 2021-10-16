<?php
namespace Core\MVC;

use \Core\STL\Container;

class Controller extends Container {
	protected $model;
	public function __construct($model, $input = []) {
		$this->model = $model;
		parent::__construct($input);
	}
	public function __call($name, $arguments) {
		if(isset($this[$name])) {
			$this[$name]($this->model);
		}
	}
}
?>