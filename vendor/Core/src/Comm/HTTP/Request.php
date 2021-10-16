<?php

namespace Core\Comm\HTTP;

use Core\Comm\HTTP\Message;
use InvalidArgumentException;
use function strtoupper;

class Request extends Message {
    /** @var string */
    //private $method;
    /** @var string */
    //private $target;
    /** @var string */
    //private $version;

    /**
     * @param string                                         $method       HTTP method for the request.
     * @param string|UriInterface                            $target       URL for the request.
     * @param string                                         $version      HTTP protocol version.
     * @param array<string,string|string[]>                  $head         head for the message.
     * @param string|ReadableStreamInterface|StreamInterface $body         message body.
     * @throws \InvalidArgumentException for an invalid URL or body
     */
	public function __construct($method, $target, $version, $head, $body) {
        //if(is_string($target)) {
        //    $target = new URI($target);
		//}
        //if(!($target instanceof URI)) {
        //    throw new InvalidArgumentException('URI must be a string or URI');
        //}
		$this->method = strtoupper($method);
		$this->target = $target;
		$this->version = $version;
		parent::__construct($head, $body);
	}
}
?>
