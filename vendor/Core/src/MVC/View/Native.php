<?php
namespace Core\MVC\View;

use \Core\MVC\View;

class Native extends View {
	protected $url;
	public function __construct($url) {
		parent::__construct($url);
	}
	public function render($data = []) {
		include($this->url);
	}
}
?>