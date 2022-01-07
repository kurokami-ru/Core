<?php

namespace Core\Comm;

use Core\STL\ImmutableTrait;

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
		$str .= $this->body;
		return $str;
	}
}
?>
