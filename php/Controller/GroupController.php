<?php
	require_once('../DataAccess/GroupRepository.php');

	$transaction = $_POST['transaction'];

	if(!empty($transaction)){

		$groupRepository = new GroupRepository();

		$group_id = $_POST['group_id'];
		$group_pepperTalkParent = $_POST['group_pepperTalkParent'];

		if($transaction == "select"){
			$select_properties = array('`group_id`',
										'`group_pepperTalkParent`');

			$arguments = "`group_dis` = 1";

			$result = $groupRepository->GetList($select_properties, $arguments);

			echo json_encode($result);
		}
		elseif($transaction == "insert"){

			$group = new Group();
			$group->group_pepperTalkParent = $group_pepperTalkParent;

			$result = $groupRepository->Save($group);

			echo json_encode($result);
		}
		elseif($transaction == "update"){

			$group = new Group();
			$group->group_id = $group_id;
			$group->group_pepperTalkParent = $group_pepperTalkParent;

			$result = $groupRepository->Update($group);

			echo json_encode($result);
		}
		elseif($transaction == "delete"){

			$result = $groupRepository->Delete($group_id);

			echo json_encode($result);
		}
		else{
			echo json_encode("Invalid action!");
		}

	}
?>