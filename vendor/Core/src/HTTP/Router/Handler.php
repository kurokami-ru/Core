<?php

namespace Core\HTTP\Router;

use Core\HTTP\HandlerInterface;
use Core\HTTP\Request;
use Core\HTTP\Response;
use Core\HTTP\Router\Exception\PageNotFoundException;
use Core\HTTP\Router\Exception\MethodNotAllowedException;

class Handler implements HandlerInterface {
	public function __construct($map) {
		$this->map = $map;
	}
	public function __invoke(Request $request): Response {
		foreach($this->map as $template => $root) {
			preg_match_all('#{([^}]+)}#', $template, $keys);
			$keys = array_pop($keys);
			foreach($keys as $key) {
				$template = str_replace('{' . $key . '}', '(?P<' . $key . '>[^/]++)', $template);
			}
			$path = parse_url($request->target, PHP_URL_PATH);
			if(preg_match("#^$template$#sD", $path, $matches)) {
				$matches = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);		
				$query = array_merge(http_parse_query(parse_url($request->target, PHP_URL_QUERY)) ?? [], $matches);
				$request = new Request(
					$request->method, 
					$path . (!empty($query) ? '?' . http_build_query($query) : ''),
					$request->version,
					$request->head,
					$request->cookie,
					$request->body
				);
				if(!is_callable($root)) {
					foreach($root as $method => $action) {
						if($request->method == $method) {
							return $action($request);
						}
					}
					throw new MethodNotAllowedException;
				} else {
					return $root($request);
				}
			}
		}
		throw new PageNotFoundException;
	}
}
?>