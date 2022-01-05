<?php
namespace Core\Render;

use Core\Render\RenderInterface;

class Native implements RenderInterface {
	protected $template;
	public function __construct(string $template) {
		$this->template = $template;
	}
	public function render(array $data = []) {
		$tmpFile = tmpfile();
		$tmpName = stream_get_meta_data($tmpFile)['uri'];
		fwrite($tmpFile, $this->template);
		rewind($tmpFile);
		extract($data);
		ob_start();
		include($tmpName);
		return ob_get_clean();
	}
}
?>