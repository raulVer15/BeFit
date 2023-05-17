<?php

require_once PROJECT_ROOT_PATH . "/Model/Database.php";
class FollowModel extends Database
{
	public function getFollowers($userID){
		return $this->select("SELECT count(*) FROM Following where userFollowedID = ?", ["i", $userID]);
	}
	public function getFollowing($userID){
		return $this->select("SELECT count(*) FROM Following where userID = ?", ["i", $userID]);
	}
	public function addFollowing($userID, $userFollowedID){
		$temp = "INSERT INTO Following values (?,?)";
		$param = Array($userID, $userFollowedID);
		return $this->insert($temp, ["ii", $param]);
	}
	public function deleteFollowing($userID, $userFollowedID){
		$temp = "DELETE FROM Following where userID = ? and userFollowedID = ?";
		$param = Array($userID, $userFollowedID);
		return $this->delete($temp, ["ii", $param]);
	}
}
?>
