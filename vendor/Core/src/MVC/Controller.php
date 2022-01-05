<?php

namespace Core\MVC;

use Core\MVC\Model;

class Controller {
	protected $model;

	public function __construct(Model $model) {
		$this->model = $model;
	}
}