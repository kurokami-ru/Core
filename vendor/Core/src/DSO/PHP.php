<?php
namespace Core\DSO;

use Core\DSO\AbstractFileBased;

class PHP extends AbstractFileBased {
	protected function unserialize(): mixed {
		if(file_exists($this->url)) {
			$data = file_get_contents($this->url);
			return unserialize($data);
		}
		return [];
	}
	protected function serialize(): void {
		$data = [];
		foreach($this as $ind => $row) {
			$data[$ind] = $row;
		}
		file_put_contents($this->url, serialize($data));
	}
}