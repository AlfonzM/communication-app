<?php
	require_once('_GenericRepository.php');
	require_once('../Model/PepperTalk.php');

	class PepperTalkRepository extends GenericRepository{

		public function __construct(){
			$this->entity = "pepperTalk_tb";
		}

		public function Save(PepperTalk $pepperTalk){
			try{
				$columns = "`pepperTalk_group`, `pepperTalk_conversation`, `pepperTalk_text`, `pepperTalk_output`, `pepperTalk_dis`";

				$query = "INSERT INTO `$this->entity`($columns) VALUES (:pepperTalk_group, :pepperTalk_conversation, :pepperTalk_text, :pepperTalk_output, :pepperTalk_dis);";

				if($_query = $this->communication_db->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY))){
					$parameters = array(':pepperTalk_group' => $pepperTalk->pepperTalk_group,
										':pepperTalk_conversation' => $pepperTalk->pepperTalk_conversation,
										':pepperTalk_text' => $pepperTalk->pepperTalk_text,
										':pepperTalk_output' => $pepperTalk->pepperTalk_output,
										':pepperTalk_dis' => 1);
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

		public function Update(PepperTalk $pepperTalk){
			try{
				$query = "UPDATE `$this->entity` SET `pepperTalk_group`= :pepperTalk_group, `pepperTalk_conversation`= :pepperTalk_conversation, `pepperTalk_text`= :pepperTalk_text, `pepperTalk_output`= :pepperTalk_output WHERE `pepperTalk_id` = :pepperTalk_id;";

				if($_query = $this->communication_db->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY))){
					$parameters = array(':pepperTalk_id' => $pepperTalk->pepperTalk_id,
										':pepperTalk_group' => $pepperTalk->pepperTalk_group,
										':pepperTalk_conversation' => $pepperTalk->pepperTalk_conversation,
										':pepperTalk_text' => $pepperTalk->pepperTalk_text,
										':pepperTalk_output' => $pepperTalk->pepperTalk_output,
										':pepperTalk_dis' => $pepperTalk->pepperTalk_dis);
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