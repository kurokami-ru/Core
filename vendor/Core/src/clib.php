<?php
function http_parse_query(?string $query):?array {
	if(!isset($query)) {
		return null;
	}
	if(empty($query)) {
		return [];
	}
	parse_str($query, $ret);
	return $ret;
}

function encode($data) {
	return "=?utf-8?Q?".str_replace("+","_",str_replace("%","=",urlencode($data)))."?=";
}

function parse_string(string $query):?array {
	$ret = null;
	$arr = explode(';', $query);
	foreach($arr as $item) {
		$res = explode('=', $item, 2);
		$ret[trim($res[0])] = isset($res[1]) ? trim($res[1]) : '';
	}
	return $ret;
}

function build_string(array $arr):string {
	$ret = '';
	foreach($arr as $key => $val) {
		$ret .= (!empty($ret) ? '; ' : '') . "$key=$val";
	}
	return $ret;
}
?>