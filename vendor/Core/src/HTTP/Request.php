<?php

namespace Core\HTTP;

use Core\Comm\Message;
use Core\STL\ImmutableTrait;
use Core\Session\GlobalSession;

class Request extends Message {
    protected $method;
    protected $target;
    protected $version;
	
	public $session;
	
	use ImmutableTrait;

	public function __construct(string $method = 'GET', string $target = '/', string $version = '1.1',
		array $head = [], mixed $body = null) {
		$this->method = strtoupper($method);
		$this->target = $target;
		$this->version = $version;
		parent::__construct($head, $body);
		$this->session = new GlobalSession;
	}
	public function __toString(): string {
		$str = '';
		$str .= "{$this->method} {$this->target} HTTP/{$this->version}\r\n";
		$str .= parent::__toString();
		return $str;
	}
}
?>
