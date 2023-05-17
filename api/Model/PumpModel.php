<?php

require_once PROJECT_ROOT_PATH . "/Model/Database.php";
class PumpModel extends Database
{
	public function getDailyPump($date){
		echo "Here!";
		$temp = "SELECT * FROM DailyPump where date like '$date%'";
		return $this->select($temp);
	}
}
?>
