<?php

namespace Core\Comm;

use Core\Comm\Message;

interface ClientInterface {
	public function send(Message $request): Message;
}
?>