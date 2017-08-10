<?php 
class Transaction extends AppModel
{
	function requestPaypal($price, $name,$custom)
	{
	$request = array(
		'METHOD'=>'BMCreateButton',
		'VERSION'=>'87',
		'USER'=>Configure::read('Paypal.USER'),
		'PWD'=>Configure::read('Paypal.PWD'),
		'SIGNATURE'=>Configure::read('Paypal.SIGNATURE'),
		'BUTTONCODE'=>'HOSTED',
		'BUTTONTYPE'=>'BUYNOW',
		'BUTTONSUBTYPE'=>'SERVICES',
		'L_BUTTONVAR0'=>"business=".Configure::read('Paypal.mail'),
		'L_BUTTONVAR1'=>"item_name=$name",
		'L_BUTTONVAR2'=>"amount=$price",
		'L_BUTTONVAR3'=>"currency_code=EUR",
		'L_BUTTONVAR4'=>"no_note=1",
		'L_BUTTONVAR5'=>"notify_url=".Router::url('/paypal/notify',true),
		'L_BUTTONVAR6'=>"return=".Router::url('/paypal/success',true),
		'L_BUTTONVAR7'=>"cancel=".Router::url('/paypal/cancel',true),
		'L_BUTTONVAR8'=>"custom=$custom",
		);
	
	$request= http_build_query($request);
	

	//echo "https://api-3t.".Configure::read('Paypal.sandbox')."paypal.com/nvp";
	
	$curlOptions = array(
		CURLOPT_URL=>"https://api-3t.".Configure::read('Paypal.sandbox')."paypal.com/nvp",
		CURLOPT_VERBOSE=>1,
		CURLOPT_SSL_VERIFYPEER=>true,
		CURLOPT_SSL_VERIFYHOST=>2 ,
		CURLOPT_CAINFO=>APP.'Vendor'.DS.'cacert.pem',
		CURLOPT_RETURNTRANSFER=>1,
		CURLOPT_POSTFIELDS=>$request
		);
	$ch=curl_init();
	curl_setopt_array($ch, $curlOptions);
	$response=curl_exec($ch);	
	if(curl_errno($ch))
		{
			debug(curl_errno($ch));
   	return false;
		}else
			{
			curl_close($ch);
			parse_str($response,$responseArray);
			return $responseArray['EMAILLINK'];	
			}
	}
	
}

?>