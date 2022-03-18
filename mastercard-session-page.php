<?php if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );
/**
 *
 * @package Mastercard
 * @subpackage Mastercard payment Gateway
 * @author Himanshu Sharma <learndphere@gmail.com>
 * @version V1
 */
class Mastercard {

	public $username;
	public $password;
	
	public function __construct() {
		$this->CI = &get_instance ();
	}

	function process_payment($book_id = ''){

		$mode == "test"; // this you can set as enviroment variable you can oprate dynamically. 
		// Mastercard Credentials 
		if ($mode == 'test') {
			$this->username = 'TEST602006999'; // demo credentials
			$this->password = '292c49a702a83613dbde019e4015f999';// demo credentials
		} else {
			self::$username = 'LIVE602006999';// demo credentials
			self::$password = '292c49a702a83613dbde019e4015f999';// demo credentials

		}

		/*
		// for display all the php errors 
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);
		*/

		// this is the Data you have to pass as input to the mastercard session API
		$payloadName = 	array(
							'apiOperation'=>"CREATE_CHECKOUT_SESSION", 
							"order" => array(
								"id"=> $book_id, // this will be your own Order if for invoice
								"currency"=>"SAR", // your own currency
								"amount"=> 150, // amount for payment
							)
						);

		$payloadName = json_encode($payloadName);

		// From URL to get webpage contents. 
		$url = "https://alahligatway.gateway.mastercard.com/api/rest/version/50/merchant/".$this->username."/session"; 

		// Initialize a CURL session. 
		$ch = curl_init(); 

		// Return Page contents. 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

		//grab URL and pass it to the variable. 
		curl_setopt($ch, CURLOPT_URL, $url); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, 'POST');
		curl_setopt($ch, CURLOPT_POSTFIELDS, $payloadName);


		$headers = array();
		curl_setopt($ch, CURLOPT_USERPWD, $this->username . ":" . $this->password);
        $headers[] = 'Authorization: Basic bWVyY2hhbnQuVEVTVDYwMjAwNjYwMDoyOTJjNDlhNzAyYTgzNjEzZGJkZTAxOWU0MDE1ZjI4OQ==';
        $headers[] = 'Content-Type: application/json';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		$result = curl_exec($ch); 
		$res = json_decode($result, true);

		$post_data=array();

        $post_data['merchant'] = $res['merchant'];
        $post_data['version'] = $res['session']['version'];
        $post_data['id'] = $res['session']['id'];
        $post_data['logo'] = base_url('extras/custom/TMX1703601574753064/images/logo.png');
        $post_data['merchant_name'] = "Any merchant name";
        $post_data['successIndicator'] = $res['successIndicator'];

        return $post_data;

	}
}
