<?php 
/**
 * OBCompress - A simple php class to compress output buffer
 * @author      Peter Chigozie(NG) peterujah
 * @copyright   Copyright (c), 2021 Peter(NG) peterujah
 * @license     MIT public license
 */
namespace Peterujah\NanoBlock\Firebase;
class ServiceModel {
    public const NODE_DATA = "data";
    public const NODE_NOTIFICATION = "notification";
    public const TOPIC = true;
    public const IDS = false;
	private $node;
	private $payloadtype = 1;
	private $to;
	private $title;
	private $message;
	private $body;
	private $image = null;
	private $data;
	private $is_topic;
	private $vibrate = 1;
	private $sound = "default";
	private $icon = null; 
	private $priority = "high";
	private $click_action = null;
	private $broadcast = "RECEIVED_APP_NOTIFICATION";
	private $url = null;
	private $meta = null;
	private $badge = 0;
	private $is_background;

	function __construct() {
        $this->setNode(self::NODE_NOTIFICATION);
        $this->setIsTopic(self::IDS);
	}

	public function setTo($to) {
		$this->to = $to;
        return $this;
	}
	
	public function setNode($node) {
		$this->node = $node;
        return $this;
	}
	
	public function setPayloadType($payloadtype) {
		$this->payloadtype = $payloadtype;
        return $this;
	}
	
	public function setTitle($title) {
		$this->title = $title;
        return $this;
	}

	public function setMessage($message) {
		$this->message = $message;
        return $this;
	}
	
	public function setBody($body) {
		$this->body = $body;
        return $this;
	}

	public function setImage($imageUrl) {
		$this->image = $imageUrl;
        return $this;
	}

	public function setPayload($data) {
		$this->data = $data;
        return $this;
	}
	
	public function setVibrate($vibrate) {
		$this->vibrate = $vibrate;
        return $this;
	}
	
	public function setSound($sound) {
		$this->sound = $sound;
        return $this;
	}
	
	public function setIcon($icon) {
		$this->icon = $icon;
        return $this;
	}
	public function setPriority($priority) {
		$this->priority = $priority;
        return $this;
	}

	public function setIsBackground($is_background) {
		$this->is_background = $is_background;
        return $this;
	}
	
	public function setIsTopic($is_topic) {
		$this->is_topic = $is_topic;
        return $this;
	}
	
	public function setClickAction($click) {
		$this->click_action = $click;
        return $this;
	}

	public function setLink($url) {
		$this->url = $url;
        return $this;
	}

	public function setBroadcast($broadcast) {
		$this->broadcast = $broadcast;
        return $this;
	}

	public function setBadge($badge) {
		$this->badge = $badge;
        return $this;
	}
	
	public function setMeta($ArrayMeta) {
		$this->meta = $ArrayMeta;
        return $this;
	}

	public function get() {
		$request = array();  
		//if($this->payloadtype == 1){}
		if(!empty($this->to)){
			if(is_array($this->to) && !$this->is_topic){
				$request['registration_ids'] = (array) $this->to;
			}else{
				$request['to'] = $this->to ;
			}
			if($this->node != self::NODE_DATA){
				$request['data']['title'] = $this->title;
				$request['data']['image'] = $this->image; 
				if(!empty($this->image)){
					$request['data']['attachment-url'] = $this->image; 
				}
				$request['data']['body'] = (!empty($this->body) ? $this->body : $this->message);
				$request['data']['click_action'] = $this->click_action; 
				$request['data']['broadcast'] = $this->broadcast; 
				$request['data']['badge'] = $this->badge; 
				$request['data']['url'] = $this->url; 
				$request['data']['meta'] = $this->meta; 
			}
		}
		$request['priority'] =  $this->priority;
		$request['content-available'] = true;
		$request[$this->node]['title'] = $this->title;
		$request[$this->node]['is_background'] = $this->is_background;
		$request[$this->node]['message'] = $this->message;
		$request[$this->node]['body'] = (!empty($this->body) ? $this->body : $this->message);
		$request[$this->node]['icon'] = $this->icon;
		$request[$this->node]['image'] = $this->image; 
		$request[$this->node]['sound'] = $this->sound;
		$request[$this->node]['vibrate'] = $this->vibrate; 
		$request[$this->node]['datetime'] = date('Y-m-d G:i:s');
		$request[$this->node]['timestamp'] = time();
		return $request;
	}
}
