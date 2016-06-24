<?php 
class Conversation{
	public $conversation_id;
	public $conversation_title;
	public $conversation_trigger; 
	public $conversation_priority;
	public $conversation_sharp;
	public $conversation_speed;
	public $conversation_dialogFile;
	public $conversation_language;
	public $conversation_client;
	public $conversation_dis;

	public $pepperTalks;

	public function __construct($props){
		$client_id = 4;

		$this->conversation_id = $props['conversation_id'];
		$this->conversation_title = $props['conversation_title'];
		$this->conversation_trigger = $props['conversation_trigger'];
		$this->conversation_priority = $props['conversation_priority'];
		$this->conversation_sharp = $props['conversation_sharp'];
		$this->conversation_speed = $props['conversation_speed'];
		$this->conversation_dialogFile = $props['conversation_dialogFile'];
		$this->conversation_language = $props['conversation_language'];
		$this->conversation_client = $client_id;

		if(isset($props['pepperTalks'])){
			foreach($props['pepperTalks'] as $pepperTalkProps) {
				$this->pepperTalks[] = new PepperTalk($pepperTalkProps);
			}
		}
	}

	public function getPepperTalks(){
		$pepperTalkRepository = new PepperTalkRepository();

		$arguments = "pepperTalk_conversation={$this->conversation_id} AND pepperTalk_dis=1";

		$pepperTalksResult = $pepperTalkRepository->GetList([], $arguments);

		foreach($pepperTalksResult as $pepperTalk){
			$newPepperTalk = new PepperTalk($pepperTalk);
			$newPepperTalk->getGroups();

			$this->pepperTalks[] = $newPepperTalk;
		}

		return $this->pepperTalks;
	}

	public function generateDialog(){
		// Get the first pepper talk
		$pepperTalk = $this->pepperTalks[0];

		$this->conversation_dialogFile = "";

		$dialogTitle = preg_replace('/\s+/', '_', $this->conversation_title);

		$this->conversation_dialogFile .= "topic: ~{$dialogTitle}()\n";
		$this->conversation_dialogFile .= "language: {$this->conversation_language}\n\n";
		$this->conversation_dialogFile .= "u:(a) \\vct={$this->conversation_sharp}\\ \\rspd={$this->conversation_speed}\\ " . $pepperTalk->pepperTalk_text;
		$this->conversation_dialogFile .= "\n";

		// Traverse all groups from first pepper talk and generate dialog lines
		foreach($pepperTalk->groups as $group){
			if($group->group_dis == 1){
				$this->conversation_dialogFile .= $this->createLine($group, 1);
			}
		}
	}

	public function createLine($group, $lineNum){
		$string = "u{$lineNum}:(_[";

		foreach($group->userReplies as $userReply){
			if($userReply->userReply_dis == 1){
				$string .= '"'.$userReply->userReply_answer.'" ';
			}
		}

		$string = trim($string);

		// close user replies
		$string .= "]) ";

		// add velocity and speed
		$string .= "\\vct={$this->conversation_sharp}\\ \\rspd={$this->conversation_speed}\\ ";

		// add peppertalk text
		$string .= $group->pepperTalk->pepperTalk_text;
		$string .= "\n";

		if(count($group->pepperTalk->groups) > 0){
			foreach($group->pepperTalk->groups as $group) {
				if($group->group_dis == 1){
					$string .= $this->createLine($group, ++$lineNum);
				}
			}
		}

		return $string;
	}
}
?>