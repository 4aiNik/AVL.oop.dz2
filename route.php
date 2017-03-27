<?php
class Route {
	//белые списки допустимых запросов к системе
	public static $patterns = array(
		'Controller_main' => [
			'#^' . SUBSERVER . '$#',
			'#^' . SUBSERVER . 'main/$#',
			'#^' . SUBSERVER . 'main/(auth)/$#',
			'#^' . SUBSERVER . 'main/(enterAuth)/$#',
			'#^' . SUBSERVER . 'main/(reg)/$#',
			'#^' . SUBSERVER . 'main/(enterReg)/$#',
			'#^' . SUBSERVER . 'main/(logout)/$#',
			'#^' . SUBSERVER . '(auth)/$#',
			'#^' . SUBSERVER . '(enterAuth)/$#',
			'#^' . SUBSERVER . '(reg)/$#',
			'#^' . SUBSERVER . '(enterReg)/$#',
			'#^' . SUBSERVER . '(logout)/$#',
		],
		'Controller_news' => [
			'#^' . SUBSERVER . 'news/$#',
			'#^' . SUBSERVER . 'news/(show)/$#',
			'#^' . SUBSERVER . 'news/(show)/([0-9]+)/$#',
			'#^' . SUBSERVER . 'news/(add)/$#',
			'#^' . SUBSERVER . 'news/(edit)/([0-9]+)/$#',
			'#^' . SUBSERVER . 'news/(remove)/([0-9]+)/$#',
		],
		'Error' => [
			'#^.*$#'
		],
	);
	public static function start($url) {

		// print_r($url);
		// echo '<br>';

		foreach (self::$patterns as $class => $list) {
			foreach ($list as $pattern) {
				if (preg_match($pattern, $url, $info)) {
					$method = isset($info[1]) && $info[1] !== '' ? htmlspecialchars($info[1]) : 'index';
					$id = isset($info[2]) ? (int)$info[2] : 0;
					break 2;
				}
			}
		}
// echo '<br>';
// echo '<br>';
		// print_r($info);
		// echo '<br>';
		// print_r($class);
		// echo '<br>';
		// print_r($method);
		// echo '<br>';
		// print_r($id);

		$path = str_replace('_', '/', $class) . '.php';
		if ($class != 'Error'AND file_exists($path)) {
			include_once $path;
			$class::main($method, $id);
			// if ($id) {
			// 	$class::$method($id);
			// } else {
			// 	$class::$method();
			// }
		} else {
			die('ERRORRRRRRRRRRR');
		}
	// 	//контроллер и действие по умолчанию
	// 	$controller_name = 'Controller_main';
	// 	$action_name = 'index';

	// 	$route = $_SERVER['REQUEST_URI']; //полный адрес, по которому обратился пользователь
	// 	$url = str_replace('myoop/', '', trim($route, '/')); //обрезаем
	// 	$info = explode('/', $url); //разбиваем на массив
	// 	// print_r($info);
	// 	//получаем имя контроллера
	// 	if (!empty($info[1])) {
	// 		$controller_name = $info[1];
	// 	}
	// 	//получаем имя метода
	// 	if (!empty($info[2])) {
	// 		$action_name = $info[2];
	// 	}
	// 	// $controller_file = strtolower($controller_name).'.php';
	// 	// $controller_path = "controller/".$controller_file;
	// 	// if(file_exists($controller_path)) {
	// 	// 	include $controller_path;
	// 	// } else {
	// 	// 	die("запрашиваемой страницы не существует");
	// 	// }
	// 	//наличие класса в файле
	// 	if(class_exists($controller_name)) {
	// 		$controller = new $controller_name;
	// 		$action = $action_name;
	// 	} else {
	// 		die("запрашиваемой страницы не существует");
	// 	}
	// 	//наличие метода в классе
	// 	if(method_exists($controller, $action)) {
	// 		$controller->$action();
	// 	} else {
	// 		die("запрашиваемой страницы не существует");
	// 	}
 	}

 	public static function main($method, $id){}
}
// Route::start();
//echo '<pre>';
//print_r(Route::$patterns);
//print_r($_SERVER['REQUEST_URI']);