<?php
namespace Core\DSO;

use Core\DSO\AdapterInterface;
use \mysqli;
use \mysqli_sql_exception;
use \RuntimeException;

class mySQL implements AdapterInterface {
	private $url;
	private $link;
	private $keyname;
	public function __construct(string $url) {
		$this->url = $url;
		//debug($this->url);
		$host = 'localhost';
		$user = 'root';
		$pass = '';
		mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
		try {
			$this->link = new mysqli($host, $user, $pass);
		} catch (mysqli_sql_exception $e) {
			throw new RuntimeException($e->getMessage(), $e->getCode(), $e);
		}
		$query = "SHOW INDEX FROM {$this->url} WHERE Key_name = \"PRIMARY\";";
		//debug($query);
		try {
			$result = $this->link->query($query, MYSQLI_USE_RESULT);
			$this->keyname = $result->fetch_assoc()['Column_name'];
			mysqli_free_result($result);
			//debug($this->keyname);
		} catch (mysqli_sql_exception $e) {
			throw new RuntimeException($e->getMessage(), $e->getCode(), $e);
		}
	}

 	public function offsetSet($offset, $value) {
		$fields = '';
		$values = '';
		$pairs = '';
		foreach($value as $key => $val) {
			$fields .= (!empty($fields) ? ', ' : '') . $this->link->real_escape_string($key);
			$values .= (!empty($values) ? ', ' : '') . (!is_numeric($val) ? '"' . $this->link->real_escape_string($val) . '"' : $val);
			$pairs .= (!empty($pairs) ? ', ' : '') . $this->link->real_escape_string($key) . ' = ' . (!is_numeric($val) ? '"' . $this->link->real_escape_string($val) . '"' : $val);
		}
		$query = "INSERT INTO {$this->url} ($fields) VALUES ($values) ON DUPLICATE KEY UPDATE $pairs LIMIT 1 ;";
		//debug($query);
		try {
			/*$result = */$this->link->query($query);
		} catch (mysqli_sql_exception $e) {
			throw new RuntimeException($e->getMessage(), $e->getCode(), $e);
		}
    }
    public function offsetGet($offset) {
		$query = "SELECT * FROM {$this->url} WHERE {$this->keyname} = $offset LIMIT 1;";
		//debug($query);
		try {
			$result = $this->link->query($query, MYSQLI_USE_RESULT);
			$value = $result->fetch_assoc();
			$result->free();
			return $value;						
		} catch (mysqli_sql_exception $e) {
			throw new RuntimeException($e->getMessage(), $e->getCode(), $e);
		}
    }
    public function offsetExists($offset) {
		$query = "SELECT COUNT(*) FROM {$this->url} WHERE {$this->keyname} = $offset LIMIT 1;";
		//debug($query);
		try {
			$result = $this->link->query($query, MYSQLI_USE_RESULT);
			$value = $result->fetch_assoc();
			$result->free();
			return ((int)$value['COUNT(*)'] > 0);
		} catch (mysqli_sql_exception $e) {
			throw new RuntimeException($e->getMessage(), $e->getCode(), $e);
		}
    }
    public function offsetUnset($offset) {
		$query = "DELETE FROM {$this->url} WHERE {$this->keyname} = $offset LIMIT 1;";
		//debug($query);
		try {
			/*$result = */$this->link->query($query);
		} catch (mysqli_sql_exception $e) {
			throw new RuntimeException($e->getMessage(), $e->getCode(), $e);
		}
    }

	private $position = 0;
	public function rewind() {
		$this->position = 0;
	}
	public function current() {
		return $this->offsetGet($this->key());
	}
	public function key() {
		$query = "SELECT * FROM {$this->url} LIMIT {$this->position}, 1;";
		//debug($query);
		try {
			$result = $this->link->query($query, MYSQLI_USE_RESULT);
			$value = $result->fetch_assoc();
			$result->free();
			return (int)$value[$this->keyname];
		} catch (mysqli_sql_exception $e) {
			throw new RuntimeException($e->getMessage(), $e->getCode(), $e);
		}
	}
	public function next() {
		++$this->position;
	}
	public function prev() {
		--$this->position;
		if($this->position < 0) {
			$this->position = 0;
		}
	}
	public function valid() {
		return $this->position < $this->count();
	}

	public function count() {
		$query = "SELECT COUNT(*) FROM {$this->url};";
		//debug($query);
		try {
			$result = $this->link->query($query, MYSQLI_USE_RESULT);
			$value = $result->fetch_assoc();
			$result->free();
			return (int)$value['COUNT(*)'];
		} catch (mysqli_sql_exception $e) {
			throw new RuntimeException($e->getMessage(), $e->getCode(), $e);
		}
	}
}