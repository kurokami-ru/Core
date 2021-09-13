<?php
namespace Core\DAO;

use \Core\DAO\Adapter;

// depricate!
class Memory extends Adapter {
	protected $url;
	public function __construct($url) {
		$this->url = $url;
		parent::__construct($this->unserialize());
	}

	private function unserialize() {
		global ${$this->url};
		return ${$this->url};
	}
	private function serialize() {
		global ${$this->url};
		foreach($this as $ind => $row) {
			${$this->url}[$ind] = $row;
		}
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