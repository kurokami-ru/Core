<?php
namespace Core\MVC;

abstract class View {	
	protected $url;
	public function __construct($url) {
		$this->url = $url;
	}
	public function render($data = []) {
	}
}
?>