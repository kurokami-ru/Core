<?php
namespace Core\HTTP;

class Message implements \Core\STL\ObjectAccess {
	protected $protokol;
	protected $headers;
	protected $body;
	public function __construct($protokol = "HTTP/1.1", $headers = [], $body = null) {
		$this->protokol = $protokol;
		$this->headers = $headers;
		$this->body = $body;
	}
	public function __get($name) {
		return $this->$name;
	}
	public function __set($name, $value) {
		throw new Exception("$name read only", 1);
	}
	public function __isset($name) {
		return isset($this->name);
	}
	public function __unset($name) {
		throw new Exception("$name read only", 1);
	}
}
?>