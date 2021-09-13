<?php
namespace Core\DAO;

use \Core\DAO\File;

class Serial extends File {
	protected function unserialize() {
		$data = file_get_contents($this->url);
		return unserialize($data);
	}
	protected function serialize() {
		$data = [];
		foreach($this as $ind => $row) {
			$data[$ind] = $row;
		}
		$ret = serialize($data);
		file_put_contents($this->url, $ret);
	}
}