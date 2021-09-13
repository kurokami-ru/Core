<?php
namespace Core\DAO;

use \Core\STL\Container;

abstract class Adapter {
	protected $url;
	public function __construct($url) {
		$this->url = $url;
	}
}
?>