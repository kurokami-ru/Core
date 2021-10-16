<?php

namespace Core\Comm\HTTP;

use Core\Comm\HTTP\Message;
use InvalidArgumentException;

class Response extends Message {
    /** @var int */
    //private $status;
    /** @var string */
    //private $version;

    /**
     * @param int                                            $status  HTTP status code (e.g. 200/404)
     * @param string                                         $version HTTP protocol version (e.g. 1.1/1.0)
     * @param array<string,string|string[]>                  $head    additional response headers
     * @param string|ReadableStreamInterface|StreamInterface $body    response body
     * @throws \InvalidArgumentException for an invalid body
     */
    public function __construct($status, $version, $head, $body) {
		$this->status = $status;
		$this->version = $version;
		parent::__construct($head, $body);
	}
}
?>