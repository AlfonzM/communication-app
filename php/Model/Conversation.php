<?php 
class Conversation{
	public $conversation_id;
	public $conversation_title;
	public $conversation_trigger; 
	public $conversation_priority;
	public $conversation_sharp;
	public $conversation_speed;
	public $conversation_dialogFile;
	public $conversation_client;
	public $conversation_dis;

	public $pepperTalk;

	public function __construct($props){
		$client_id = 4;

		$this->conversation_title = $props['conversation_title'];
		$this->conversation_trigger = $props['conversation_trigger'];
		$this->conversation_priority = $props['conversation_priority'];
		$this->conversation_sharp = $props['conversation_sharp'];
		$this->conversation_speed = $props['conversation_speed'];
		$this->conversation_client = $client_id;

		// var_dump($props);exit;

		if(isset($props['pepperTalk']) && !empty($props['pepperTalk'])){
			$this->pepperTalk = new PepperTalk($props['pepperTalk']);
		}
	}
}
?>