<?php
	session_start();
	include_once 'config.php';
	include_once 'function.php';
	include_once 'model/db.php';
	include_once 'route.php';

function __autoload($class) {
	//echo $class;
	// $dirs = array(
	// 	__DIR__ . '\\',
	// 	__DIR__ . '\controller\\',
	// 	__DIR__ . '\model\\',
	// 	__DIR__ . '\view\\'
	// );
	// echo '<pre>';
	// print_r($dirs);
	// foreach ($dirs as $dir) {
	// 	if (file_exists($dir . $class . '.php')) {
	// 		require_once($dir . $class . '.php');
	// 	}
	// }
	$class = str_replace('_', '/', $class . '.php');
	if (file_exists($class)) {
		include_once $class;
	}
	
}
Route::start($_SERVER['REQUEST_URI']);