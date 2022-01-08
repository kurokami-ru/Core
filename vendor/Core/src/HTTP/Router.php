<?php

namespace Core\HTTP;

use Core\STL\Container;
use Core\HTTP\HandlerInterface;
use Core\HTTP\Request;
use Core\HTTP\Response;
use Core\CC\URL;
use Core\HTTP\Exception\MethodNotAllowedException;
use Core\HTTP\Exception\PageNotFoundException;

class Router extends Container implements HandlerInterface {
	public function __invoke(Request $request, HandlerInterface $callback = null): Response {
		foreach($this as $route) {
			$target = new URL($request->target);
			$path = '/'. trim($target->path, '/');
			$template = $route['path'];
			preg_match_all('/{([^}]+)}/', $template, $keys);
			$keys = array_pop($keys);
			foreach($keys as $key) {
				$template = str_replace('{' . $key . '}', '(?P<' . $key . '>[^/]++)', $template);
			}
			if(preg_match("#^$template$#sD", $path, $matches)) {
				$matches = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);		
				$query = array_merge(http_parse_query($target->query) ?? [], $matches);
				$request = new Request(
					$request->method, 
					$path . (!empty($query) ? '?' . http_build_query($query) : ''),
					$request->version,
					$request->head,
					$request->body
				);
				return $route['action']($request);
			}
		}
		throw new PageNotFoundException;
	}
}