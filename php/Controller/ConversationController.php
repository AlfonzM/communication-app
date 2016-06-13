<?php
	require_once('../DataAccess/ConversationRepository.php');

	// // $transaction = $_POST['transaction'];
	$transaction = "select";

	// // check authorization here and get client ID
	$client_id = 4; 

	if(!empty($transaction)){

		$conversationRepository = new ConversationRepository("conversation_tb");

		// $conversation_id = $_POST['conversation_id'];
		// $conversation_title = $_POST['conversation_title'];
		// $conversation_trigger = $_POST['conversation_trigger'];
		// $conversation_priority = $_POST['conversation_priority'];
		// $conversation_sharp = $_POST['conversation_sharp'];
		// $conversation_speed = $_POST['conversation_speed'];

		if($transaction == "select"){
			$select_properties = array('`conversation_id`',
										'`conversation_title`',
										'`conversation_trigger`');

			$arguments = "`conversation_dis` = 1";

			$result = $conversationRepository->GetList($select_properties, $arguments);

			echo json_encode($result);
		}
		elseif($transaction == "edit"){
			$conversation_id = $_POST['conversation_id'];

			$select_properties = array('`conversation_id`',
										'`conversation_title`',
										'`conversation_trigger`',
										'`conversation_priority`',
										'`conversation_sharp`',
										'`conversation_speed`');

			$arguments = "`conversation_dis` = 1";

			$result = $conversationRepository->GetOne($select_properties, $arguments);

			// $result = array();
			// $conversation = array();
			// $conversation[0]['id'] = 1;
			// $conversation[0]['name'] = "One";
			// $conversation[0]['text'] = "One (1)";

			// $conversation[1]['id'] = 2;
			// $conversation[1]['name'] = "Two";
			// $conversation[1]['text'] = "Two (2)";

			// $conversation[2]['id'] = 3;
			// $conversation[2]['name'] = "Three";
			// $conversation[2]['text'] = "Three (3)";

			// $pepperTalk = array();
			// $pepperTalk[0]['id'] = 1;
			// $pepperTalk[0]['file'] = "one.txt";
			// $pepperTalk[0]['link'] = "file/one.txt";
			// $pepperTalk[0]['dis'] = 1;

			// $pepperTalk[1]['id'] = 2;
			// $pepperTalk[1]['file'] = "two.txt";
			// $pepperTalk[1]['link'] = "file/two.txt";
			// $pepperTalk[1]['dis'] = 1;

			// $result['conversation'] = $conversation;
			// $result['pepperTalk'] = $pepperTalk;

			echo json_encode($result);
		}
		elseif($transaction == "insert"){
			// $conversation_title = $_POST['conversation_title'];
			// $conversation_trigger = $_POST['conversation_trigger'];
			// $conversation_priority = $_POST['conversation_priority'];
			// $conversation_sharp = $_POST['conversation_sharp'];
			// $conversation_speed = $_POST['conversation_speed'];

			$conversation_title = 'Dark Souls 2: The Fall of Vendrick';
			$conversation_trigger = 1;
			$conversation_priority = 4;
			$conversation_sharp = 130;
			$conversation_speed = 110;

			$conversation = new Conversation();
			$conversation->conversation_title = $conversation_title;
			$conversation->conversation_trigger = $conversation_trigger;
			$conversation->conversation_priority = $conversation_priority;
			$conversation->conversation_sharp = $conversation_sharp;
			$conversation->conversation_speed = $conversation_speed;
			$conversation->conversation_client = $client_id;

			$result = $conversationRepository->Save($conversation);

			echo json_encode($result);
		}
		elseif($transaction == "update"){
			// $conversation_id = $_POST['conversation_id'];
			// $conversation_title = $_POST['conversation_title'];
			// $conversation_trigger = $_POST['conversation_trigger'];
			// $conversation_priority = $_POST['conversation_priority'];
			// $conversation_sharp = $_POST['conversation_sharp'];
			// $conversation_speed = $_POST['conversation_speed'];

			$conversation_id = 3;
			$conversation_title = 'The Witcher 2: Assassin of Kings';
			$conversation_trigger = 2;
			$conversation_priority = 3;
			$conversation_sharp = 130;
			$conversation_speed = 110;

			$conversation = new Conversation();
			$conversation->conversation_id = $conversation_id;
			$conversation->conversation_title = $conversation_title;
			$conversation->conversation_trigger = $conversation_trigger;
			$conversation->conversation_priority = $conversation_priority;
			$conversation->conversation_sharp = $conversation_sharp;
			$conversation->conversation_speed = $conversation_speed;
			// $conversation->conversation_client = $client_id;

			$result = $conversationRepository->Update($conversation);

			echo json_encode($result);
		}
		elseif($transaction == "delete"){
			// $conversation_id = $_POST['conversation_id'];

			$conversation_id = 6;

			$result = $conversationRepository->Delete($conversation_id);

			echo json_encode($result);
		}
		else{
			echo json_encode("Invalid action!");
		}

	}
?>