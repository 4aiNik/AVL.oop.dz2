<?php
class Controller_main extends Controller_base {

	static function main($method, $id) {
		if (self::$user = Model_User::getByToken()){
			switch ($method) {
				// case 'auth':
				// 	self::enter();
				// 	break;
				case 'logout':
					self::logout();
					break;
				default:
					self::index();
			}
			self::showPage();
		} else {
			switch ($method) {
				case 'enterAuth': 
					self::enterAuth();
					break;
				case 'enterReg': 
					self::enterReg();
					break;
				case 'auth':
					self::auth();
					break;
				case 'reg':
					self::reg();
					break;
				default:
					self::index();
			}
			self::showPage();
		}
	}

	protected static function index() {
		// self::$css[] = CSS . 'bootstrap.min.css';
		self::$title = 'Главная';
		self::$main = [
			'index/main' => [
				'user' => self::$user,
			],
		];
	}

	protected static function auth() {
			// self::$css[] = CSS . 'bootstrap.min.css';
			// self::$css[] = CSS . 'css_login.css';
			// self::$js[]  = 'http://code.jquery.com/jquery-latest.min.js';
			self::$js[]  = JS  . 'auth.js';
			self::$title = 'Авторизация';
			self::$main = [
				'index/auth' => [],
			];
		}

	protected static function enterAuth() {
		if (IS_AJAX) {
			$answer['error'] = 1;
			$answer['text']  = 'Ошибка обращения к серверу';
			$answer['type']  = 'danger';
			
			if (isset($_POST['login']) AND isset($_POST['pass'])) {
				$id = Model_user::getIdByAuth($_POST['login'], $_POST['pass']);
				
				if ($id) {
					$answer['error'] = 0;
					$session = $_COOKIE['PHPSESSID'];
					$token   = getHash();
					$_SESSION['token'] = $token;
					
					$data['table']  = 'user';
					$data['values'] = array(
						'user_session' => $session,
						'user_token'   => $token,
					);
					$data['where'] = array('id_user' => $id);
					
					if (DB::update($data)) {
						$answer['text']  = 'Welcome';
						$answer['type']  = 'success';
					// header('Location:' . MAIN);
					}
					else {
						$answer['text']  = 'Ошибка обрашения к серверу базы данных';
						$answer['type']  = 'danger';
					}
				}
				else {
					$answer['text']  = 'Неверная связка логин/пароль';
					$answer['type']  = 'warning';
				}
			}
			else {
				$answer['text']  = 'Укажите логин/пароль';
				$answer['type']  = 'warning';
			}
			
			echo json_encode($answer);
			// print_r($answer);
		}
		else {
			die('error 404');
		}
	}
	protected static function reg() {
		self::$js[]  = JS  . 'reg.js';
		self::$title = 'Регистрация';
		self::$main = [
			'index/reg' => [],
		];
	}

	protected static function enterReg() {
		if (IS_AJAX) {

			$answer['error'] = 1;
			$answer['text']  = 'Ошибка обращения к серверу';
			$answer['type']  = 'danger';

			if (isset($_POST['name']) AND isset($_POST['surname']) AND isset($_POST['login']) AND isset($_POST['pass'])) {
				$name = DB::escape($_POST['name']);
				$surname = DB::escape($_POST['surname']);
				$login = DB::escape($_POST['login']);
				$pass = md5($_POST['pass']);
				$id = Model_user::getIdByReg($_POST['login']);
				if ($id) {
					$answer['text']  = 'Такой пользователь уже существует';
					$answer['type']  = 'warning';
				} else {
					$answer['error'] = 0;

					$session = $_COOKIE['PHPSESSID'];
					$token   = getHash();
					$_SESSION['token'] = $token;

					$data['table']  = 'user';
					$data['values'] = array(
						'name' => $name,
						'surname' => $surname,
						'login' => $login,
						'pass' => $pass,
						'mode' => 'user',
						'user_session' => $session,
						'user_token'   => $token,
					);
					if (DB::insert($data)) {
						$answer['text']  = 'Welcome';
						$answer['type']  = 'success';
					}
					else {
						$answer['error'] = 1;
						$answer['text']  = 'Ошибка обрашения к серверу базы данных';
						$answer['type']  = 'danger';
					}
				}
				echo json_encode($answer);
			}
		}else {
			die('error 404');
		}
	}

	private static function logout() {

		$mySession = $_COOKIE['PHPSESSID'];
		$myToken = $_SESSION['token'];

		$data['table'] = 'user';
		$data['values'] = ['user_session' => NULL, 'user_token' => NULL];
		$data['where'] = ['user_session' => $mySession, 'user_token' => $myToken];

		if (DB::update($data)) {
			unset($_SESSION['token']);
			unset($_COOKIE['PHPSESSID']);
			
			header('Location:' . MAIN);
		} else {
			die('error 404');
		}
	}
}