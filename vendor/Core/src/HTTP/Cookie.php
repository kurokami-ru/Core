<?php

namespace Core\HTTP;

class Cookie {
    protected $name;
    protected $value;
    protected $expires;
	protected $maxage;
    protected $path;
    protected $domain;
    protected $secure;
    protected $httponly;
	protected $samesite;

	public function __construct(string $name, string $value = "", int $expires = 0, string $path = "", string $domain = "", bool $secure = false, bool $httponly = false) {
		$this->name = $name;
		$this->value = $value;
		$this->expire = $expire;
		$this->maxage = null;
		$this->path = $path;
		$this->domain = $domain;
		$this->secure = $secure;
		$this->httponly = $httponly;
		$this->samesite = '';
	}
	public function __toString(): string {
		$str = "{$this->name}={$this->value}";
		if($this->expires != 0) {
			$str .= "; Expires=" . gmdate('D, j M Y G:i:s T', $this->expires);
		}
		if(!is_null($this->maxage)) {
			$str .= "; Max-Age={$this->maxage}";
		}
		if(!empty($this->path)) {
			$str .= "; Path={$this->path}";
		}
		if(!empty($this->domain)) {
			$str .= "; Domain={$this->domain}";
		}
		if($this->secure) {
			$str .= "; Secure";
		}
		if($this->httponly) {
			$str .= "; HttpOnly";
		}
		if(!empty($this->samesite)) {
			$str .= "; SameSite={$this->samesite}";
		}
		return $str;
	}
}
?>
