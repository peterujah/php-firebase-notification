<?php 
/**
 * Service - Send firebase device push notification from php curl
 * @author      Peter Chigozie(NG) peterujah
 * @copyright   Copyright (c), 2022 Peter(NG) peterujah
 * @license     MIT public license
 */
namespace Peterujah\NanoBlock\Firebase;
use \Peterujah\NanoBlock\Firebase\ServiceModel;
 class Service {
	/** 
	* Holds notification broadcast type [single]
	* @static string 
	*/
	public const SINGLE = "single";

	/** 
	* Holds notification broadcast type [multiple]
	* @static string 
	*/
	public const GROUP = "multiple";

	/** 
	* Holds google firebase notification api key
	* @static string 
	*/
	protected $api_kay;

	/** 
	* Holds firebase notification endpoint
	* @static string 
	*/
	protected $endpoint =  'https://fcm.googleapis.com/fcm/send';


	/** 
	* Constructor
	* @param string $key google firebase service key 
	*/
	public function __construct($key) {
		$this->api_kay = $key;
	}

	/** 
	* Sends notification to all users
	* @param ServiceModel $payload
	* @return response|object|array response from google firebase service
	*/
	public function notifyAll(ServiceModel $payload){
		return $this->send((array) $payload->get(), self::GROUP);
	}

	/** 
	* Sends notification to a single user
	* @param ServiceModel $payload
	* @return response|object|array response from google firebase service
	*/
	public function notify(ServiceModel $payload){
		return $this->send((array) $payload->get(), self::SINGLE);
	}

	/** 
	* Sends notification network request to google firebase api 
	* @param array $payload
	* @param string $type
	* @return response|object|array response from google firebase service
	*/
	private function send($payload, $type) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->endpoint);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Authorization: key=' . $this->api_kay,
			'Content-Type: application/json'
		));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);   
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS,  json_encode($payload));
		$result = curl_exec($ch);        
		if ($result === false) {
			return 'FirebaseNotificationError: ' . curl_error($ch);
		}
		curl_close($ch);
		return json_decode($result, true);
	}
 
 }
