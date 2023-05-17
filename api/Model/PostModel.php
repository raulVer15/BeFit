<?php

require_once PROJECT_ROOT_PATH . "/Model/Database.php";
class PostModel extends Database
{
	public function getAllPosts($limit){
		return $this->select("SELECT * FROM Posts order by postID ASC LIMIT ?", ["i", $limit]);
	}
	public function getUserPosts($ID){
		return $this->select("SELECT * FROM Posts where userID = ?", ["i", $ID]);
	}
	public function searchPosts($search){
		$temp = "SELECT * FROM Posts where caption like '%$search%'";
		return $this->select($temp);
	}
	public function addPost($userID, $caption){
		$datePosted = gmdate('Ymdhms');
		$temp = "INSERT INTO Posts(userID, caption, datePosted) values (?,?,?)";
		$param = Array($userID, $caption, $datePosted);
		return $this->insert($temp, ["isi", $param]);
	}
	public function deletePost($postID){
		$temp = "DELETE FROM Posts where postID = ?";
		return $this->delete($temp, ["i", $postID]);
	}
}
?>
