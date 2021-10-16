<?php
namespace Users;

class Controller extends \Core\MVC\Controller {
	public function __construct() {
		parent::__construct(new \Core\MVC\Model(new \Core\DAO\Native("../Users/data.php")));
	}
	public function list() {
		echo "<h1>list</h1>";
		echo "<ul>\n";
		foreach($this->model as $row) {
			echo "<li>{$row['id']}: {$row['name']} {$row['email']}</li>\n";
		}
		echo "</ul>\n";
	}
	public function login() {
		if(!isset($_SESSION['user'])) {
			include "../Users/login.frm.php";
		} else {
			message("User {$this->model[$_SESSION['user']]['name']} already login");
			echo "<p><a href=\"logout\">logout</a></p>";
		}
	}
	public function loginprocess() {
		if(isset($_POST['name']) && isset($_POST['pass'])) {
			foreach($this->model as $key => $row) {
				//message("Login process function $key");
				if($row['name'] == $_POST['name'] && $row['pass'] == $_POST['pass']) {
					$_SESSION['user'] = $key;
					message("session store");
					header("Location: login");
				}
			}
		}
	}
	public function logoutprocess() {
		if(isset($_SESSION['user'])) {
			unset($_SESSION['user']);
		}
		include "../Users/login.frm.php";
	}
	public function signup() {
		if(!isset($_SESSIOM['user'])) {
			include "../Users/signup.frm.php";
		} else {
			message("User already {$_SESSION['user']} login");
			echo "<p><a href=\"logout\">logout</a></p>";
		}
	}
	public function signupprocess() {
		debug($_POST);
		if(isset($_POST['name']) && isset($_POST['pass']) && isset($_POST['email'])) {
			foreach($this->model as $key => $row) {
				if($row['name'] == $_POST['name']) {
					message("{$_POST['name']} already exits");
					header("Location: signup");
				}
			}
			message("Add new user {$_POST['name']}");
			$id = 1;
			foreach($this->model as $key => $row) {
				if($row['id'] > $id) {
					$id = $row['id'];
				}
			}
			$id++;
			$this->model[$id] = ['id' => $id, 'name' => $_POST['name'], 'pass' => $_POST['pass'], 'email' => $_POST['email'] ];	
			echo "<p><a href=\"login\">Войдите</a></p>";
		}
	}
}
?>