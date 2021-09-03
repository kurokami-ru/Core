<?php
namespace Core\HTTP;

use \Core\HTTP\ResponseStatus;
use \Core\HTTP\Message;
use \Core\HTTP\Request;

class Response extends Message {
	protected $request;
	protected $status;
	public function __construct($request, $status = ResponseStatus::HTTP_OK, $protokol = "HTTP/1.1", $headers = [], $body = null) {
		parent::__construct($protokol, $headers, $body);
		$this->request = $request;
		$this->status = $status;
	}
	public function __toString() {
		$ret = "{$this->protokol} {$this->status} {ResponseStatus:reason($this->status)}\r\n";
		foreach($this->headers as $key => $val) {
			$ret .= "$key: $val\r\n";
		}
		$ret .= "\r\n";
		$ret .= $this->body;
		return $ret;
	}
}