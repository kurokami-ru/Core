<?php
namespace Core\DAO;

use \Core\DAO\File;

class Native extends File {
	protected function unserialize() {
		$data = file_get_contents($this->url);
		return eval(substr($data, 5, strlen($data) - 7));	
	}
	protected function serialize() {
		$ret = "";
		foreach($this as $ind => $row) {
			$str = "";
			foreach($row as $key => $val) {
				$str .= !empty($str) ? ", " : "";
				$str .= is_string($key) ? "\"$key\"" : $key;
				$str .= " => ";
				$str .= is_string($val) ? "\"$val\"" : $val;
			}
			$ret .= !empty($ret) ? ",\n" : "";
			$ind = is_string($ind) ? "\"$ind\"" : $ind;
			$ret .= "\t$ind => [ $str ]";
		}
		file_put_contents($this->url, "<?php\nreturn [\n$ret\n];\n?>");
	}
}