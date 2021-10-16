<?php

namespace Core\STL;

use StreamInterface;

class Stream implements StreamInterface
{
	protected $stream;
	public function __construct($stream) {
		$this->stream = $stream;
	}
    public function close() {
		fclose($this->stream);
	}
    //public function detach();
    public function size() {
		$stats = fstat($this->stream);
		return $stats['size'] ?? null;		
	}
	public function tell() {
		return ftell($this->stream);
	}
	public function eof() {
		return feof($this->stream);
	}
	public function isReadable() {
		$meta = $this->metadata();
		if(strpbrk($meta['mode'], 'r+') !== false) {
			return true;
		}
		return false;
	}
	public function isWritable() {
		$meta = $this->metadata();
		if($meta['mode'] != 'r') {
			return true;
		}
		return false;
	}
	public function isSeekable() {
		$meta = $this->getMetadata();
		return $meta['seekable'] ?? false;
	}
	public function seek($offset, $whence = SEEK_SET) {
		return fseek($this->stream, $offset, $whence);
	}
	public function rewind() {
		return rewind($this->stream);
	}
	public function read($length) {
		return fread($this->stream, $length);
	}
	public function write($string) {
		return fwrite($this->stream, $string);
	}
    public function getMetadata($key = null) {
		$metadata = stream_get_meta_data($this->stream);
		if(!is_null($key)) {
			return $metadata[$key];
		}
		return $metadata;
	}
	public function getContents() {
		return stream_get_contents($this->stream);
	}
    public function __toString() {
		$this->rewind();
		return $this->contents();
	}
}
?>