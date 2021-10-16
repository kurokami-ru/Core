<?php
namespace Core\DAO;

use \Core\STL\Container;

abstract class AbstarctFileBased extends Container implements AdapterInterface {
	protected $url;
	public function __construct($url) {
		$this->url = $url;
		parent::__construct($this->unserialize());
	}

	public function offsetSet($offset, $value) {
        parent::offsetSet($offset, $value);
		$this->serialize();
    }
    public function offsetGet($offset) {
        return parent::offsetGet($offset);
    }
    public function offsetExists($offset) {
        return parent::offsetExists($offset);
    }
    public function offsetUnset($offset) {
        parent::offsetUnset($offset);
		$this->serialize();
    }
}
?>