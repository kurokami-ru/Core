<?php
return [
	//'ac1' => function($data) { message("ac1 action"); debug($data); }
	'ac1' => function($data) { echo (new \Core\Render\Native(file_get_contents("../Blog/list.php")))->render(['data' => $data]); }
];
?>