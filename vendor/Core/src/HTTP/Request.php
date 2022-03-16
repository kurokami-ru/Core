<?php

namespace Core\HTTP;

use Core\STL\Message;
use Core\STL\ImmutableTrait;
use Core\HTTP\Session\Model as Session;

class Request extends Message {
    protected $method;
    protected $target;
    protected $version;
	
	protected $cookie;
	protected $session;

	use ImmutableTrait;

	public function __construct(string $method = 'GET', string $target = '/', string $version = 'HTTP/1.1',
		?array $head = [], ?array $cookie = [], mixed $body = null) {
		$this->method = strtoupper($method);
		$this->target = $target;
		$this->version = $version;
		$this->cookie = $cookie;
		$this->session = new Session;
		parent::__construct($head, $body);
	}
	public function __toString(): string {
		$str = '';
		$str .= "{$this->method} {$this->target} {$this->version}\r\n";
		foreach($this->head as $key => $val) {
			$str .= "$key: $val\r\n";
		}
		if(isset($this->cookie)) {
			$str .= 'Cookie: ' . build_string($this->cookie);
		}
		$str .= "\r\n";
		$str .= $this->body;
		return $str;
	}
}
?>
