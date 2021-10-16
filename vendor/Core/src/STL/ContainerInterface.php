<?php
namespace Core\STL;

use Core\STL\ArrayAccess;
use Iterator;
use Countable;

interface ContainerInterface extends ArrayAccess, Iterator, Countable {
	public function offsetNext($offset);
	public function offsetPrev($offset);

	public function position($offset);
}
?>