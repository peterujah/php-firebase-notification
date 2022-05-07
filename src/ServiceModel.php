<?php 
/**
 * Service - Send firebase device push notification from php curl
 * @author      Peter Chigozie(NG) peterujah
 * @copyright   Copyright (c), 2022 Peter(NG) peterujah
 * @license     MIT public license
 */
namespace Peterujah\NanoBlock\Firebase;
class ServiceModel {
	/** 
	* Holds notification payload type [data]
	* @static string 
	*/
	public const NODE_DATA = "data";

	/** 
	* Holds notification payload type [notification]
	* @static string 
	*/
	public const NODE_NOTIFICATION = "notification";

	/** 
	* Holds notification broadcast type for topic
	* @static bool 
	*/
	public const IS_TOPIC = true;

	/** 
	* Holds notification broadcast payload node|type
	* @var string 
	*/
	private $node;

	/** 
	* Holds notification receiver id
	* @var string|array
	*/
	private $to;

	/** 
	* Holds notification title
	* @var string 
	*/
	private $title;

	/** 
	* Holds notification message
	* @var string 
	*/
	private $message;

	/** 
	* Holds notification message-body
	* @var string 
	*/
	private $body;

	/** 
	* Holds notification image url
	* @var string|url
	*/
	private $image = null;

	/** 
	* Holds notification topic state
	* @var bool 
	*/
	private $is_topic;

	/** 
	* Holds notification vibration state 
	* @var int 
	*/
	private $vibrate = 1;

	/** 
	* Holds notification sound type
	* @var string 
	*/
	private $sound = "default";

	/** 
	* Holds notification icon type
	* @var string 
	*/
	private $icon = null; 

	/** 
	* Holds notification priority state
	* @var string 
	*/
	private $priority = "high";

	/** 
	* Holds notification click action
	* @var string 
	*/
	private $click_action = null;

	/** 
	* Holds notification broadcast id
	* @var string 
	*/
	private $broadcast = "RECEIVED_APP_NOTIFICATION";

	/** 
	* Holds notification reference id
	* @var string 
	*/
	private $reference = "RECEIVED_APP_NOTIFICATION";

	/** 
	* Holds notification content url
	* @var string|url
	*/
	private $url = null;

	/** 
	* Holds notification meta
	* @var array 
	*/
	private $meta = array();

	/** 
	* Holds notification badge code
	* @var int 
	*/
	private $badge = 0;

	/** 
	* Holds notification background state
	* @var array 
	*/
	private $is_background;

	/** 
	* Constructor
	*/
	function __construct() {
		$this->setNode(self::NODE_NOTIFICATION);
		$this->setIsTopic(!self::IS_TOPIC);
		$this->setIsBackground(false);
		$this->setReference(uniqid());
	}

	/** 
	* Sets registration ids or topic 
	* @param string $to
	* @return ServiceModel|object class instance
	*/
	public function setTo($to) {
		$this->to = $to;
		return $this;
	}

	/** 
	* Sets notification payload node
	* @param string $node
	* @return ServiceModel|object class instance
	*/
	public function setNode($node) {
		$this->node = $node;
		return $this;
	}
	
	/** 
	* Sets notification title
	* @param string $title
	* @return ServiceModel|object class instance
	*/
	public function setTitle($title) {
		$this->title = $title;
		return $this;
	}

	/** 
	* Sets notification message
	* @param string $message
	* @return ServiceModel|object class instance
	*/
	public function setMessage($message) {
		$this->message = $message;
		return $this;
	}
	
	/** 
	* Sets notification message body
	* @param string $body
	* @return ServiceModel|object class instance
	*/
	public function setBody($body) {
		$this->body = $body;
		return $this;
	}

	/** 
	* Sets notification image url
	* @param string $url
	* @return ServiceModel|object class instance
	*/
	public function setImage($url) {
		$this->image = $url;
		return $this;
	}

	/** 
	* Sets notification vibration stats
	* @param int $vibrate
	* @return ServiceModel|object class instance
	*/
	public function setVibrate($vibrate) {
		$this->vibrate = $vibrate;
		return $this;
	}

	/** 
	* Sets notification sound type
	* @param string $sound
	* @return ServiceModel|object class instance
	*/
	public function setSound($sound) {
		$this->sound = $sound;
		return $this;
	}
	
	/** 
	* Sets notification icon type
	* @param string $icon
	* @return ServiceModel|object class instance
	*/
	public function setIcon($icon) {
		$this->icon = $icon;
		return $this;
	}

	/** 
	* Sets notification priority
	* @param string $priority
	* @return ServiceModel|object class instance
	*/
	public function setPriority($priority) {
		$this->priority = $priority;
		return $this;
	}

	/** 
	* Sets notification background state
	* @param bool $allow
	* @return ServiceModel|object class instance
	*/
	public function setIsBackground($allow) {
		$this->is_background = $allow;
		return $this;
	}

	/** 
	* Sets notification topic enable state
	* @param bool $allow
	* @return ServiceModel|object class instance
	*/
	public function setIsTopic($allow) {
		$this->is_topic = $allow;
		return $this;
	}
	
	/** 
	* Sets notification click action
	* @param string $click
	* @return ServiceModel|object class instance
	*/
	public function setClickAction($click) {
		$this->click_action = $click;
		return $this;
	}

	/** 
	* Sets notification link
	* @param string|url $link
	* @return ServiceModel|object class instance
	*/
	public function setLink($link) {
		$this->url = $url;
		return $this;
	}

	/** 
	* Sets notification broadcast id
	* @param string $id
	* @return ServiceModel|object class instance
	*/
	public function setBroadcast($id) {
		$this->broadcast = $id;
		return $this;
	}

	/** 
	* Sets notification reference id
	* @param string $ref
	* @return ServiceModel|object class instance
	*/
	public function setReference($ref) {
		$this->reference = $reference;
		return $this;
	}

	/** 
	* Sets notification badge code
	* @param int $badge
	* @return ServiceModel|object class instance
	*/
	public function setBadge($badge) {
		$this->badge = $badge;
		return $this;
	}

	/** 
	* Sets notification additional meta
	* @param array $meta
	* @return ServiceModel|object class instance
	*/
	public function setMeta($meta) {
		$this->meta = $meta;
		return $this;
	}

	/** 
	* Gets notification payload array
	* @return array computed array
	*/
	public function get() {
		$request = array();  
		$body = (!empty($this->body) ? $this->body : $this->message);
		if(!empty($this->to)){
			if(is_array($this->to) && !$this->is_topic){
				$request['registration_ids'] = (array) $this->to;
			}else{
				$request['to'] = ($this->is_topic ? "/topics/{$this->to}" : $this->to);
			}
			if($this->node != self::NODE_DATA){
				$request['data']['title'] = $this->title;
				$request['data']['image'] = $this->image; 
				if(!empty($this->image)){
					$request['data']['attachment-url'] = $this->image; 
				}
				$request['data']['body'] = $body;
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
		$request[$this->node]['body'] = $body;
		$request[$this->node]['icon'] = $this->icon;
		$request[$this->node]['image'] = $this->image; 
		$request[$this->node]['sound'] = $this->sound;
		$request[$this->node]['vibrate'] = $this->vibrate; 
		$request[$this->node]['datetime'] = date('Y-m-d G:i:s');
		$request[$this->node]['timestamp'] = time();
		return $request;
	}
}
