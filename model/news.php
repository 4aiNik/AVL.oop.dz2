<?php
include_once 'text.php';

class Model_news extends Text {
	protected $author;
	protected $type = 'news';

	function save() {}
	function update() {}
	function delete() {}
	function show() {}
	static function showList() {
		$info = DB::getAll('
			SELECT * FROM `news`;
		');
		return $info;
	}
}

// DB::connect('localhost', 'root', '', 'oop');
// $news = new News(1);
// echo '<pre>';
// print_r($news);