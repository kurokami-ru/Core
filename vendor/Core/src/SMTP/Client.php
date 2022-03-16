<?php

namespace Core\SMTP;

//use Core\CC\ClientInterface;
use Core\STL\URL;
//use Core\CC\Message;
use Core\SMTP\Exception\ServerConnectionFailedException;
use Core\SMTP\Exception\GreetingErrorException;
use Core\SMTP\Exception\AutorizationNotAllowedException;
use Core\SMTP\Exception\IncorrectUserException;
use Core\SMTP\Exception\WrongPasswordException;
use Core\SMTP\Exception\ServerNotAcceptedFromException;
use Core\SMTP\Exception\ServerNotAcceptedToException;
use Core\SMTP\Exception\ServerNotAcceptedDataException;
use Core\SMTP\Exception\SendingErrorException;
use Core\SMTP\Exception\QuitErrorException;

class Client /*implements ClientInterface*/ {
	public function __construct(string $host, ?int $port = null, ?float $timeout = null, ?string $user = null, ?string $pass = null) {
		if(!$this->conn = fsockopen($host, $port, $errno, $errstr, $timeout)) {
			throw new ServerConnectionFailedException; 
		}
		if(!str_starts_with($this->answer(), '220')) {
			throw new ServerConnectionFailedException; 
		}

		$this->command("EHLO $host\r\n");
		if(!str_starts_with($this->answer(), '250')) {
			$this->command("HELO $host\r\n");
			if(!str_starts_with($this->answer(), '250')) {
				throw new GreetingErrorException;
			}
		}

		$this->command("AUTH LOGIN\r\n");
		if(!str_starts_with($this->answer(), '334')) {
			throw new AutorizationNotAllowedException;
		}

		$this->command(base64_encode($user)."\r\n");
		if(!str_starts_with($this->answer(), '334')) {
			throw new IncorrectUserException;
		}

		$this->command(base64_encode($pass)."\r\n");
		if(!str_starts_with($this->answer(), '235')) {
			throw new WrongPasswordException;
		}
	}
	public function __destruct() {
		$this->command("QUIT\r\n");
		if(!str_starts_with($this->answer(), '221')) {
			throw new QuitErrorException;
		}
	}
	public function send(Message $request): Message {
		if(!$this->conn) {
			throw new ServerConnectionFailedException; 
		}

		preg_match('/<[^>]+>/', $request->head['From'], $email);
		$from = array_shift($email);
		preg_match('/<[^>]+>/', $request->head['To'], $email);
		$to = array_shift($email);
		$msg = (string)$request;
		
		$this->command("MAIL FROM:$from SIZE=" . strlen($msg) . "\r\n");
		if(!str_starts_with($this->answer(), '250')) {
			throw new ServerNotAcceptedFromException;
		}

		$this->command("RCPT TO:$to\r\n");
		if(!str_starts_with($this->answer(), '250')) {
			throw new ServerNotAcceptedToException;
		}

		$this->command("DATA\r\n");
		if(!str_starts_with($this->answer(), '354')) {
			throw new ServerNotAcceptedDataException;
		}

		$this->command($msg . "\r\n.\r\n");
		if(!str_starts_with($this->answer(), '250')) {
			throw new SendingErrorException;
		}

		return new Message;
	}
	protected function command($code) {
        if (!is_resource($this->conn)) {
			return;
		}
		message("Command: " . $code);
		fputs($this->conn, $code);
	}
	protected function answer() {
        if (!is_resource($this->conn)) {
			return false;
		}
		$data = '';
		while($str = fgets($this->conn, 515)) {
			$data .= $str;
            if (!isset($str[3]) || $str[3] === ' ' || $str[3] === '\r' || $str[3] === '\n') {
				break;
			}
		}
		message("Answer: " . $data);
		return $data;
	}
}
?>