<?php
	require_once('_GenericRepository.php');
	require_once('../Model/Conversation.php');

	class ConversationRepository extends GenericRepository{

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
					return $_query->execute($parameters);
				}
				else{
					throw new Exception('Failed');
				}
			}
			catch(Exception $exception){
				die($exception->getMessage());
			}
		}

		public function Update(Conversation $conversation){
			try{
				$query = "UPDATE `$this->entity` SET `conversation_title`= :conversation_title, `conversation_trigger`= :conversation_trigger, `conversation_priority`= :conversation_priority, `conversation_sharp`= :conversation_sharp, `conversation_speed`= :conversation_speed WHERE `conversation_id` = :conversation_id;";

				// return $query;

				if($_query = $this->communication_db->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY))){
					$parameters = array(':conversation_id' => $conversation->conversation_id,
										':conversation_title' => $conversation->conversation_title,
										':conversation_trigger' => $conversation->conversation_trigger,
										':conversation_priority' => $conversation->conversation_priority,
										':conversation_sharp' => $conversation->conversation_sharp,
										':conversation_speed' => $conversation->conversation_speed);
					return $_query->execute($parameters);
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