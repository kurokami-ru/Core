<?php

namespace Core\STL;

use Core\STL\ContainerInterface;

class Container implements ContainerInterface {
	private $storage;
	public function __construct($input = []) {
		$this->storage = $input;
	}

    public function offsetExists(mixed $offset): bool {
        return isset($this->storage[$offset]);
    }
    public function offsetGet(mixed $offset): mixed {
        return $this->storage[$offset];
    }
    public function offsetSet(mixed $offset, mixed $value): void {
        $this->storage[$offset] = $value;
    }
    public function offsetUnset(mixed $offset): void {
        unset($this->storage[$offset]);
    }
	public function offsetNext(mixed $offset): void {
		$this->position($offset);
		$this->next();
	}
	public function offsetPrev(mixed $offset): void {
		$this->position($offset);
		$this->prev();
	}

	private $position = 0;
	public function position(mixed $offset): void {
		$keys = array_keys($this->storage);
		$this->position = array_search($offset, $keys);
	}
	public function current(): mixed {
		return $this->storage[$this->key()];
	}
	public function key(): mixed {
		$keys = array_keys($this->storage);
		return $keys[$this->position];
	}
	public function prev(): void {
		--$this->position;
	}
	public function next(): void {
		++$this->position;
	}
	public function rewind(): void {
		$this->position = 0;
	}
	public function valid(): bool {
		return $this->position !== false && $this->position > -1 && $this->position < $this->count();
	}

	public function count(): int {
		return count($this->storage); 
	}
}
?>