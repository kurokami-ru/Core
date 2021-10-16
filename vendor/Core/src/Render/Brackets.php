<?php
namespace Core\Render;

use \Core\Render\RenderInterface;

class Brackets implements RenderInterface {
	protected $template;
	public function __construct($template) {
		$this->template = $template;
	}
	public function render($data = []) {
		$ret = $this->template;
		foreach($data as $key => $val) {
			$ret = str_replace("{{$key}}", $val, $ret);
		}
		//$ret = preg_replace("/{[^ }]*}/i", "", $ret); // delete
		return $ret;
	}
}
?>