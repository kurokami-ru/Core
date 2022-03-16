<?php

namespace Core\STL;

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
			$str .= "$key: $val\r\n";
			/*if(is_array($val)) {
				foreach($val as $item) {
					$str .= "$key: $item\r\n";
				}
			} else {
				$str .= "$key: $val\r\n";
			}*/
		}
		$str .= "\r\n";
		$str .= $this->body;
		return $str;
	}
}
?>
