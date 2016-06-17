<?php
require_once('DataAccess/ConversationRepository.php');

// TODO: check authorization here and get client ID

/* Get all conversations */
$app->get('/conversations', function ($request) {
	$conversationRepository = new ConversationRepository();

	$select_properties = array('`conversation_id`',
		'`conversation_title`',
		'`conversation_trigger`',
		'`pepperTalk_id`',
		'`pepperTalk_text`'
	);

	$arguments = "`conversation_dis` = 1";

	$options = "LEFT JOIN pepperTalk_tb ON conversation_id=pepperTalk_conversation";
	$arguments = "pepperTalk_group = 0 OR pepperTalk_group IS NULL";

	$result = $conversationRepository->GetList($select_properties, $arguments, $options);

	pretty_json_encode($result);
});

/* Get conversation by ID */
$app->get('/conversations/{id}', function($request) {
	$conversationRepository = new ConversationRepository();
	$groupRepository = new GroupRepository();

	$arguments = "`conversation_dis` = 1";

	$conversation_id = $request->getAttribute('id');

	$result = $conversationRepository->GetOne([], "conversation_id=$conversation_id");

	pretty_json_encode($result);
});

/* Save a conversation */
$app->post('/conversations', function($request) {
	$conversationRepository = new ConversationRepository();

	$conversation = new Conversation($request->getParsedBody());

	$result = $conversationRepository->Save($conversation);

	pretty_json_encode($result);
});

/* Edit conversation */
$app->put('/conversations/{id}', function($request){
	$conversationRepository = new ConversationRepository();

	$arguments = "`conversation_dis` = 1";

	$conversation = new Conversation($request->getParsedBody());

	$conversation_id = $request->getAttribute('id');
	$conversation->conversation_id = $conversation_id;

	$result = $conversationRepository->Update($conversation);

	pretty_json_encode($conversation);
});

/* Delete conversation */
$app->delete('/conversations/{id}', function($request) {
	$conversationRepository = new ConversationRepository();
	$conversation_id = $request->getAttribute('id');
	$result = $conversationRepository->Delete($conversation_id);

	pretty_json_encode($result);
});

?>