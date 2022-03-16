<?php

namespace Core\HTTP;

use Core\HTTP\UploadedFileStatusInterface;
use Core\STL\ImmutableTrait;

class UploadedFile implements UploadedFileStatusInterface {
	private $stream;
	private $size;
	private $error;
	private $name;
	private $mime;

	use ImmutableTrait;

	public function __construct(string $stream, int $size, int $error, string $name, string $mime) {
		$this->stream = $stream;
		$this->size = $size;
		$this->error = $error;
		$this->name = $name;
		$this->mime = $mime;
	}
}
?>
