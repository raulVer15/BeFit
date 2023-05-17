<?php

require_once PROJECT_ROOT_PATH . "/Model/Database.php";
class UserModel extends Database
{
	public function getAllUsers($limit){
		return $this->select("SELECT * FROM user order by ID ASC LIMIT ?", ["i", $limit]);
	}
	public function getUser($ID){
		return $this->select("SELECT * FROM user where ID = ?", ["i", $ID]);
	}
	public function searchUsers($search){
		$temp = "SELECT * FROM user where username like '%$search%'";
		return $this->select($temp);
	}
	public function addUser($username, $password, $email){
		$hashed = password_hash($password, PASSWORD_DEFAULT);
		$param = Array($username, $hashed, $email);
		//print_r($params);
		return $this->insert("INSERT INTO user(username, password, email) values (?, ?, ?)", ["sss", $param]);
	}
}

?>
