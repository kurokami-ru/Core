<?php

namespace Core\SMTP;

class Message extends \Core\Comm\Message {
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
			parse_str(str_replace(';', '&', $this->head['Content-Type']), $arr);
			$boundary = $arr['boundary'] ?? '';
			foreach($this->body as $message) {
				$str .= "--$boundary\r\n";
				$str .= $message;
				$str .= "\r\n";
			}
			$str .= "--$boundary--\r\n";
		} else {
			$str .= $this->body;
		}
		return $str;
	}
}
?>
