<?php

namespace Core\STL;

interface StreamInterface
{
    public function close();
    //public function detach();
    public function size();
    public function tell();
    public function eof();
    public function isReadable();
    public function isWritable();
    public function isSeekable();
    public function read($length);
    public function write($string);
	public function seek($offset, $whence = SEEK_SET);
    public function rewind();
    public function getContents();
    public function getMetadata($key = null);
    public function __toString();
}
?>