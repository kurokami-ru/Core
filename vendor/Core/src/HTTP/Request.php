<?php
namespace Core\HTTP;

class Request extends Message {
	private $method;
	protected $target;
	public function __construct($method = "GET", $target = "", $protokol = "HTTP/1.1", $headers = [], $body = null) {
		parent::__construct($protokol, $headers, $body);
		$this->method = $method;
		$this->target = $target;
	}
	public function __toString() {
		$ret = "{$this->method} {$this->target} {$this->protokol}\r\n";
		foreach($this->headers as $key => $val) {
			$ret .= "$key: $val\r\n";
		}
		$ret .= "\r\n";
		$ret .= $this->body;
		return $ret;
	}
}
?>