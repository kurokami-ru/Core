<?php
spl_autoload_register(function($classname) {
	$autoload = function($url, $classname) use(&$autoload) {
		foreach(scandir($url) as $name) {
			$real = $url . '/' . $name;
			if(is_dir($real) && $name != '.' && $name != '..') {
				$compfile = strtr($real . '/composer.json', '\\', '/');
				if(file_exists($compfile)) {
					$comp = json_decode(file_get_contents($compfile), true);
					if(isset($comp['autoload']['psr-4'])) {
						$param = $comp['autoload']['psr-4'];
						foreach($param as $key => $val) {
							if(substr($classname, 0, strlen($key)) == $key) {
								$filename = strtr(__DIR__.'/'.$key.$val.substr($classname, strlen($key)) . '.php', '\\', '/');
								if(file_exists($filename)) {
									require_once($filename);
								}
							}
						}
					}
				} else {
					$autoload($real, $classname);
				}
			}
		}
	};
	$autoload(__DIR__, $classname);
});
?>