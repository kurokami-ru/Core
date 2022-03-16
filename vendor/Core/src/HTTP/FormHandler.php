<?php

namespace Core\HTTP;

use Core\HTTP\HandlerInterface;
use Core\HTTP\Request;
use Core\HTTP\Response;
use Core\HTTP\ResponseStatusInterface;

class FormHandler implements HandlerInterface {
	public function __invoke(Request $request): Response {
		ob_start();
		?>
		<form method="post" enctype="multipart/form-data" action="action">
		<!--form method="post" action="action"-->
		<!--input type="file" name="file[]"  multiple />
		<input type="file" name="file[]" />
		<input type="file" name="file" /-->
		<input type="file" name="file2" />
		<input type="text" name="name" />
		<input type="submit" value="Submit" />
		</form>
		<?php
		$body = ob_get_clean();
		$response = new Response(
			ResponseStatusInterface::STATUS_OK,
			'HTTP/1.1', 
			[
				'Expires' => 'Thu, 19 Nov 1981 08:52:00 GMT',
				'Cache-Control' => 'no-store, no-cache, must-revalidate',
				'Pragma' => 'no-cache'
			], 
			//"<h1>Hello, world</h1>\n"
			$body
		);
		return $response;
	}
}