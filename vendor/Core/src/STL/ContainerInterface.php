<?php
namespace Core\STL;

use \Core\STL\ArrayAccess;
use \Iterator;
use \Countable;

interface ContainerInterface extends ArrayAccess, Iterator, Countable {
}
?>