<?php
require_once("BaseController.php");
class PRController extends BaseController
{
	public function getAction()
	{
		$strErrorDesc = '';
		$request = $_SERVER["REQUEST_METHOD"];
		$arrQueryStringParams = $this->getQueryStringParams();
		//echo "prin111t";
		if (strtoupper($request) == 'GET'){
			try{
				$PRModel = new PRModel();
				$ID = null;
				//echo "prin111t";
				if (isset($arrQueryStringParams['ID']) && $arrQueryStringParams['ID']){
					$ID = $arrQueryStringParams['ID'];
				}
				settype($ID, "integer");	
				if (is_int($ID)){
					$arrPR = $PRModel->getUserPR($ID);
					$responseData = json_encode($arrPR);	
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
	public function updateAction()
	{
		//echo "Wow!";	
		$strErrorDesc = '';
		$request = $_SERVER["REQUEST_METHOD"];
		$arrQueryStringParams = $this->getQueryStringParams();
		if (strtoupper($request) == 'GET'){
			try{
				$PRModel = new PRModel();
				$userID = null;
				$part = null;
				$newPR = null;
				if (isset($arrQueryStringParams['part']) && $arrQueryStringParams['part']){
					$part = $arrQueryStringParams['part'];
					$part = $part . "PR";
				}
				if (isset($arrQueryStringParams['new']) && $arrQueryStringParams['new']){
					$newPR = $arrQueryStringParams['new'];
				}

				if (isset($arrQueryStringParams['ID']) && $arrQueryStringParams['ID']){
					$userID = $arrQueryStringParams['ID'];
				}

				settype($userID, "integer");
				settype($newPR, "integer");
				if ($userID && $part && $newPR){
					$arrPR = $PRModel->updatePR($part, $newPR, $userID);
					$responseData = json_encode($arrPR);	
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
}
