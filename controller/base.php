<?php
	abstract class Controller_base {
		
		protected static $user;
		protected static $title;
		protected static $main;
		protected static $bc = [];
		protected static $css = array(
			// CSS . 'base.css',
			// CSS . 'bootstrap/bootstrap-grid.min.css',
			// CSS . 'footable.bootstrap.min.css',
			// CSS . 'my.css',
			// CSS . 'style.css',
			// CSS . 'font-awesome.min.css',
		);
		protected static $js = array(
			'http://code.jquery.com/jquery-latest.min.js',
			// JS . 'jquery-1.11.0.min.js',
			// JS . 'jquery-ui.1.11.2.min.js',
			// JS . 'bootstrap.min.js',
			// JS . 'bootstrap-notify.min.js',		
			// JS . 'footable/footable.js',
			// JS . 'main.js',
		);
			
		abstract static function main($method, $id);

		protected function render($page, $data = []) {
			// print_r($page);
			// print_r($data);
				extract($data);
			
			if (preg_match('/([a-z_\/0-9]*)\.?\w*/i', $page, $result)) {
				// print_r($page);
				// print_r($result);
				// print_r(VIEW);
				include_once VIEW . $result[1] . '.html';
			}
		}

		protected static function showPage(){
			if (!IS_AJAX) {
				self::render('main/head',   ['css'  => self::$css, 'title' => self::$title]);
				self::render('main/header', ['user' => self::$user, 'bc' => self::$bc]);
				
				foreach (self::$main as $page => $data) {
					self::render($page, $data);
				}
				
				self::render('main/footer');
				self::render('main/script', ['js' => self::$js]);
			}
		}
		
		protected static function showError(){
			if(IS_AJAX) {
				$answer['error'] = 1;
				$answer['type'] = 'warning';
				$answer['text'] = 'У Вас не достаточно прав для работы с этим разделом!';
				echo json_encode($answer);
			}
			else {
				Controller_error::main('403');
				self::showPage();
			}
		}
		
		protected static function showNotFound(){
			if(IS_AJAX) {
				$answer['error'] = 1;
				$answer['type'] = 'warning';
				$answer['text'] = 'Указанной страницы не существует';
				echo json_encode($answer);
			}
			else {
				Controller_error::main('404');
				self::showPage();
			}
		}
	}