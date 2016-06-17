<?php
require_once('_GenericRepository.php');
require_once('Model/Conversation.php');

class ConversationRepository extends GenericRepository{

	public function __construct(){
		parent::__construct('conversation_tb');
	}

	public function Save(Conversation $conversation){
		try{
			$columns = "`conversation_title`, `conversation_trigger`, `conversation_priority`, `conversation_sharp`, `conversation_speed`, `conversation_client`, `conversation_dis`";
			$query = "INSERT INTO `$this->entity`($columns) VALUES (:conversation_title, :conversation_trigger, :conversation_priority, :conversation_sharp, :conversation_speed, :conversation_client, :conversation_dis);";

			if($_query = $this->communication_db->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY))){
				$parameters = array(':conversation_title' => $conversation->conversation_title,
					':conversation_trigger' => $conversation->conversation_trigger,
					':conversation_priority' => $conversation->conversation_priority,
					':conversation_sharp' => $conversation->conversation_sharp,
					':conversation_speed' => $conversation->conversation_speed,
					':conversation_client' => $conversation->conversation_client,
					':conversation_dis' => 1);
				if($_query->execute($parameters)){
					$conversation->conversation_id = $this->communication_db->lastInsertId();

					if(!isset($conversation->pepperTalk)){
						return $conversation;
					}

					// Set the conversation's peppertalk conversation id to the newly inserted conversation's ID
					$conversation->pepperTalk->pepperTalk_conversation = $conversation->conversation_id;

					$pepperTalkRepository = new PepperTalkRepository();
					if($pepperTalkRepository->Save($conversation->pepperTalk)) {
						return $conversation;
					} else {
						return false;
					}
				} else {
					return false;
				}
			}
			else{
				throw new Exception('Failed');
			}
		}
		catch(Exception $exception){
			die($exception->getMessage());
		}
	}

	public function GetOne(array $select_properties, $arguments = "", $options = ""){
		$conversation = parent::GetOne($select_properties, $arguments, $options);

		$pepperTalkRepository = new PepperTalkRepository();

		$conversation['pepperTalk'] = $pepperTalkRepository->GetOneByGroupId(0, [], "pepperTalk_conversation=" . $conversation['conversation_id']);

		return $conversation;
	}

	public function Update(Conversation $conversation){
		try{
			$query = "UPDATE `$this->entity` SET `conversation_title`= :conversation_title, `conversation_trigger`= :conversation_trigger, `conversation_priority`= :conversation_priority, `conversation_sharp`= :conversation_sharp, `conversation_speed`= :conversation_speed WHERE `conversation_id` = :conversation_id;";

			if($_query = $this->communication_db->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY))){
				$parameters = array(':conversation_id' => $conversation->conversation_id,
					':conversation_title' => $conversation->conversation_title,
					':conversation_trigger' => $conversation->conversation_trigger,
					':conversation_priority' => $conversation->conversation_priority,
					':conversation_sharp' => $conversation->conversation_sharp,
					':conversation_speed' => $conversation->conversation_speed);
				if($_query->execute($parameters)){
					if(!isset($conversation->pepperTalk)){
						return $conversation;
					}

					echo $conversation->conversation_id;

					$conversation->pepperTalk->pepperTalk_conversation = $conversation->conversation_id;

					$pepperTalkRepository = new PepperTalkRepository();

					$result = "";

					if($conversation->pepperTalk->pepperTalk_id != null){
						$result = $pepperTalkRepository->Update($conversation->pepperTalk);
					} else {
						$result = $pepperTalkRepository->Save($conversation->pepperTalk);
					}

					if($result) {
						return $conversation;
					} else {
						return false;
					}
				} else {
					return false;
				}
			}
			else{
				throw new Exception('Failed');
			}
		}
		catch(Exception $exception){
			die($exception->getMessage());
		}
	}

}

?>