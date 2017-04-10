<?php
class DB {
	static private $_instance;
	public $connect;

	private function __construct() {
		$this->connect = mysqli_connect('localhost', 'root', '', 'oop');
		mysqli_set_charset($this->connect, 'utf8');
		if (mysqli_connect_errno()) {
			header('Location: http://localhost/myoop4/error/');
		}
	}

	static public function connect() {
		// self::$_connect = mysqli_connect($host, $user, $pass, $db);
		// mysqli_set_charset(self::$_connect, 'utf8');
		if (self::$_instance === null) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}
	private function __clone(){}
	private function __sleep(){}
	private function __wakeup(){}

	static function getValue($query) {
		$db = self::connect();
		if ($db->connect) {
			$info = mysqli_query($db->connect, $query);
			if (mysqli_num_rows($info)) {
				$data = mysqli_fetch_array($info);
				return $data[0];
			} else {
				return null;
			}
		} else {
			return false;
		}
	}

	static function getRow($query) {
		$db = self::connect();
		if ($db->connect) {
			$str = mysqli_query($db->connect, $query);

			if ($code = mysqli_errno($db->connect)) {
				$text = mysqli_error($db->connect);
				Err::logDbError($code, $text, $str);
			} else {
				if (mysqli_num_rows($str)) {
					return mysqli_fetch_assoc($str);
				} else {
					return null;
				}
			}

		} else {
			return false;
		}
	}

	static function getAll($sql) {
		$db = self::connect();
		if ($db->connect) {
			$info = mysqli_query($db->connect, $sql);
			while ($infoOne = $info->fetch_assoc()) {
				$messages[] = $infoOne;
			}
			return $messages;
		}else {
			return false;
		}
	}

	static function update($arr = array()) {
			$db = self::connect();
			
			extract($arr, EXTR_OVERWRITE);

			if (!isset($table) OR !isset($values) OR !isset($where)) {
				return false;
			}else {
				$query = 'UPDATE ' . DB::escape($table) . ' SET ';
				
				foreach($values as $column => $value) {
					$query.= DB::escape($column) . ' = "' . DB::escape($value) . '",';
				}
				$query = trim($query, ',');
				$query.= ' WHERE 1 ';
				foreach ($where as $col => $val) {
					$query.= ' AND ' . DB::escape($col) . ' = "' . DB::escape($val) . '"';
				}
				mysqli_query($db->connect, $query);
				if (mysqli_errno($db->connect)) {
					return false;
				}else {
					return true;
				}
			}
		}

	static function insert($arr = array()) {
		$db = self::connect();

		extract($arr, EXTR_OVERWRITE);

		if (!isset($table) OR !isset($values)) {
			return false;
		}else {
			$query = 'INSERT INTO ' . DB::escape($table) . ' SET ';
			foreach ($values as $column => $value) {
				$query.= DB::escape($column) . ' = "' . DB::escape($value) . '",';
			}
			$query = trim($query, ',');
			mysqli_query($db->connect, $query);
			if (mysqli_errno($db->connect)) {
				return false;
			}else {
				return true;
			}
		}
	}

	static function remove($arr = array()) {
		$db = self::connect();

		extract($arr, EXTR_OVERWRITE);

		if (!isset($table) OR !isset($where)) {
			return false;
		} else {
			$query = 'DELETE FROM ' . DB::escape($table);
			$query.= ' WHERE 1 ';
			foreach ($where as $col => $val) {
				$query.= ' AND ' . DB::escape($col) . ' = ' . DB::escape($val);
			}
			mysqli_query($db->connect, $query);
			if (mysqli_errno($db->connect)) {
				return false;
			}else {
				return true;
			}
		}
	}

	static function escape($str) {
		$db = self::connect();
		return $db->connect ? mysqli_real_escape_string($db->connect, $str) : false;
	}
}
// $con = DB::connect();
// echo '<pre>';
// print_r($con->connect);
// echo '<br>';
// $con2 = DB::connect();
// print_r($con2->connect);
?>