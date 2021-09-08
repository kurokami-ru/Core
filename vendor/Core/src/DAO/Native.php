<?php
namespace Core\DAO;

use \Core\DAO\Adapter;

class Native extends Adapter {
	protected $url;
	public function __construct($url) {
		$this->url = $url;
		parent::__construct($this->unserialize());
	}

	private function unserialize() {
		$data = file_get_contents($this->url);
		return eval(substr($data, 5, strlen($data) - 7));	
	}
	private function serialize($data) {
		$ret = "";
		foreach($this as $row) {
			$str = "";
			foreach($row as $key => $val) {
				$str .= !empty($str) ? ", " : "";
				$str .= is_string($key) ? "\"$key\"" : $key;
				$str .= " => ";
				$str .= is_string($val) ? "\"$val\"" : $val;
			}
			$ret .= !empty($ret) ? ",\n" : "";
			$ret .= "\t[ $str ]";
		}
		file_put_contents($this->url, "<?php\nreturn [\n$ret\n];\n?>");
	}

	public function offsetSet($offset, $value) {
        $this[$offset] = $value;
		$this->serialize();
    }
    public function offsetGet($offset) {
        return $this[$offset];
    }
    public function offsetExists($offset) {
        return isset($this[$offset]);
    }
    public function offsetUnset($offset) {
        unset($this[$offset]);
		$this->serialize();
    }
}