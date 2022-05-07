<?php 
/**
 * OBCompress - A simple php class to compress output buffer
 * @author      Peter Chigozie(NG) peterujah
 * @copyright   Copyright (c), 2021 Peter(NG) peterujah
 * @license     MIT public license
 */
namespace Peterujah\NanoBlock\Firebase;
use \Peterujah\NanoBlock\Firebase\ServiceModel;
 class Service {
    public const SINGLE = "single";
    public const GROUP = "multiple";
    protected $api_kay;
    protected $endpoint =  'https://fcm.googleapis.com/fcm/send';

    public function __construct($key) {
        $this->api_kay = $key;
    }

    public function notifyAll(ServiceModel $payload){
        return $this->send((array) $payload->get(), self::GROUP);
    }

    public function notify(ServiceModel $payload){
        return $this->send((array) $payload->get(), self::SINGLE);
    }

	private function send($sendFields, $type) {
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
		curl_setopt($ch, CURLOPT_POSTFIELDS,  json_encode($sendFields));
		$result = curl_exec($ch);        
		if ($result === false) {
			return 'FirebaseNotificationError: ' . curl_error($ch);
		}
		curl_close($ch);
		return json_decode($result, true);
	}
 
 }
