<?php
namespace Core\STL;

use \Core\STL\ContainerInterface;

class Container implements ContainerInterface {
	private $storage;
	public function __construct($input = []) {
		$this->storage = $input;
	}

    public function offsetSet($offset, $value) {
        $this->storage[$offset] = $value;
    }
    public function offsetGet($offset) {
        return $this->storage[$offset];
    }
    public function offsetExists($offset) {
        return isset($this->storage[$offset]);
    }
    public function offsetUnset($offset) {
        unset($this->storage[$offset]);
    }

	private $position = 0;
	public function rewind() {
		$this->position = 0;
	}
	public function current() {
		return $this->offsetGet($this->key());
	}
	public function key() {
		$keys = array_keys($this->storage);
		return $keys[$this->position];
	}
	public function next() {
		++$this->position;
	}
	public function prev() {
		--$this->position;
		if($this->position < 0) {
			$this->position = 0;
		}
	}
	public function valid() {
		return $this->position < $this->count();
	}

	public function count() {
		return count($this->storage); 
	}
}