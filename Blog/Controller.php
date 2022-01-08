<?php

namespace Blog;

use Core\MVC\Model;
use Core\DSO\Native;
use Core\HTTP\Request;
use Core\HTTP\Response;
use Core\HTTP\ResponseStatusInterface;
use Core\CC\URL;

class Controller extends \Core\MVC\Controller {
	function __construct() {
		parent::__construct(new Model(new Native("../blog.data.php")));
	}
	function index() {
		ob_start();
		echo "<h1>Blog</h1>";
		echo "<ul>\n";
		foreach($this->model as $row) {
			echo "<li><a href='/post/{$row['id']}'><h2>{$row['title']}</h2><p>{$row['summary']}</p></a></li>\n";
		}
		echo "</ul>\n";
		return new Response(body: ob_get_clean());
		//(new Native("Blog/Templates/Index.php"))->render($this->model);
	}
	function read(Request $request) {
		$query = http_parse_query((new URL($request->target))->query);
		ob_start();
		foreach($this->model as $row) {
			if($query['id'] == $row['id']) {
				echo "<h1>{$row['title']}</h1>\n";
				echo "<p>{$row['summary']}</p>\n";
			}
		}
		return new Response(body: ob_get_clean());
		//(new Native("Blog/Templates/Read.php"))->render($this->model->filter(["id" => $param]));
	}
}
?>