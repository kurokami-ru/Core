<?php
namespace Core\HTTP\Session;

use Core\STL\ContainerInterface;

class Model implements ContainerInterface {
    public function offsetExists(mixed $offset): bool {
        return isset($_SESSION[$offset]);
    }
    public function offsetGet(mixed $offset): mixed {
        return $_SESSION[$offset];
    }
    public function offsetSet(mixed $offset, mixed $value): void {
        $_SESSION[$offset] = $value;
    }
    public function offsetUnset(mixed $offset): void {
        unset($_SESSION[$offset]);
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
		$keys = array_keys($_SESSION);
		$this->position = array_search($offset, $keys);
	}
	public function current(): mixed {
		return $_SESSION[$this->key()];
	}
	public function key(): mixed {
		$keys = array_keys($_SESSION);
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
		return count($_SESSION); 
	}
}
?>