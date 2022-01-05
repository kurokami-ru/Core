<?php
namespace Core\MVC;

use Core\STL\ContainerInterface;
use Core\DSO\AdapterInterface;

class Model implements ContainerInterface {
	private $adapter;
	public function __construct(AdapterInterface $adapter) {
		$this->adapter = $adapter;
	}

    public function offsetExists(mixed $offset): bool {
        return offsetExists($offset);
    }
    public function offsetGet(mixed $offset): mixed {
        return $this->adapter->offsetGet($offset);
    }
    public function offsetSet(mixed $offset, mixed $value): void {
		$this->adapter->offsetSet($offset, $value);
    }
    public function offsetUnset(mixed $offset): void {
        $this->adapter->offsetUnset($offset);
    }
	public function offsetNext(mixed $offset): void {
		$this->adapter->offsetNext($offset);
	}
	public function offsetPrev(mixed $offset): void {
		$this->adapter->offsetPrev($offset);
	}

	public function position(mixed $offset): void {
		$this->adapter->position($offset);
	}
	public function current(): mixed {
		return $this->adapter->current();
	}
	public function key(): mixed {
		return $this->adapter->key();
	}
	public function prev(): void {
		$this->adapter->prev();
	}
	public function next(): void {
		$this->adapter->next();
	}
	public function rewind(): void {
		$this->adapter->rewind();
	}
	public function valid(): bool {
		return $this->adapter->valid();
	}

	public function count(): int {
		return $this->adapter->count();
	}
/*
	public function column($offset) {
		$ret = [];
		foreach($this as $key => $val) {
			$ret[$key] = $val[$offset];
		}
		return $ret;
	}
	private $filter = [];
	public function setfilter($input = []) {
		$last = $this->filter;
		$this->filter = $input;
		return $last;
	}
*/
}
?>