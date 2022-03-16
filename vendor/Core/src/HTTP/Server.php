<?php

namespace Core\HTTP;

use Core\HTTP\ServerInterface;
use Core\HTTP\Request;
use Core\HTTP\UploadedFile;
use Core\HTTP\Response;
use Core\HTTP\ResponseStatusInterface;

class Server implements ServerInterface {
	public function recive():Request {
		$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
		$target = $_SERVER['REQUEST_URI'];
		$version = $_SERVER['SERVER_PROTOCOL'] ?? 'HTTP/1.1';
		//$head = apache_request_headers();
		foreach($_SERVER as $key => $val) {
			if(substr($key, 0, strlen('HTTP_')) == 'HTTP_') {
				$head[ucwords(strtolower(strtr(substr($key, strlen('HTTP_')), '_', '-')), '-')] = $val;
			}
		}
		unset($head['Cookie']);
		$cookie = $_COOKIE;
		$body = null;
		if(isset($_SERVER['CONTENT_TYPE'])) {
			$head['Content-Type'] = $_SERVER['CONTENT_TYPE'];
			if(substr($head['Content-Type'], 0, strlen('application/x-www-form-urlencoded')) == 'application/x-www-form-urlencoded') {
				$body = $_POST;
			}
			if(substr($head['Content-Type'], 0, strlen('multipart/form-data')) == 'multipart/form-data') {
				$files = [];
				foreach($_FILES as $name => $file) {
					$diff = (count($file, COUNT_RECURSIVE) - count($file)) / 5;
					if($diff == 0) {
						$files[$name] = new UploadedFile($file['tmp_name'], $file['size'], $file['error'], $file['name'], $file['type']);
						continue;
					}
					for($i = 0; $i < $diff; $i++) {
						$files[$name][] = new UploadedFile($file['tmp_name'][$i], $file['size'][$i], $file['error'][$i], $file['name'][$i], $file['type'][$i]);
					}
				}
				$body = array_merge(($_POST ?? []), ($files ?? []));
			}
		}
		/*
		if(isset($_SERVER['CONTENT_LENGTH'])) {
			$head['Contetnt-Length'] = $_SERVER['CONTENT_LENGTH'];
		}
		*/
		$request = new Request(
			$method,
			$target,
			$version,
			$head,
			$cookie,
			$body
		);
		return $request;
	}
	public function send(Response $response):void {
		$reason = ResponseStatusInterface::REASONS[$response->status];
		header("{$response->version} {$response->status} $reason", true, $response->status);
		foreach($response->cookie as $cookie) {
			header("Set-Cookie: $cookie");
		}
		foreach($response->head as $key => $val) {
			header("$key: $val");
		}
		echo $response->body;
	}
}
?>