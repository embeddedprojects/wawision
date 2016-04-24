<?php

//header("Content-Type: text/html; charset=utf-8");

define('USE_PROXY',FALSE);
define('PROXY_HOST', '127.0.0.1');
define('PROXY_PORT', '808');
define('PAYPAL_URL', 'https://www.sandbox.paypal.com/webscr&cmd=_express-checkout&token=');
define('VERSION', '53.0');

define('API_ENDPOINT', 'https://api-3t.paypal.com/nvp');

class paypal
{
	var $numberofdays;
	var $API_UserName;
	var $API_Password;
  var $API_Signature;
  var $API_Endpoint;
  var $version;

	function paypal()
	{
		$this->numberofdays = 5;
	}

	function Import($zugangsdaten)
	{
		$this->API_UserName=$zugangsdaten["API_USERNAME"];
		$this->API_Password=$zugangsdaten["API_PASSWORD"];
		$this->API_Signature=$zugangsdaten["API_SIGNATURE"];
		$this->version=VERSION;
		$this->API_Endpoint=API_ENDPOINT;

		$days_ago = date('Y-m-d', mktime(0, 0, 0, date("m") , date("d") - $this->numberofdays, date("Y")));
		$days_today = date('Y-m-d', mktime(0, 0, 0, date("m") , date("d"), date("Y")));
		//$result = $this->GetTransactions("01/02/2013","01/03/2013");
	
		$result = $this->GetTransactions($days_ago,$days_today);

		$outstr="Datum, Zeit, Zeitzone, Name, Art\r\n";
		for($i=0;$i<count($result);$i++)
		{
			$rawpaypal = $this->GetTransationDetail($result[$i]);
			//print_r($rawpaypal);	
			// alle einnahmen mit paypal gebuehr	
			if($rawpaypal["ACK"]=="Success" && $rawpaypal["AMT"] > 0 && $rawpaypal["FEEAMT"] > 0)
				$outstr .= $this->ConvertToCSVRow($rawpaypal);
		}
//exit;
		return utf8_decode($outstr);
	}

	function ConvertToCSVRow($rawpaypal)
	{
		//print_r($rawpaypal);
		//SHIPTONAME
		//BUSINESS

		$datum = date('Y-m-d', strtotime($rawpaypal["ORDERTIME"]) + 3600); #TODO 3600 = gmt + berlin time zone
		//$datum = substr($rawpaypal["TIMESTAMP"],0,10);
		//$datum = substr($rawpaypal["ORDERTIME"],0,10);
		$jahr = substr($datum,0,4);
    $mon  = substr($datum,5,2);
    $tag  = substr($datum,8,2);
    $datneu = $tag.'.'.$mon.'.'.$jahr;
		$datum = $datneu;

		$waehrung = $rawpaypal["CURRENCYCODE"];
		

		if($rawpaypal["BUSINESS"]!="")
			$name = $rawpaypal["BUSINESS"];
		else
			$name = $rawpaypal["FIRSTNAME"]." ".$rawpaypal["LASTNAME"];

		$betrag = str_replace(".",",",$rawpaypal["AMT"]);
		
		$gebuehr = "-".str_replace(".",",",$rawpaypal["FEEAMT"]);

		$vorgang = $rawpaypal["L_NAME0"];

		$element = array();

		$element[0] = $datum;
		$element[3] = $name;
		$element[6] = $waehrung;
		$element[7] = $betrag;
		$element[8] = $gebuehr;
		$element[12] = $rawpaypal["TRANSACTIONID"];
		$element[15] = $vorgang;
		$element[41] = "";

		for($i=0;$i<=41;$i++)
		{
			$result .='"'.$element[$i].'"';
			if($i<41) $result .=",";
				else $result .="\r\n";
		}
		return $result;
	}

	function GetTransationDetail($transactionID)
	{
		$transactionID=urlencode($transactionID);

		/* Construct the request string that will be sent to PayPal.
   		The variable $nvpstr contains all the variables and is a
   		name value pair string with & as a delimiter */
		$nvpStr="&TRANSACTIONID=$transactionID";

		/* Make the this->API call to PayPal, using this->API signature.
   		The this->API response is stored in an associative array called $resArray */
		$resArray=$this->hash_call("gettransactionDetails",$nvpStr);

		return $resArray;	
	}


	function GetTransactions($start,$end)
	{
		/* Construct the request string that will be sent to PayPal.
			 The variable $nvpstr contains all the variables and is a
			 name value pair string with & as a delimiter */
		$nvpStr;

		$startDateStr=$start;//$_REQUEST['startDateStr'];
		$endDateStr=$end;//$_REQUEST['endDateStr'];
		//$transactionID=urlencode($_REQUEST['transactionID']);
		if(isset($startDateStr)) {
			 $start_time = strtotime($startDateStr);
			 $iso_start = date('Y-m-d\T00:00:00\Z',  $start_time);
			 $nvpStr="&STARTDATE=$iso_start";
		}

		if(isset($endDateStr)&&$endDateStr!='') {
			 $end_time = strtotime($endDateStr);
			 $iso_end = date('Y-m-d\T24:00:00\Z', $end_time);
			 $nvpStr.="&ENDDATE=$iso_end";
		}

		//if($transactionID!='')
		//   $nvpStr=$nvpStr."&TRANSACTIONID=$transactionID";
		/* Make the this->API call to PayPal, using this->API signature.
			 The this->API response is stored in an associative array called $resArray */

		$resArray=$this->hash_call("TransactionSearch",$nvpStr);

		/* Next, collect the this->API request in the associative array $reqArray
			 as well to display back to the browser.
			 Normally you wouldnt not need to do this, but its shown for testing */

		$reqArray=$_SESSION['nvpReqArray'];

		$ack = strtoupper($resArray["ACK"]);

	  if(!isset($resArray["L_TRANSACTIONID0"])){
			return -1;
		} else {
			$count=0;
    	//counting no.of  transaction IDs present in NVP response arrray.
    	while (isset($resArray["L_TRANSACTIONID".$count]))
				$count++;

    	$ID=0;
			$result = array();
  		while ($count>0) {
      	$transactionID    = $resArray["L_TRANSACTIONID".$ID];

		 		$result[] = $transactionID;
				
				//echo $resArray["L_NAME".$ID]." ". $resArray["L_AMT".$ID]." ".$resArray["L_STATUS".$ID]." ".$resArray["L_FEEAMT".$ID]."<br>";
				/*
      	$timeStamp = $resArray["L_TIMESTAMP".$ID];
      	$payerName  = $resArray["L_NAME".$ID];
      	$amount  = $resArray["L_AMT".$ID];
      	$status  = $resArray["L_STATUS".$ID];
      	$fee  = $resArray["L_FEEAMT".$ID];
				*/
      	$count--; $ID++;
			}
		}
		return $result;
	}


/****************************************************
CallerService.php

This file uses the constants.php to get parameters needed 
to make an this->API call and calls the server.if you want use your
own credentials, you have to change the constants.php

Called by TransactionDetails.php, ReviewOrder.php, 
DoDirectPaymentReceipt.php and DoExpressCheckoutPayment.php.

****************************************************/
//session_start();

/**
  * hash_call: Function to perform the this->API call to PayPal using this->API signature
  * @methodName is name of this->API  method.
  * @nvpStr is nvp string.
  * returns an associtive array containing the response from the server.
*/


function hash_call($methodName,$nvpStr)
{
	//declaring of global variables
	global $nvp_Header;

	//setting the curl parameters.
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$this->API_Endpoint);
	curl_setopt($ch, CURLOPT_VERBOSE, 1);

	//turning off the server and peer verification(TrustManager Concept).
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);

	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch, CURLOPT_POST, 1);
    //if USE_PROXY constant set to TRUE in Constants.php, then only proxy will be enabled.
   //Set proxy name to PROXY_HOST and port number to PROXY_PORT in constants.php 
	if(USE_PROXY)
	curl_setopt ($ch, CURLOPT_PROXY, PROXY_HOST.":".PROXY_PORT); 

	//NVPRequest for submitting to server
	$nvpreq="METHOD=".urlencode($methodName)."&VERSION=".urlencode($this->version)."&PWD=".urlencode($this->API_Password)."&USER=".urlencode($this->API_UserName)."&SIGNATURE=".urlencode($this->API_Signature).$nvpStr;

	//setting the nvpreq as POST FIELD to curl
	curl_setopt($ch,CURLOPT_POSTFIELDS,$nvpreq);

	//getting response from server
	$response = curl_exec($ch);

	//convrting NVPResponse to an Associative Array
	$nvpResArray=$this->deformatNVP($response);
	$nvpReqArray=$this->deformatNVP($nvpreq);
	$_SESSION['nvpReqArray']=$nvpReqArray;

	if (curl_errno($ch)) {
		// moving to display page to display curl errors
		  $_SESSION['curl_error_no']=curl_errno($ch) ;
		  $_SESSION['curl_error_msg']=curl_error($ch);
	//	  $location = "this->APIError.php";
	//	  header("Location: $location");
echo $_SESSION['curl_error_msg'];
	 } else {
		 //closing the curl
			curl_close($ch);
	  }

return $nvpResArray;
}

/** This function will take NVPString and convert it to an Associative Array and it will decode the response.
  * It is usefull to search for a particular key and displaying arrays.
  * @nvpstr is NVPString.
  * @nvpArray is Associative Array.
  */

function deformatNVP($nvpstr)
{

	$intial=0;
 	$nvpArray = array();


	while(strlen($nvpstr)){
		//postion of Key
		$keypos= strpos($nvpstr,'=');
		//position of value
		$valuepos = strpos($nvpstr,'&') ? strpos($nvpstr,'&'): strlen($nvpstr);

		/*getting the Key and Value values and storing in a Associative Array*/
		$keyval=substr($nvpstr,$intial,$keypos);
		$valval=substr($nvpstr,$keypos+1,$valuepos-$keypos-1);
		//decoding the respose
		$nvpArray[urldecode($keyval)] =urldecode( $valval);
		$nvpstr=substr($nvpstr,$valuepos+1,strlen($nvpstr));
     }
	return $nvpArray;
}
}
?>
