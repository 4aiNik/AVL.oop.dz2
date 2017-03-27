<?php
class Controller_news extends Controller_main{

	static function main($method, $id) {
		if (self::$user = Model_User::getByToken()){
			switch ($method) {
				case 'show':
					self::show();
					break;
				case 'add':
					self::add();
					break;
				case 'edit':
					self::edit($id);
					break;
				case 'remove':
					self::remove($id);
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

	// static function index() {
	// 	echo 'news ok';
	// }
	static function show() {
		// $message = Model_news::showList();
		// echo '<pre>';
		// print_r($message);
		// self::render('index/news', array('messages' => $message));
		// self::$js[]  = JS  . 'auth.js';
		self::$title = 'Показ новостей';
		self::$js[]  = JS  . 'newsForm.js';
		self::$main = [
			'index/news' => [
				'messages' => Model_news::showList(),
			],
		];
		//}
	}
	static function edit($id) {
		echo 'edit ' . $id;
	}
	static function remove($id) {
		echo 'remove ' . $id;
	}
	static function add() {
		if (IS_AJAX) {

			$answer['error'] = 1;
			$answer['text']  = 'Ошибка обращения к серверу';
			$answer['type']  = 'danger';

			if (isset($_POST['newsTitle']) || isset($_POST['newsText']) || isset($_POST['newsTags'])){
				$newsTitle = $_POST['newsTitle'];
				$newsText = $_POST['newsText'];
				$newsTags = $_POST['newsTags'];

				$data['table'] = 'news';
				$data['values'] = ['name' => $newsTitle, 'date' => date('Y-m-d'), 'author' => self::$user['name'], 'text' => $newsText, 'tags' => $newsTags];

				if(DB::add($data)) {
					$answer['error'] = 0;
					$answer['text']  = 'new add';
					$answer['type']  = 'success';
				} else {
					$answer['text']  = 'Ошибка обрашения к серверу базы данных';
					$answer['type']  = 'danger';
				}
//todo: данные загнать в базу, соответственно создать метод DB::add($data)
				echo json_encode($answer);
			}
		} else {
			die('error 404');
		}
	}
}