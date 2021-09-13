<?php
namespace Core\HTTP;

use \Core\STL\ObjectAccess;
//use \Core\HTTP\URI\path;
//use \Core\HTTP\URI\query;

class URI implements ObjectAccess {
	private $scheme;
	private $user;
	private $pass;
	private $host;
	private $port;
	private $path;
	private $query;
	private $fragment;
	function __construct($url) {
		$this->scheme = parse_url($url, PHP_URL_SCHEME);
		$this->user = parse_url($url, PHP_URL_USER);
		$this->pass = parse_url($url, PHP_URL_PASS);
		$this->host = parse_url($url, PHP_URL_HOST);
		$this->port = parse_url($url, PHP_URL_PORT);
		$this->path = parse_url($url, PHP_URL_PATH);
		$this->query = parse_url($url, PHP_URL_QUERY);
		$this->fragment = parse_url($url, PHP_URL_FRAGMENT);
	}
	public function __set($name, $value) {
		// depricated
	}
	public function __get($name) {
		if(isset($this->$name)) {
			return $this->$name;
		}
		return null; // depricated
	}
	public function __isset($name) {
		return isset($this->$name);
	}
	public function __unset($name) {
		// depricated
	}
	/*public function __toString() {
		$ret = isset($this->user) ? $this->user . (isset($this->pass) ? ":{$this->pass}" : "") . "@" : "";
		$ret .= isset($this->host) ? $this->host : "";
		$ret = (isset($this->scheme) ? "{$this->scheme}:" : "") . (!empty($ret) ? "//" : "") . $ret;
		$ret .= isset($this->path) ? (!empty($ret) ? "/" : "") . $this->path : "";
		$ret .= isset($this->query) ? "?{$this->query}" : "";
		$ret .= isset($this->fragment) ? "#{$this->fragment}" : "";
		return $ret;
	}*/
}
?>