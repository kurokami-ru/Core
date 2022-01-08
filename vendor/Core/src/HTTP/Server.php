<?php

namespace Core\HTTP;

use Core\Comm\URL;
use Core\HTTP\Request;
use Core\HTTP\UploadedFile;
use Core\HTTP\Response;
use Core\HTTP\ResponseStatusInterface;
use Core\Session\GlobalSession;

class Server {
	public function recive(): Request {
		$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
		//$target = new URL($_SERVER['REQUEST_URI']);
		$target = $_SERVER['REQUEST_URI'];
		$version = isset($_SERVER['SERVER_PROTOCOL']) ? str_replace('HTTP/', '', $_SERVER['SERVER_PROTOCOL']) : '1.1';
		$head = [];
		foreach($_SERVER as $key => $val) {
			if(strpos($key, 'HTTP_') === 0) {
				$parts = explode('_', $key);
				array_shift($parts);
				$str = '';
				foreach($parts as $part) {
					$str .= (empty($str) ? '' : '-') . ucfirst(strtolower($part));
				}
				$head[$str] = $val;
			}
		}
		$body = null;
		if(!empty($_POST) || !empty($_FILES)) {
			$files = [];
			foreach($_FILES as $name => $file) {
				$diff = (count($file, COUNT_RECURSIVE) - count($file)) / 5;
				debug($diff);
				if($diff == 0) {
					$files[$name] = new UploadedFile($file['tmp_name'], $file['size'], $file['error'], $file['name'], $file['type']);
					continue;
				}
				for($i = 0; $i < $diff; $i++) {
					$files[$name][] = new UploadedFile($file['tmp_name'][$i], $file['size'][$i], $file['error'][$i], $file['name'][$i], $file['type'][$i]);
				}
			}
			$body = array_merge($_POST, $files);
		} else {
			$body = file_get_contents('php://input');
		}
		$request = new Request(
			$method,
			$target,
			$version,
			$head,
			$body
		);
		return $request;
	}
	public function send(Response $response): void {
		$reason = ResponseStatusInterface::REASONS[$response->status];
		header("HTTP/{$response->version} {$response->status} $reason", true, $response->status);
		foreach($response as $key => $val) {
			if(is_array($val)) {
				foreach($val as $row) {
					header("$key: $row");
				}
			} else {
				header("$key: $val");
			}
		}
		echo $response->body;
	}
}
?>