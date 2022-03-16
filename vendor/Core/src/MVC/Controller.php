<?php

namespace Core\MVC;

use Core\STL\Container;
use Core\MVC\Model;
use Core\MVC\Action;
use Core\MVC\Exception\MethodNotAllowedException;

class Controller extends Container {
	protected $model;

	public function __construct(Model $model, array $actions = []) {
		parent::__construct($actions);
		$this->model = $model;
	}
	function __call($name, $arguments) {
		if(!isset($this[$name])) {
			throw new MethodNotAllowedException;
		}
		return call_user_func_array(new $this[$name]($this->model), $arguments);
	}
}