<?php
	require_once('../DataAccess/PepperTalkRepository.php');

	$transaction = $_POST['transaction'];

	if(!empty($transaction)){

		$pepperTalkRepository = new PepperTalkRepository();

		$pepperTalk_id = $_POST['pepperTalk_id'];
		$pepperTalk_group = $_POST['pepperTalk_group'];
		$pepperTalk_conversation = $_POST['pepperTalk_conversation'];
		$pepperTalk_text = $_POST['pepperTalk_text'];
		$pepperTalk_output = $_POST['pepperTalk_output'];

		if($transaction == "select"){
			$select_properties = array('`pepperTalk_id`',
										'`pepperTalk_group`',
										'`pepperTalk_text`',
										'`pepperTalk_output`');

			$arguments = "`pepperTalk_dis` = 1";

			$result = $pepperTalkRepository->GetList($select_properties, $arguments);

			echo json_encode($result);
		}
		elseif($transaction == "insert"){

			$pepperTalk = new pepperTalk();
			$pepperTalk->pepperTalk_group = $pepperTalk_group;
			$pepperTalk->pepperTalk_conversation = $pepperTalk_conversation;
			$pepperTalk->pepperTalk_text = $pepperTalk_text;
			$pepperTalk->pepperTalk_output = $pepperTalk_output;

			$result = $pepperTalkRepository->Save($pepperTalk);

			echo json_encode($result);
		}
		elseif($transaction == "update"){

			$pepperTalk = new pepperTalk();
			$pepperTalk->pepperTalk_id = $pepperTalk_id;
			$pepperTalk->pepperTalk_group = $pepperTalk_group;
			$pepperTalk->pepperTalk_conversation = $pepperTalk_conversation;
			$pepperTalk->pepperTalk_text = $pepperTalk_text;
			$pepperTalk->pepperTalk_output = $pepperTalk_output;

			$result = $pepperTalkRepository->Update($pepperTalk);

			echo json_encode($result);
		}
		elseif($transaction == "delete"){

			$result = $pepperTalkRepository->Delete($pepperTalk_id);

			echo json_encode($result);
		}
		else{
			echo json_encode("Invalid action!");
		}

	}
?>