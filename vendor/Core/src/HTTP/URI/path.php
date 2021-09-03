<?php
namespace URI;

class path extends \STL\ArrayArray {
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