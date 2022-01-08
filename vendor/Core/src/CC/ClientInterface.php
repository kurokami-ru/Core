<?php

namespace Core\CC;

use Core\CC\Message;

interface ClientInterface {
	public function send(Message $request): Message;
}
?>