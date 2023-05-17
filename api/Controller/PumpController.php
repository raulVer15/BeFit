<?php
require_once("BaseController.php");
class PumpController extends BaseController
{
	public function getAction()
	{
		$strErrorDesc = '';
		$request = $_SERVER["REQUEST_METHOD"];
		$arrQueryStringParams = $this->getQueryStringParams();
		//echo "prin111t";
		if (strtoupper($request) == 'GET'){
			try{
				$pumpModel = new PumpModel();
				$date = NULL;
				//echo "prin111t";
				if (isset($arrQueryStringParams['date']) && $arrQueryStringParams['date']){
					$date = $arrQueryStringParams['date'];
				}
				settype($date, "integer");
				//echo $date;	
				if (is_int($date)){
					$arrDay = $pumpModel->getDailyPump($date);
					$responseData = json_encode($arrDay);	
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
}
?>
