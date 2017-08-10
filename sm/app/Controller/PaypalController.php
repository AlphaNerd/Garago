<?php
class PaypalController extends AppController
{
	public $uses =array('Restaurant','Transaction');
	public function notify()
	{//$this->loadModel('Restaurant');
		$email_account = Configure::read('Paypal.mail');
		$req='cmd_notify-validate';
		foreach ($_POST as $key => $value) {
			$value=urlencode(stripcslashes($value));
			$req.="&$key=$value";
		}
		$header="POST /cgi-bin/webscr HTTP/1.0\r\n";
		$header.="Content-Type: application/x-www-form-urlencode\r\n";
		$header.="Content-Length: ".strlen($req). "\r\n\r\n";
		$fp=fsockopen('ssl://wwww.'. Configure::read('Paypal.sandbox').'paypal.com',433,$errno,$errstr,30);
		
		$item_name=$_POST['item_name'];
		$item_number= $_POST['item_number'];
		$payment_status = $_POST['payment_status'];
		$payment_amount= $_POST['mc_gross'];
		$payment_tax=$_POST['tax'];
		$payment_ht=$payment_amount- $payment_tax;
		$payment_currency=$_POST['mc_currency'];
		$address =$_POST['address_street'];
		$country=$_POST['address_country'];
		$city=$_POST['address_city'];
		$name=$_POST['address_name'];
		$txn_id=$_POST['txn_id'];
		$receiver_email=$_POST['receiver_email'];
		$payer_email=$_POST['payer_email'];
		parse_str($_POST['custom'],$custom);
		$this->log($_POST,'paypal');
		if (!$fp) {
		
		}else
		{
			fputs($fp,$header.$req);
			while (!feof($fp)) {
				$res=fgets($fp,1024);
				if(strcmp($res,"VERIFIED")==0)
				{
					if($payment_status=="Completed")
					{
						if($email_account==$receiver_email)
						{
							if($custom['action']=='Subscribe'){
								$duration=$custom['duration'];
							$this->Transaction->save(array(
								'id_restaurant'=>$custom['uid'],
								'amount'=>$payment_amount,
								'created'=>date("20y-m-d H:i"),
								'datas'=>''));
							$this->Restaurant->id=$custom['uid'];
							$date = new DateTime();
							$date->add(new DateInterval('P'.$duration.'M'));
							$this->Restaurant->saceField('expiration',$date->format('Y-m-d H:i:s'));
							}else

							{
								$this->log("Paiement $duration mois =");
							}
						}
					}else
					{

					}exit();
				}
				else if(strcmp($res,"INVALID")==0)
				{

				}
			}
			fclose($fp);
		}
	}
	function success()
	{

	}
}
?>