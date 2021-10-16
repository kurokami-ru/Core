<?php
namespace Core\HTTP\URI;

use \Core\STL\Container;

class path extends Container {
	function __construct($path) {
		parent::__construct(explode("/", trim($path, "/")));
	}
	public function __toString() {
		$ret = "";
		foreach($this as $val) {
			$ret .= (!empty($ret) ? "/" : "") . $val;			
		}
		return $ret;
	}
}
?>