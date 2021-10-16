<?php

namespace Core\Comm\HTTP;

use InvalidArgumentException;

class Message {
    /** @var array */
    //private $head;
    /** @var null|string */
    //private $body;

    /**
     * @param array<string,string|string[]>                  $head         head for the message.
     * @param string|ReadableStreamInterface|StreamInterface $body         message body.
     * @throws \InvalidArgumentException for an invalid URL or body
     */
	public function __construct($head, $body) {
		$this->head = $head;
		if(!is_string($body)) {
			new InvalidArgumentException('Invalid response body given');
		}
		$this->body = $body;
	}
}
?>
