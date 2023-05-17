<?php

require_once PROJECT_ROOT_PATH . "/Model/Database.php";
class ProfileModel extends Database
{
	public function getProfile($postID){
		return $this->select("SELECT * FROM Profile where userID = ?", ["i", $postID]);
	}
}