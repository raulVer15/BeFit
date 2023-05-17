<?php
require_once("BaseController.php");
class UserController extends BaseController
{
	public function listAction()
	{
		$strErrorDesc = '';
		$request = $_SERVER["REQUEST_METHOD"];
		$arrQueryStringParams = $this->getQueryStringParams();
		//echo "prin111t";
		if (strtoupper($request) == 'GET'){
			try{
				$userModel = new UserModel();
				$intLimit = 10;
				//echo "prin111t";
				if (isset($arrQueryStringParams['limit']) && $arrQueryStringParams['limit']){
					$intLimit = $arrQueryStringParams['limit'];
				}
				//echo "prin111t";
				$arrUsers = $userModel->getAllUsers($intLimit);
				echo "pri555int";
				$responseData = json_encode($arrUsers);	
				//echo "print";
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
	public function searchAction()
	{
		//echo "Wow!";	
		$strErrorDesc = '';
		$request = $_SERVER["REQUEST_METHOD"];
		$arrQueryStringParams = $this->getQueryStringParams();
		if (strtoupper($request) == 'GET'){
			try{
				$userModel = new UserModel();
				//echo "Here!";
				//print_r($arrQueryStringParams);
				//echo $search;

				$search = '';
				if (isset($arrQueryStringParams['search']) && $arrQueryStringParams['search']){
					$search = $arrQueryStringParams['search'];
				}
				echo $arrQueryStringParams['search'];
				echo $search;
				$arrUsers = $userModel->searchUsers($search);
				$responseData = json_encode($arrUsers);	
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
	public function getAction()
	{
		//echo "Wow!";	
		$strErrorDesc = '';
		$request = $_SERVER["REQUEST_METHOD"];
		$arrQueryStringParams = $this->getQueryStringParams();
		if (strtoupper($request) == 'GET'){
			try{
				$userModel = new UserModel();
				//echo "Here!";
				//print_r($arrQueryStringParams);
				//echo $search;

				$ID = null;
				if (isset($arrQueryStringParams['ID']) && $arrQueryStringParams['ID']){
					$ID = $arrQueryStringParams['ID'];
				}
				settype($ID, "integer");	
				if (is_int($ID)){
					$arrUsers = $userModel->getUser($ID);
					$responseData = json_encode($arrUsers);	
				}
				echo $ID;
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
				$userModel = new UserModel();
				//echo "Here!";
				//print_r($arrQueryStringParams);
				//echo $search;

				$username = null;
				$password = null;
				$email = null;

				if (isset($arrQueryStringParams['user']) && $arrQueryStringParams['user']){
					$username = $arrQueryStringParams['user'];
				}
				if (isset($arrQueryStringParams['pass']) && $arrQueryStringParams['pass']){
					$password = $arrQueryStringParams['pass'];
				}
				if (isset($arrQueryStringParams['email']) && $arrQueryStringParams['email']){
					$email = $arrQueryStringParams['email'];
				}
				echo $username;
				if ($username && $password && $email){
					$success = $userModel->addUser($username, $password, $email);
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

