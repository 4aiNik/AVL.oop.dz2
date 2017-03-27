<?php
abstract class Content {
	protected $id, $name, $date, $type;
	abstract function save();
	abstract function update();
	abstract function show();
	abstract static function showList();

	function __construct($id) {
		$info = DB::getRow(
			'SELECT * FROM '.$this->type.' WHERE `id` = '.$id.';'
		);
		if($info) {
			foreach($info as $key => $val) {
				$this->$key = $val;
			}
		}
	}
}