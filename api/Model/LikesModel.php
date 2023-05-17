<?php

require_once PROJECT_ROOT_PATH . "/Model/Database.php";
class LikesModel extends Database
{
	public function getAllLikesByUser($userID){
		return $this->select("SELECT * FROM Likes where userID = ?", ["i", $userID]);
	}
	public function getAllLikesByPost($postID){
		return $this->select("SELECT * FROM Likes where postID = ?", ["i", $postID]);
	}
	public function addLike($postID, $userID){
		$temp = "INSERT INTO Likes values (?,?)";
		$param = Array($postID, $userID);
		return $this->insert($temp, ["ii", $param]);
	}
	public function deleteLike($postID, $userID){
		$temp = "DELETE FROM Likes where postID = ? and userID = ?";
		$param = Array($postID, $userID);
		return $this->delete($temp, ["ii", $param]);
	}
	
}
?>
