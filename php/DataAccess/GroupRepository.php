<?php
	require_once('_GenericRepository.php');
	require_once('../Model/Group.php');

	class GroupRepository extends GenericRepository{

		public function __construct(){
			$this->entity = "group_tb";
		}

		public function Save(Group $group){
			try{
				$columns = "`group_pepperTalkParent`, `group_dis`";

				$query = "INSERT INTO `$this->entity`($columns) VALUES (:group_pepperTalkParent, :group_dis);";

				if($_query = $this->communication_db->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY))){
					$parameters = array(':group_pepperTalkParent' => $group->group_pepperTalkParent,
										':group_dis' => 1);
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

		public function Update(Group $group){
			try{
				$query = "UPDATE `$this->entity` SET `group_pepperTalkParent`= :group_pepperTalkParent WHERE `group_id` = :group_id;";

				if($_query = $this->communication_db->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY))){
					$parameters = array(':group_id' => $group->group_id,
										':group_pepperTalkParent' => $group->group_pepperTalkParent);
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