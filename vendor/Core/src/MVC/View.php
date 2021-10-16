<?php
namespace Core\MVC;

use \Core\Renders\RenderInterface;

abstract class View implements RenderInterface {	
	private $render;
	public function __construct($render) {
		$this->render = $render;
	}
	public function render($data = []) {
		$tris->render->render($data);
	}
}
?>