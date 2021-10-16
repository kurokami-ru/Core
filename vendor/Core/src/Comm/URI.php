<?php

namespace Core\Comm;

use Psr\Http\Message\UriInterface;
use InvalidArgumentException;
use function parse_url;

/*
 * Basic PSR-7 URI implementation.
 */
class Uri /*implements UriInterface*/ {
    /** @var string Uri scheme. */
    //private $scheme = '';
    /** @var string Uri user name. */
    //private $user = '';
    /** @var string Uri user pass. */
	//private $pass = '';
    /** @var string Uri host. */
    //private $host = '';
    /** @var int|null Uri port. */
    //private $port;
    /** @var string Uri path. */
    //private $path = '';
    /** @var string Uri query string. */
    //private $query = '';
    /** @var string Uri fragment. */
    //private $fragment = '';

    /*
     * @param string $uri URI to parse and wrap.
     */
    public function __construct($uri = null) {
		if(!is_null($uri)) {
			if(!($parts = parse_url($uri))) {
                throw new InvalidArgumentException("Unable to parse URI: $uri");
            }
			if(isset($parts['scheme'])) {
				$this->scheme = rtrim(strtolower($parts['scheme']), ':/');
			}
			if(isset($parts['user'])) {
				$this->user = $parts['user'];
				if(isset($parts['pass'])) {
					$this->pass = $parts['pass'];
				}
			}
			if(isset($parts['host'])) {
				$this->host = $parts['host'];
				if(isset($parts['port'])) {
					$this->port = $parts['port']; // filter
				}
			}
			if(isset($parts['path'])) {
				$this->path = $parts['path']; // filter
			}
			if(isset($parts['query'])) {
				$this->query = $parts['query']; // filter
			}
			if(isset($parts['fragment'])) {
				$this->fragment = $parts['fragments']; // filter
			}
		}
	}
	public function __toString() {
        $str = '';
        if(!empty($this->scheme)) {
            $str .= $this->scheme . '://';
        }
        if(!empty($this->user)) {
            $str .= $this->user;
			if(!empty($this->pass)) {
				$str .= ":" . $this->pass;
			}
        }
        if(!empty($this->path)) {
            $str .= $path;
        }
        if(!empty($this->query)) {
            $str .= '?' . $this->query;
        }
        if(!empty($this->fragment)) {
            $str .= '#' . $this->fragment;
        }
        return $str;
	}
}
?>