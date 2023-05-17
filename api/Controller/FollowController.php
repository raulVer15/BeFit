<?php
require_once("BaseController.php");
class FollowController extends BaseController
{
	public function followerAction()
	{
		$strErrorDesc = '';
		$request = $_SERVER["REQUEST_METHOD"];
		$arrQueryStringParams = $this->getQueryStringParams();
		//echo "prin111t";
		if (strtoupper($request) == 'GET'){
			try{
				$followModel = new FollowModel();
				$ID = null;
				//echo "prin111t";
				if (isset($arrQueryStringParams['ID']) && $arrQueryStringParams['ID']){
					$ID = $arrQueryStringParams['ID'];
				}
				settype($ID, "integer");	
				if (is_int($ID)){
					echo $ID;
					$arrFollowers = $followModel->getFollowers($ID);
					$responseData = json_encode($arrFollowers);	
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
	public function followingAction()
	{
		//echo "Wow!";	
		$strErrorDesc = '';
		$request = $_SERVER["REQUEST_METHOD"];
		$arrQueryStringParams = $this->getQueryStringParams();
		if (strtoupper($request) == 'GET'){
			try{
				$followModel = new FollowModel();
				$ID = null;
				if (isset($arrQueryStringParams['ID']) && $arrQueryStringParams['ID']){
					$ID = $arrQueryStringParams['ID'];
				}
				settype($ID, "integer");	
				if (is_int($ID)){
					echo $ID;
					$arrFollowing = $followModel->getFollowing($ID);
					$responseData = json_encode($arrFollowing);	
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
	public function addAction()
        {
                //echo "Wow!";  
                $strErrorDesc = '';
                $request = $_SERVER["REQUEST_METHOD"];
                $arrQueryStringParams = $this->getQueryStringParams();
                if (strtoupper($request) == 'GET'){
                        try{
                                $followModel = new FollowModel();
                                //echo "Here!";
                                //print_r($arrQueryStringParams);
                                //echo $search;

                                $userID = null;
                                $toFollow = null;

                                if (isset($arrQueryStringParams['user']) && $arrQueryStringParams['user']){
                                        $userID = $arrQueryStringParams['user'];
                                }
                                if (isset($arrQueryStringParams['toFollow']) && $arrQueryStringParams['toFollow']){
                                        $toFollow = $arrQueryStringParams['toFollow'];
                                }
                                echo $username;
                                if ($userID && $toFollow){
                                        $success = $followModel->addFollowing($userID, $toFollow);
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
							$followModel = new FollowModel();
							//echo "Here!";
							//print_r($arrQueryStringParams);
							//echo $search;

							$userID = null;
                            $toUnfollow = null;

                            if (isset($arrQueryStringParams['user']) && $arrQueryStringParams['user']){
                                $userID = $arrQueryStringParams['user'];
                            }
                            if (isset($arrQueryStringParams['toUnfollow']) && $arrQueryStringParams['toUnfollow']){
                                $toUnfollow = $arrQueryStringParams['toUnfollow'];
                            }
							settype($userID, "integer");
							settype($toUnfollow, "integer");
							if ($userID && $toUnfollow){
									$success = $followModel->deleteFollowing($userID, $toUnfollow);
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
