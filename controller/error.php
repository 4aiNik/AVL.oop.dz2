<?php
class Controller_error extends Controller_base {

	static function main($method, $id) {
		switch ($method) {
				case 'index':
					self::err404();
					break;
				case 'error':
					self::errConnect();
					break;
				default:
					//die('mfdie');
					self::err404();
			}
			self::showPage();
	} 

	protected static function err404() {
		self::$title = 'Ошибка';
		self::$main = [
			'index/err' => [
				'text' => 'NOT FOUND',
			],
		];
		$info = "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
		self::logError('404', 'Not Found', $info);
	}

	protected static function errConnect() {
		self::$title = 'Ошибка';
		self::$main = [
			'index/err' => [
				'text' => 'SERVICE UNAVAILABLE',
			],
		];
		self::logError('503', 'Service Unavailable');
	}

	private static function logError($code, $text, $info = '') {
		if (!file_exists('logs')) {
			mkdir('logs', 0755);
		}

		$f = fopen('logs/error.txt', 'a');
		$str = date('d m y h:i:s', time()) . "\t" . $code . "\t" . $text . "\t" . $info . "\r\n";
		fwrite($f, $str);
		fclose($f);
	}
}