<?php
	require_once('../DataAccess/TriggerRepository.php');

	$transaction = $_POST['transaction'];

	if(!empty($transaction)){

		$triggerRepository = new TriggerRepository();

		$trigger_id = $_POST['trigger_id'];
		$trigger_name = $_POST['trigger_name'];

		if($transaction == "select"){
			$select_properties = array('`trigger_id`',
										'`trigger_name`');

			$arguments = "`trigger_dis` = 1";

			$result = $triggerRepository->GetList($select_properties, $arguments);

			echo json_encode($result);
		}
		elseif($transaction == "insert"){

			$trigger = new Trigger();
			$trigger->trigger_name = $trigger_name;

			$result = $triggerRepository->Save($trigger);

			echo json_encode($result);
		}
		elseif($transaction == "update"){

			$trigger = new Trigger();
			$trigger->trigger_id = $trigger_id;
			$trigger->trigger_name = $trigger_name;

			$result = $triggerRepository->Update($trigger);

			echo json_encode($result);
		}
		elseif($transaction == "delete"){

			$result = $triggerRepository->Delete($trigger_id);

			echo json_encode($result);
		}
		else{
			echo json_encode("Invalid action!");
		}

	}
?>