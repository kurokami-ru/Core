<?php

namespace Core\HTTP;

use Core\CC\Message;
use Core\STL\ImmutableTrait;
use Core\HTTP\ResponseStatusInterface;

class Response extends Message {
    protected $status;
    protected $version;

	use ImmutableTrait;

    public function __construct(int $status = ResponseStatusInterface::STATUS_OK, string $version = '1.1', array $head = [], mixed $body = null) {
		$this->status = $status;
		$this->version = $version;
		parent::__construct($head, $body);
	}
	public function __toString(): string {
		$str = '';
		$reason = ResponseStatusInterface::REASONS[$this->status];
		$str .= "HTTP/{$this->version} {$this->status} $reason\r\n";
		$str .= parent::__toString();
		return $str;
	}
}
?>