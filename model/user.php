<?php
	class Model_user extends DB {
		
		public static function getByToken() {
			if(isset($_COOKIE['PHPSESSID']) AND isset($_SESSION['token'])) {
				return DB::getRow('
					SELECT 
						id_user    AS id,
						mode,
						login,
						name
					FROM user
					WHERE user_session = "' . DB::escape($_COOKIE['PHPSESSID']) . '"
					AND   user_token   = "' . DB::escape($_SESSION['token']) . '";
				');
			}
			else {
				return false;
			}
		}
		
		public static function getIdByAuth($login, $pass) {
			return DB::getValue('
				SELECT id_user 
				FROM user
				WHERE login = "' . DB::escape($login) . '"
				AND   pass  = "' . md5($pass) . '";
			');
		}

		public static function getIdByReg($login) {
			return DB::getValue('
				SELECT id_user 
				FROM user
				WHERE login = "' . DB::escape($login) . '";
			');
		}
	}