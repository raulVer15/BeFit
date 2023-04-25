
<?php
#ini_set('display_errors',1);
#error_reporting(E_ALL);
require_once('config.php');

function getConnection(){
    $conn;
    if (!isset($conn)){
        $conn = mysqli_connect(
            $GLOBALS['servername'],
            $GLOBALS['username'],
            $GLOBALS['password'],
            $GLOBALS['dbname'],
			$GLOBALS['port']
        ) or die(mysqli_connect_error());
    }
    if ($conn === false) {
        echo "Unable to connect to database<br/>";
        echo mysqli_connect_error();
    }else {
        #echo "Conn is true!";
    }
    return $conn;

}

function closeConnection($conn){
    if (!$conn->close()){
        die(mysqli_error());
    }
}

$conn = getConnection();
if ($query = $conn->prepare("select * from user")){
	if($query->execute()){
	} else {
		echo $query->error;
	}
	$result = $query->get_result();
	while($row = mysqli_fetch_array($result)){
		echo print_r($row);
	}
}
