<?php

namespace Core\SMTP;

use Core\Comm\ClientInterface;
use Core\Comm\URL;
use Core\Comm\Message;

class Client implements ClientInterface {
	public function __construct(URL $url, ?float $timeout = null) {
		if(!$this->conn = fsockopen($url->scheme . '://' . $url->host, $url->port, $errno, $errstr, 10)) {
			throw new ServerConnectionFailedException; 
		}
		$this->response('');
		if(!$this->dialog("EHLO {$url->host}\r\n", '250')) {
			if(!$this->dialog("HELO {$url->host}\r\n", '250')) {
				throw new GreetingErrorException;
			}
		}

		if(!$this->dialog("AUTH LOGIN\r\n", '334')) {
			throw new AutorizationNotAllowedException;
		}

		if(!$this->dialog(base64_encode($url->user)."\r\n", '334')) {
			throw new IncorrectUserException;
		}

		if(!$this->dialog(base64_encode($url->pass)."\r\n", '235')) {
			throw new WrongPasswordException;
		}
	}
	public function send(Message $request): Message {
		//$from = 'rukurokami@yandex.ru';
		preg_match('/<[^>]+>/', $request->head['From'], $email);
		$from = array_shift($email);
		//$to = 'rukurokami@yandex.ru';
		preg_match('/<[^>]+>/', $request->head['To'], $email);
		$to = array_shift($email);
		$msg = (string)$request;

		if(!$this->dialog("MAIL FROM:$from SIZE=" . strlen($msg) . "\r\n", '250')) {
			throw new ServerNotAcceptedFromException;
		}

		if(!$this->dialog("RCPT TO:$to\r\n", '250')) {
			throw new ServerNotAcceptedToException;
		}

		if(!$this->dialog("DATA\r\n", '354')) {
			throw new ServerNotAcceptedDataException;
		}

		if(!$this->dialog($msg . "\r\n.\r\n", '250')) {
			throw new SendingErrorException;
		}

		return new Message;
	}
	public function __destruct() {
		if(is_resource($this->conn)) {
			if(!$this->dialog("QUIT\r\n", '221')) {
				throw new QuitErrorException;
			}
			fclose($this->conn);
		}
	}
	protected function dialog($command, $response) {
		if(!is_resource($this->conn))
			return false;
		$this->command($command);
		return $this->response($response);
	}
	protected function command($code) {
		message("Command: " . $code);
		fputs($this->conn, $code);
	}
	protected function response($code) {
        if (!is_resource($this->conn)) {
			return false;
		}
		$data = "";
        while(is_resource($this->conn) && !feof($this->conn)) {
        	$str = fgets($this->conn, 515);
			$data .= $str;
            if (!isset($str[3]) || $str[3] === ' ' || $str[3] === '\r' || $str[3] === '\n') {
				break;
			}
		}
		message("Answer: " . $data);
		return (substr($data, 0, strlen($code)) == $code);
	}
}
?>