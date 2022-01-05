<?php
namespace Core\Render;

interface RenderInterface {
	public function __construct(string $template);
	public function render(array $data = []): string;
}
?>