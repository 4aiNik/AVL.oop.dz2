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
				case 'show':
					self::show();
					break;
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
				'user' => self::$user,
			],
		];
		//}
	}
	static function edit($id) {
		//echo 'edit ' . $id;
		if (IS_AJAX) {

			$answer['error'] = 1;
			$answer['text']  = 'Ошибка обращения к серверу';
			$answer['type']  = 'danger';

			if (isset($id) || isset($_POST['newTitle']) || isset($_POST['newText']) || isset($_POST['newTags'])){
				$newTitle = $_POST['newTitle'];
				$newText = $_POST['newText'];
				$newTags = $_POST['newTags'];

				$data['table'] = 'news';
				$data['values'] = ['name' => $newTitle, 'date' => date('Y-m-d'), 'author' => self::$user['name'], 'text' => $newText, 'tags' => $newTags];
				$data['where'] = ['id' => $id];

				if(DB::update($data)) {
					$answer['error'] = 0;
					$answer['text']  = 'new edit';
					$answer['type']  = 'success';
				} else {
					$answer['text']  = 'Ошибка обрашения к серверу базы данных';
					$answer['type']  = 'danger';
				}
				echo json_encode($answer);
			}
		} else {
			die('error 404');
		}
	}
	static function remove($id) {
		//echo 'remove ' . $id;
		if (is_int($id)) {
			$data['table'] = 'news';
			$data['where'] = ['id' => $id];
			if (DB::remove($data)) {
				header("Location: ".SUBSERVER."news/show/");
			} else {
				die('error 404');
			}
		}
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

				if(DB::insert($data)) {
					$answer['error'] = 0;
					$answer['text']  = 'new add';
					$answer['type']  = 'success';
				} else {
					$answer['text']  = 'Ошибка обрашения к серверу базы данных';
					$answer['type']  = 'danger';
				}
				echo json_encode($answer);
			}
		} else {
			die('error 404');
		}
	}
}