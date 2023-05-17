<?php

require_once PROJECT_ROOT_PATH . "/Model/Database.php";
class PRModel extends Database
{
	public function getUserPR($userID){
		return $this->select("SELECT * FROM PR where userID = ?", ["i", $userID]);
	}
	public function updatePR($part, $newPR, $userID){
		$temp = "UPDATE PR set $part = ? where userID = ?";
		$param = Array($newPR, $userID);
		return $this->update($temp, ["ii", $param]);
	}
}
?>
