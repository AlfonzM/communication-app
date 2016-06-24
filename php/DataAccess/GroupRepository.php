<?php
require_once('_GenericRepository.php');
require_once('Model/Group.php');

class GroupRepository extends GenericRepository{

	public function __construct(){
		parent::__construct('group_tb');
	}

	public function Save(Group $group){
		try{
			$columns = "`group_pepperTalkParent`, `group_dis`";

			$query = "INSERT INTO `$this->entity`($columns) VALUES (:group_pepperTalkParent, :group_dis);";

			if($_query = $this->communication_db->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY))){
				$parameters = array(':group_pepperTalkParent' => $group->group_pepperTalkParent,
					':group_dis' => 1);
				if($_query->execute($parameters)){
					$group->group_id = $this->communication_db->lastInsertId();

					// Also save the user replies
					if(count($group->userReplies) > 0){
						$userReplyRepository = new UserReplyRepository();
						foreach($group->userReplies as $userReply){
							$userReply->userReply_group = $group->group_id;
							$userReplyRepository->Save($userReply);
						}
					}

					// Save the peppertalk
					if(isset($group->pepperTalk) && $group->pepperTalk->pepperTalk_id == null){
						$pepperTalkRepository = new PepperTalkRepository();
						$group->pepperTalk->pepperTalk_group = $group->group_id;
						$group->pepperTalk->pepperTalk_conversation = $group->group_pepperParentConversation;
						$pepperTalkRepository->Save($group->pepperTalk);
					}

					return $group;
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

	public function GetListByConversationId($conversationId, $select_properties = [], $arguments = "", $options = ""){

		if(isset($conversationId)){
			$options = "JOIN pepperTalk_tb";
			$arguments = "pepperTalk_conversation=$conversationId";
			$result = $this->GetList($select_properties, $arguments, $options);

			return $result;
		} else {
			return false;
		}
	}

	public function GetListByPepperTalkId($pepperTalkId, $select_properties = [], $arguments = "", $options ="") {
		if(isset($pepperTalkId)){
			$arguments = "group_pepperTalkParent=$pepperTalkId AND `group_dis` = 1 GROUP BY group_id";
			$result = $this->GetList($select_properties, $arguments, $options);

			$groups = $result;

			$pepperTalkRepository = new PepperTalkRepository();
			$userReplyRepository = new UserReplyRepository();

			foreach($groups as $key => $group){
				$groupId = $group['group_id'];
				// Get the user replies of group
				$userReplies = $userReplyRepository->GetList([], "userReply_group=$groupId AND userReply_dis = 1");

				$groups[$key]['userReplies'] = $userReplies;

				// Get the peppertalk of group
				$pepperTalkOfGroup = $pepperTalkRepository->GetOneByGroupId($group['group_id'], [], "", "", false);
				$groups[$key]['pepperTalk'] = [];

				if($pepperTalkOfGroup) {
					$groups[$key]['pepperTalk'] = $pepperTalkOfGroup;
				}
			}

			return $groups;
		} else {
			return false;
		}	
	}

	public function Update(Group $group){
		try{
			$query = "UPDATE `$this->entity` SET `group_pepperTalkParent`= :group_pepperTalkParent WHERE `group_id` = :group_id;";

			if($_query = $this->communication_db->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY))){
				$parameters = array(':group_id' => $group->group_id,
					':group_pepperTalkParent' => $group->group_pepperTalkParent);

				if($_query->execute($parameters)){
					// Also update the user replies
					if(count($group->userReplies) > 0){

						// echo count($group->userReplies);exit;

						$userReplyRepository = new UserReplyRepository();
						foreach($group->userReplies as $userReply){

							if($userReply->userReply_id != null){
								$userReplyRepository->Update($userReply);
							} else {
								$userReply->userReply_group = $group->group_id;
								$userReplyRepository->Save($userReply);
							}
						}
					}

					// Update the peppertalk
					if(isset($group->pepperTalk)){
						$pepperTalkRepository = new PepperTalkRepository();

						if($group->pepperTalk->pepperTalk_id != null) {
							$pepperTalkRepository->Update($group->pepperTalk);
						} else {
							$group->pepperTalk->pepperTalk_group = $group->group_id;
							$group->pepperTalk->pepperTalk_conversation = $group->group_pepperParentConversation;
							$pepperTalkRepository->Save($group->pepperTalk);
						}
					}

					return $group;
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