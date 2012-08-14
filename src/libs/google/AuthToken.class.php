<?php
/**
 * 此类修改自goo.gl URL Shortener的js.
 * 原来的版权很严格.我只是为了学习.所以大家低调使用= =||
 */
class AuthToken {
	private function c() {
		$num = func_num_args();
		$args = func_get_args();
		for ($l = 0, $m = 0;$m < $num;$m++){
			$l += $args[$m] & 4294967295;
		}
		return $l;
	}
	private function d($l) {
		$m = $l = (string)($l > 0 ? $l : ($l + 4294967296));
		for ($o = 0, $n = false, $p = strlen($m) - 1; $p >= 0; --$p) {
			$q = $m{$p};
			if($n) {
				$q *= 2;
				$o += floor($q/10) + $q%10;
			} else {
				$o += $q;
			}
			$n = !$n;
		}
		$m = $o%10;
		$o = 0;
		if($m != 0) {
			$o = 10 - $m;
			if(strlen($l) % 2 == 1) {
				if($o % 2 == 1) {
					$o += 9;
				}
				$o /= 2;
			}
		}
		$m = (string)$o;
		$m .= $l;
		return $m;
	}
	private function e($l) {
		$len = strlen($l);
		for ($m = 5381, $o = 0; $o < $len; $o++) {
			$m = $this->c($m << 5, $m, ord($l{$o}));
		}
		return $m;
	}
	private function f($l) {
		$len = strlen($l);
		for ($m = 0, $o = 0; $o < $len; $o++) {
			$m = (int)$this->c(ord($l{$o}), $m << 6, $m << 16, -$m);
		}
		return $m;
	}
	public function getAuthToken($h) {
		$i = $this->e($h);

		$i = $i >> 2 & 1073741823;
		$i = $i >> 4 & 67108800 | $i & 63;
		$i = $i >> 4 & 4193280 | $i & 1023;
		$i = $i >> 4 & 245760 | $i & 16383;
		$j = '7';

		$h = $this->f($h);
		$k = ($i >> 2 & 15) << 4 | $h & 15;
		$k |= ($i >> 6 & 15) << 12 | ($h >> 8 & 15) << 8;
		$k |= ($i >> 10 & 15) << 20 | ($h >> 16 & 15) << 16;
		$k |= ($i >> 14 & 15) << 28 | ($h >> 24 & 15) << 24;
		$j .= $this->d($k);

		return $j;
	}
}