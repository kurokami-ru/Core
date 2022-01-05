<?php
namespace Core\MVC;

use Core\Render\RenderInterface;

class View implements RenderInterface {	
	private $render;
	public function __construct(RenderInterface $render) {
		$this->render = $render;
	}
	public function render(array $data = []): string {
		$tris->render->render($data);
	}
}
?>