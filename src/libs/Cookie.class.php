<?php
/**
 * GithubPress
 * Copyright (c) 2012 GithubPress
 *
 * @author skiyo@me.com
 */
class Cookie {
	
	public static function set($key, $value, $expire = 0, $path = '/') {
		return setcookie($key, self::encrypt($value), $expire, $path);
	}
	
	public static function get($key) {
		return empty($_COOKIE[$key]) ? '' : self::decrypt($_COOKIE[$key]);
	}
	
	protected static function encrypt($string) {
		$key = md5(GithubPressConfig::COOKIE_ENCRYPT_KEY);
		$key_length = strlen($key);
		$string = substr(md5($string.$key), 0, 8).$string;
		$string_length = strlen($string);
		$rndkey = $box = array();
		$result = '';
		for($i = 0; $i <= 255; $i++) {
			$rndkey[$i] = ord($key{$i % $key_length});
			$box[$i] = $i;
		}
		for($j = $i = 0; $i < 256; $i++) {
			$j = ($j + $box[$i] + $rndkey[$i]) % 256;
			$tmp = $box[$i];
			$box[$i] = $box[$j];
			$box[$j] = $tmp;
		}
		for($a = $j = $i = 0; $i < $string_length; $i++) {
			$a = ($a + 1) % 256;
			$j = ($j + $box[$a]) % 256;
			$tmp = $box[$a];
			$box[$a] = $box[$j];
			$box[$j] = $tmp;
			$result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
		}
		return str_replace('=', '', base64_encode($result));
	}
	
	protected function decrypt($string) {
		$key = md5(GithubPressConfig::COOKIE_ENCRYPT_KEY);
		$key_length = strlen($key);
		$string = base64_decode($string);
		$string_length = strlen($string);
		$rndkey = $box = array();
		$result = '';
		for($i = 0; $i <= 255; $i++) {
			$rndkey[$i] = ord($key{$i % $key_length});
			$box[$i] = $i;
		}
		for($j = $i = 0; $i < 256; $i++) {
			$j = ($j + $box[$i] + $rndkey[$i]) % 256;
			$tmp = $box[$i];
			$box[$i] = $box[$j];
			$box[$j] = $tmp;
		}
		for($a = $j = $i = 0; $i < $string_length; $i++) {
			$a = ($a + 1) % 256;
			$j = ($j + $box[$a]) % 256;
			$tmp = $box[$a];
			$box[$a] = $box[$j];
			$box[$j] = $tmp;
			$result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
		}
		if(substr($result, 0, 8) == substr(md5(substr($result, 8).$key), 0, 8)) {
			return substr($result, 8);
		} else {
			return '';
		}
	}
}