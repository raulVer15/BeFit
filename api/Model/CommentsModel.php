<?php

require_once PROJECT_ROOT_PATH . "/Model/Database.php";
class CommentsModel extends Database
{
	public function getAllCommentsByUser($userID){
		return $this->select("SELECT * FROM Comments where userID = ?", ["i", $userID]);
	}
	public function getAllCommentsByPost($postID){
		return $this->select("SELECT * FROM Comments where postID = ?", ["i", $postID]);
	}
	public function addComment($postID, $userID, $text){
		$temp = "INSERT INTO Comments(postID, userID, text) values (?,?,?)";
		$param = Array($postID, $userID, $text);
		return $this->insert($temp, ["iis", $param]);
	}
	public function deleteComment($commentID){
		$temp = "DELETE FROM Comments where commentID = ?";
		return $this->delete($temp, ["i", $commentID]);
	}
}
?>
