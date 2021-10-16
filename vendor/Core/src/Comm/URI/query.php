<?php
namespace Core\HTTP\URI;

use \Core\STL\Container;

class query extends Container {
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