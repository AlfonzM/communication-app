<?php
class Group{
	public $group_id;
	public $group_pepperTalkParent;
	public $group_pepperParentConversation;
	public $group_dis;
	public $userReplies;
	public $pepperTalk;

	public function __construct($props){
		$this->group_id = $props['group_id'];
		$this->group_pepperTalkParent = $props['group_pepperTalkParent'];
		$this->group_dis = $props['group_dis'];

		$this->userReplies = [];

		if(isset($props['userReplies'])){
			foreach($props['userReplies'] as $userReply) {
				$this->userReplies[] = new UserReply($userReply);
			}
		}

		$this->pepperTalk = new PepperTalk($props['pepperTalk']);
	}
}
?>