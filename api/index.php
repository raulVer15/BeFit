<?php
require __DIR__ . "/inc/bootstrap.php";
ini_set('display_error', 1);
error_reporting(E_ALL);
//echo "HELLO!";
if (!isset($_SERVER['REQUEST_URI'])){
	$_SERVER['REQUEST_URI'] = '/api/index.php/workout/search';
	$_SERVER["REQUEST_METHOD"] = 'GET';
	$_SERVER['QUERY_STRING'] = "search=dumbbell";
}

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);
//echo $_SERVER['QUERY_STRING'];
//parse_str($_SERVER['QUERY_STRING'], $query);
//print_r($query);
if ((isset($uri[3]) && $uri[3] != 'workout' && $uri[3] != 'profile' && $uri[3] != 'PR' && $uri[3] != 'follow' && $uri[3] != 'pump' &&  $uri[3] != 'likes' && $uri[3] != 'comments' && $uri[3] != 'user' && $uri[3] != 'post') || !isset($uri[4])){
	header("HTTP/1.1 404 Not Found");
	exit();
}

require PROJECT_ROOT_PATH . "/Controller/WorkoutController.php";
require PROJECT_ROOT_PATH . "/Controller/UserController.php";
require PROJECT_ROOT_PATH . "/Controller/PostController.php";
require PROJECT_ROOT_PATH . "/Controller/CommentsController.php";
require PROJECT_ROOT_PATH . "/Controller/LikesController.php";
require PROJECT_ROOT_PATH . "/Controller/PumpController.php";
require PROJECT_ROOT_PATH . "/Controller/PRController.php";
require PROJECT_ROOT_PATH . "/Controller/FollowController.php";
require PROJECT_ROOT_PATH . "/Controller/ProfileController.php";

$model = ucfirst($uri[3]);

//echo "obj{$model}Controller";
$objWorkoutController = new WorkoutController();
$objUserController = new UserController();
$objPostController = new PostController();
$objCommentsController = new CommentsController();
$objLikesController = new LikesController();
$objPumpController = new PumpController();
$objPRController = new PRController();
$objFollowController = new FollowController();
$objProfileController = new ProfileController();


$strMethodName = $uri[4] . 'Action';
try{
	//echo "$strMethodName()";
	//$objWorkoutController->{$strMethodName}();
	switch($model){
		case 'User':
			$objUserController->{$strMethodName}();
		case 'Workout':
			$objWorkoutController->{$strMethodName}();
		case 'Post':
			$objPostController->{$strMethodName}();
		case 'Comments':
			$objCommentsController->{$strMethodName}();
		case 'Likes':
			$objLikesController->{$strMethodName}();
		case 'Pump':
			$objPumpController->{$strMethodName}();
		case 'PR':
			$objPRController->{$strMethodName}();
		case 'Follow':
			$objFollowController->{$strMethodName}();
		case 'Profile':
			$objProfileController->{$strMethodName}();
	}	
} catch(Exception $e){
	echo "Tried to get workouts but failed :(";
}
 
?>
