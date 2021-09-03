<?php
namespace \Core\HTTP\URI;

use \Core\HTTP\URI\path;
use \Core\HTTP\URI\query;

class URI extends \Core\STL\ObjectArray {
	function __construct($uri) {
		parent::__construct(parse_url($uri));
		if(isset($this->path)) {
			$parts = pathinfo($this->path);
			if(isset($parts["extension"])) {
				$this->extension = $parts["extension"];
			}
			$this->path = new path($this->path);
		}
		if(isset($this->query)) {
			$this->query = new query($this->query);
		}
	}
	public function __toString() {
		$ret = isset($this->user) ? $this->user . (isset($this->pass) ? ":{$this->pass}" : "") . "@" : "";
		$ret .= isset($this->host) ? $this->host : "";
		$ret = (isset($this->scheme) ? "{$this->scheme}:" : "") . (!empty($ret) ? "//" : "") . $ret;
		$ret .= isset($this->path) ? (!empty($ret) ? "/" : "") . $this->path : "";
		$ret .= isset($this->query) ? "?{$this->query}" : "";
		$ret .= isset($this->fragment) ? "#{$this->fragment}" : "";
		return $ret;
	}
}
?>