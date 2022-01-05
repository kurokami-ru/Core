<?php
namespace Users;

use Core\MVC\Model;
use Core\DSO\Native;
use Core\HTTP\Request;
use Core\HTTP\Response;
use Core\HTTP\ResponseStatusInterface;

class Controller extends \Core\MVC\Controller {
	public function __construct() {
		parent::__construct(new Model(new Native("../users.data.php")));
	}
	public function index(Request $request) {
		ob_start();
		echo "<h1>Users list</h1>";
		echo "<ul>\n";
		foreach($this->model as $row) {
			echo "<li>{$row['id']}: {$row['name']} {$row['email']}</li>\n";
		}
		echo "</ul>\n";
		return new Response(body: ob_get_clean());
	}
	public function login(Request $request) {
		$session = $request->session;
		if($request->method == 'POST') {
			$post = $request->body;
			if(isset($post['name']) && isset($post['pass'])) {
				foreach($this->model as $key => $row) {
					if($row['name'] == $post['name'] && $row['pass'] == $post['pass']) {
						$_SESSION['user'] = $key;
						return new Response(head: ['Location' => 'login']);
					}
				}
			}
		}
		
		ob_start();
		if(!isset($session->user)) {
			message("user not set in session");
			include "../Users/login.frm.php";
		} else {
			message("User {$this->model[$session->user]['name']} already login");
			echo "<p><a href=\"logout\">logout</a></p>";
		}
		return new Response(body: ob_get_clean());
	}
	public function logout(Request $request) {
		$session = $request->session;
		if(isset($session->user)) {
			unset($session->user);
		}
		ob_start();
		include "../Users/login.frm.php";
		return new Response(body: ob_get_clean());
	}
	public function signup(Request $request) {
		$session = $request->session;
		if($request->method == 'POST') {
			$post = $request->body;
			if(isset($post->name) && isset($post->pass) && isset($post->email)) {
				foreach($this->model as $key => $row) {
					if($row['name'] == $post->name) {
						return new Response(head: ['Location' => 'signup']);
					}
				}
				$id = 1;
				foreach($this->model as $key => $row) {
					if($row['id'] > $id) {
						$id = $row['id'];
					}
				}
				$id++;
				$this->model[$id] = ['id' => $id, 'name' => $post->name, 'pass' => $post->pass, 'email' => $post->email ];	
				return new Response(head: ['Location' => 'login']);
			}
		}

		ob_start();
		if(!isset($session->user)) {
			include "../Users/signup.frm.php";
		} else {
			message("User already {$session->user} login");
			echo "<p><a href=\"logout\">logout</a></p>";
		}
		return new Response(body: ob_get_clean());
	}
}
?>