<?php

namespace Core\Comm;

use Core\STL\ImmutableTrait;
use Core\Comm\Head;

class Message {
	protected $head;
	protected $body;

	use ImmutableTrait;
	
	public function __construct(array $head = [], mixed $body = null) {
		$this->head = $head;
		$this->body = $body;
	}
	public function __toString(): string {
		$str = '';
		foreach($this->head as $key => $val) {
			if(is_array($val)) {
				foreach($val as $row) {
					$str .= "$key: $row\r\n";
				}
			} else {
				$str .= "$key: $val\r\n";
			}
		}
		$str .= "\r\n";
		if(is_array($this->body)) {
			//boundary from head
			foreach($this->body as $message) {
				$str .= "--boundary\r\n";
				$str .= $message;
				$str .= "\r\n";
			}
			$str .= "--boundary--\r\n";
		} else {
			$str .= $this->body;
		}
		return $str;
	}
}
?>
