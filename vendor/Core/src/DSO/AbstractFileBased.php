<?php
namespace Core\DSO;

use Core\STL\Container;
use Core\DSO\AdapterInterface;

abstract class AbstractFileBased extends Container implements AdapterInterface {
	protected $url;

	protected function unserialize(): mixed {}
	protected function serialize(): void {}

	public function __construct(string $url) {
		$this->url = $url;
		parent::__construct($this->unserialize());
	}

	public function offsetSet(mixed $offset, mixed $value): void {
        parent::offsetSet($offset, $value);
		$this->serialize();
    }
    public function offsetGet(mixed $offset): mixed {
        return parent::offsetGet($offset);
    }
    public function offsetExists(mixed $offset): bool {
        return parent::offsetExists($offset);
    }
    public function offsetUnset(mixed $offset): void {
        parent::offsetUnset($offset);
		$this->serialize();
    }
}
?>