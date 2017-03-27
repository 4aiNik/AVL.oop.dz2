<?php
	function getHash($size = 32) {
		$str  = "abcdefghijklmnopqrstuvwxyz0123456789";
		$hash = "";
		$len  = strlen($str) - 1;
		
		for ($i = 0; $i < $size; $i++) {
			$hash.= $str[rand(0, $len)];
		}
		return $hash;
	}
