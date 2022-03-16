<?php

namespace Core\STL;

use Core\STL\MIMEInterface;
use Core\STL\ImmutableTrait;
use InvalidArgumentException;

class URL implements MIMEInterface {
    protected $scheme;
    protected $user;
	protected $pass;
    protected $host;
    protected $port;
    protected $path;
    protected $query;
	protected $fragment;

	use ImmutableTrait;
    public function __construct(string $url) {
		if(!($parts = parse_url($url))) {
			throw new InvalidArgumentException;
		}
		$this->scheme = $parts['scheme'] ?? null;
		$this->user = $parts['user'] ?? null;
		$this->pass = $parts['pass'] ?? null;
		$this->host = $parts['host'] ?? null;
		$this->port = $parts['port'] ?? null;
		$this->path = $parts['path'] ?? null;
		$this->query = $parts['query'] ?? null;
		$this->fragment = $parts['fragment'] ?? null;
	}
	public function __toString():string {
		$str = '';
		if(isset($this->scheme)) {
			$str .= $this->scheme . '://';
		}
		if(isset($this->host)) {
			if(isset($this->user)) {
				$str .= $this->user;
				if(isset($this->pass)) {
					$str .= ':' . $this->pass;
				}
				$str .= '@';
			}
			$str .= $this->host;
			if(isset($this->port)) {
				$str .= ':' . $this->port;
			}
		}
        if(isset($this->path)) {
            $str .= $this->path;
        }
        if(isset($this->query)) {
			$str .= '?' . $this->query;
        }
		if(isset($this->fragment)) {
			$str .= '#' . $this->fragment;
		}
		return $str;
	}
	public function mime() {
		$ext = strtolower(pathinfo((string)$this->path, PATHINFO_EXTENSION));
		if(isset(self::MIME_TYPES[$ext])) {
			return self::MIME_TYPES[$ext];
		}
		return 'unknown';
	}
}
?>