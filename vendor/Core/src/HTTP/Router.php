<?php

namespace Core\HTTP;

use Core\STL\Container;
use Core\HTTP\HandlerInterface;
use Core\HTTP\Request;
use Core\HTTP\Response;
use Core\Comm\URL;
use Core\HTTP\Exception\MethodNotAllowedException;
use Core\HTTP\Exception\PageNotFoundException;

class Router extends Container implements HandlerInterface {
	public function __invoke(Request $request, HandlerInterface $callback = null): Response {
		foreach($this as $route) {
			$target = new URL($request->target);
			if($this->path('/'. trim($target->path,'/'), $route['rules']['path'], $params)) {
				if($this->method($request->method, $route['rules']['method'] ?? null)) {
					$query = array_merge(http_parse_query($target->query) ?? [], $params);
					$path = '/' . trim(preg_replace("/{[^}]*}/i", '', $route['rules']['path']), '/') . 
						(!empty($query) ? '?' . http_build_query($query) : '');
					$request = new Request(
						$request->method, 
						$path,
						$request->version,
						$request->head,
						$request->body
					);
					return $route['action']($request);
				}
				throw new MethodNotAllowedException;
			}
		}
		throw new PageNotFoundException;
	}
	protected function path($data, $param, &$matches): bool {
		preg_match_all('/{([^}]+)}/', $param, $keys);
		$keys = array_pop($keys);
		foreach($keys as $key) {
			$param = str_replace('{' . $key . '}', '(?P<' . $key . '>[^/]++)', $param);
		}
		$ret = preg_match("#^$param$#sD", $data, $matches);
		$matches = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
		return $ret;
	}
	protected function method($data, $param): bool {
		return !(isset($param) && !in_array($data, $param));
	}
}