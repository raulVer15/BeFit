<?php
require_once("BaseController.php");
class CommentsController extends BaseController
{
	public function postAction()
	{
		$strErrorDesc = '';
		$request = $_SERVER["REQUEST_METHOD"];
		$arrQueryStringParams = $this->getQueryStringParams();
		//echo "prin111t";
		if (strtoupper($request) == 'GET'){
			try{
				$commentsModel = new CommentsModel();
				$ID = null;
				//echo "prin111t";
				if (isset($arrQueryStringParams['ID']) && $arrQueryStringParams['ID']){
					$ID = $arrQueryStringParams['ID'];
				}
				settype($ID, "integer");	
				if (is_int($ID)){
					$arrComments = $commentsModel->getAllCommentsByPost($ID);
					$responseData = json_encode($arrComments);	
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
				$commentsModel = new CommentsModel();
				$ID = null;
				if (isset($arrQueryStringParams['ID']) && $arrQueryStringParams['ID']){
					$ID = $arrQueryStringParams['ID'];
				}
				settype($ID, "integer");	
				if (is_int($ID)){
					$arrComments = $commentsModel->getAllCommentsByUser($ID);
					$responseData = json_encode($arrComments);	
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
							$commentsModel = new CommentsModel();
							//echo "Here!";
							//print_r($arrQueryStringParams);
							//echo $search;

							$userID = null;
							$postID = null;
							$text = null;
							if (isset($arrQueryStringParams['user']) && $arrQueryStringParams['user']){
								$userID = $arrQueryStringParams['user'];
							}
							if (isset($arrQueryStringParams['post']) && $arrQueryStringParams['post']){
								$postID = $arrQueryStringParams['post'];
							}
							if (isset($arrQueryStringParams['text']) && $arrQueryStringParams['text']){
								$text = $arrQueryStringParams['text'];
							}
							print $postID;
							print $userID;
							print $text;
							if ($userID && $postID && $text){
									$success = $commentsModel->addComment($postID, $userID, $text);
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
							$commentsModel = new CommentsModel();
							//echo "Here!";
							//print_r($arrQueryStringParams);
							//echo $search;

							$commentID = null;
							if (isset($arrQueryStringParams['ID']) && $arrQueryStringParams['ID']){
								$commentID = $arrQueryStringParams['ID'];
							}
							settype($commentID, "integer");
							if ($commentID){
									$success = $commentsModel->deleteComment($commentID);
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
