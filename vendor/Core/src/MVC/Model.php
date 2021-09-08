<?php
namespace Core\MVC;

use \Core\STL\ContainerInterface;

class Model implements ContainerInterface {
	private $adapter;
	public function __construct($adapter) {
		$this->adapter = $adapter;
	}

    public function offsetSet($offset, $value) {
		$this->adapter->offsetSet($offset, $value);
    }
    public function offsetGet($offset) {
        return $this->adapter->offsetGet($offset);
    }
    public function offsetExists($offset) {
        return offsetExists($offset);
    }
    public function offsetUnset($offset) {
        $this->adapter->offsetUnset($offset);
    }

	public function rewind() {
		$this->adapter->rewind();
	}
	public function current() {
		return $this->adapter->current();
	}
	public function key() {
		return $this->adapter->key();
	}
	public function next() {
		$this->adapter->next();
	}
	public function prev() {
		$this->adapter->prev();
	}
	public function valid() {
		return $this->adapter->valid();
	}

	public function count() {
		return $this->adapter->count();
	}
}
?>