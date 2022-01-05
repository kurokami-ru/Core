<?php
namespace Core\STL;

use Core\STL\ArrayAccess;

interface ContainerInterface extends ArrayAccess, \Iterator, \Countable {
	public function offsetExists(mixed $offset): bool;
	public function offsetGet(mixed $offset): mixed;
	public function offsetSet(mixed $offset, mixed $value): void;
	public function offsetUnset(mixed $offset): void;
	public function offsetNext(mixed $offset): void;
	public function offsetPrev(mixed $offset): void;

	public function position(mixed $offset): void;
	public function current(): mixed;
	public function key(): mixed;
	public function prev(): void;
	public function next(): void;
	public function rewind(): void;
	public function valid(): bool;

	public function count(): int;
}
?>