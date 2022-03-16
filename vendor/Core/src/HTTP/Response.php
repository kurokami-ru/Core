<?php

namespace Core\HTTP;

use Core\STL\Message;
use Core\STL\ImmutableTrait;
use Core\HTTP\ResponseStatusInterface;
//use Core\HTTP\Cookie;

class Response extends Message {
    protected $status;
    protected $version;

	protected $cookie = [];

	use ImmutableTrait;

    public function __construct(int $status = ResponseStatusInterface::STATUS_OK, string $version = 'HTTP/1.1', array $head = [], mixed $body = null) {
		$this->status = $status;
		$this->version = $version;
		parent::__construct($head, $body);
	}
	public function setcookie(string $name, string $value = "", int $expires = 0, string $path = "", string $domain = "", bool $secure = false, bool $httponly = false) {
		$this->cookie[] = new Cookie($name, $value, $expires, $path, $domain, $secure, $httponly);
	}
	public function __toString(): string {
		$str = '';
		$reason = ResponseStatusInterface::REASONS[$this->status];
		$str .= "{$this->version} {$this->status} $reason\r\n";
		foreach($this->cookie as $cookie) {
			$str .= "Set-Cookie: $cookie\r\n";
		}
		$str .= parent::__toString();
		return $str;
	}
}
?>