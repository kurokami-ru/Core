<?php
namespace URI;

class query extends \STL\ArrayArray {
	function __construct($query) {
		parse_str($query, $query);
		parent::__construct($query);
	}
	public function __toString() {
		//return http_build_query($this->storage);
		$ret = "";
		foreach($this as $key => $val) {
			$ret .= (!empty($ret) ? "&" : "") . "$key=$val";			
		}
		return $ret;
	}
}
?>