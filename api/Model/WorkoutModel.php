<?php

require_once PROJECT_ROOT_PATH . "/Model/Database.php";
class WorkoutModel extends Database
{
	public function getWorkouts($limit){
		return $this->select("SELECT * FROM workout ORDER BY difficulty ASC LIMIT ?", ["i", $limit]);
	}
	public function searchWorkouts($search){
		//echo "SELECT * FROM workout where name like '%$search%'";
		$temp = "SELECT * FROM workout where name like '%$search%'"; 
		return $this->select($temp);
	}
	public function getWorkout($ID){
		return $this->select("SELECT * FROM workout where ID = ?", ["i", $ID]);
	}
	public function favWorkout($ID){
		return $this->select("SELECT * from workout INNER JOIN favWorkout where ID = workoutID and userID = ?", ["i", $ID]);
	}
}
?>
