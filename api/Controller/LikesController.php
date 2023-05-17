<?php
require_once("BaseController.php");
class LikesController extends BaseController
{
	public function postAction()
	{
		$strErrorDesc = '';
		$request = $_SERVER["REQUEST_METHOD"];
		$arrQueryStringParams = $this->getQueryStringParams();
		//echo "prin111t";
		if (strtoupper($request) == 'GET'){
			try{
				$likesModel = new LikesModel();
				$ID = null;
				//echo "prin111t";
				if (isset($arrQueryStringParams['ID']) && $arrQueryStringParams['ID']){
					$ID = $arrQueryStringParams['ID'];
				}
				settype($ID, "integer");	
				if (is_int($ID)){
					$arrLikes = $likesModel->getAllLikesByPost($ID);
					$responseData = json_encode($arrLikes);	
				}
			} catch (Error $e) {
				$strErrorDesc = $e->getMessage().' Something went wrong!';
				$strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
			}
		} else {
			$strErrorDesc = 'Method not supported';
			$strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
		}

		if (!$strErrorDesc){
			$this->sendOutput(
				$responseData,
				array('Content-Type: application/json', 'HTTP/1.1 200 OK')
			);
		} else {
			$this->sendOutput(json_encode(array('error' => $strErrorDesc)),
				array('Content-Type: application/json', $strErrorHeader)
			);
		}
	}
	public function userAction()
	{
		//echo "Wow!";	
		$strErrorDesc = '';
		$request = $_SERVER["REQUEST_METHOD"];
		$arrQueryStringParams = $this->getQueryStringParams();
		if (strtoupper($request) == 'GET'){
			try{
				$likesModel = new LikesModel();
				$ID = null;
				if (isset($arrQueryStringParams['ID']) && $arrQueryStringParams['ID']){
					$ID = $arrQueryStringParams['ID'];
				}
				settype($ID, "integer");	
				if (is_int($ID)){
					$arrLikes = $likesModel->getAllLikesByUser($ID);
					$responseData = json_encode($arrLikes);	
				}
				//echo $ID;
			} catch (Error $e) {
				$strErrorDesc = $e->getMessage().'Something went wrong!';
				$strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
			}
		} else {
			$strErrorDesc = 'Method not supported';
			$strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
		}

		if (!$strErrorDesc){
			$this->sendOutput(
				$responseData,
				array('Content-Type: application/json', 'HTTP/1.1 200 OK')
			);
		} else {
			$this->sendOutput(json_encode(array('error' => $strErrorDesc)),
				array('Content-Type: application/json', $strErrorHeader)
			);
		}
	}
	public function addAction()
	{
			//echo "Wow!";  
			$strErrorDesc = '';
			$request = $_SERVER["REQUEST_METHOD"];
			$arrQueryStringParams = $this->getQueryStringParams();
			if (strtoupper($request) == 'GET'){
					try{
							$likesModel = new LikesModel();
							//echo "Here!";
							//print_r($arrQueryStringParams);
							//echo $search;

							$userID = null;
							$postID = null;

							if (isset($arrQueryStringParams['user']) && $arrQueryStringParams['user']){
									$userID = $arrQueryStringParams['user'];
							}
							if (isset($arrQueryStringParams['post']) && $arrQueryStringParams['post']){
									$postID = $arrQueryStringParams['post'];
							}
							//echo $username;
							if ($userID && $postID){
									$success = $likesModel->addLike($postID, $userID);
									if ($success){
											$responseData = json_encode(array("Result"=>true));     
									}
							}
					} catch (Error $e) {
							$strErrorDesc = $e->getMessage().'Something went wrong!';
							$strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
					}
			} else {
					$strErrorDesc = 'Method not supported';
					$strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
			}

			if (!$strErrorDesc){
					$this->sendOutput(
							$responseData,
							array('Content-Type: application/json', 'HTTP/1.1 200 OK')
					);
			} else {
					$this->sendOutput(json_encode(array('error' => $strErrorDesc)),
							array('Content-Type: application/json', $strErrorHeader)
					);
			}
	
	} 
	public function deleteAction()
	{
			//echo "Wow!";  
			$strErrorDesc = '';
			$request = $_SERVER["REQUEST_METHOD"];
			$arrQueryStringParams = $this->getQueryStringParams();
			if (strtoupper($request) == 'GET'){
					try{
							$likesModel = new LikesModel();
							//echo "Here!";
							//print_r($arrQueryStringParams);
							//echo $search;

							$userID = null;
							$postID = null;

							if (isset($arrQueryStringParams['user']) && $arrQueryStringParams['user']){
									$userID = $arrQueryStringParams['user'];
							}
							if (isset($arrQueryStringParams['post']) && $arrQueryStringParams['post']){
									$postID = $arrQueryStringParams['post'];
							}
							//echo $username;
							if ($userID && $postID){
									$success = $likesModel->deleteLike($postID, $userID);
									if ($success){
											$responseData = json_encode(array("Result"=>true));     
									}
							}
					} catch (Error $e) {
							$strErrorDesc = $e->getMessage().'Something went wrong!';
							$strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
					}
			} else {
					$strErrorDesc = 'Method not supported';
					$strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
			}

			if (!$strErrorDesc){
					$this->sendOutput(
							$responseData,
							array('Content-Type: application/json', 'HTTP/1.1 200 OK')
					);
			} else {
					$this->sendOutput(json_encode(array('error' => $strErrorDesc)),
							array('Content-Type: application/json', $strErrorHeader)
					);
			}
	
	}  

}
