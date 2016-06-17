$(document).ready(function(){
	// getConversationList();
	// getConversation(1);
	editConversation();
});

function getConversationList(){
	$.ajax({
		url: 'http://localhost:8888/communication_web/php/conversations',
	    // data: 'transaction=edit',
	    type: 'GET',
	    dataType: 'json',
	    // async: true,
	    // cache: false,
	    success: function(data) {
	    	alert(data[0].conversation_title);
	    	/* Success code */
	    	// alert(data.conversation[0].name);
	    },
	    error: function(e) {
	    	console.log(e);
	    	/* Error code */
	    	alert("ERROR");
	    	// alert("Can't connect to server.");
	    }
	});
}

function getConversation(id){
	$.ajax({
		url: 'http://localhost:8888/communication_web/php/conversations/' + id,
	    // data: 'transaction=edit',
	    type: 'GET',
	    dataType: 'json',
	    // async: true,
	    // cache: false,
	    success: function(conversation) {
	    	alert(conversation.conversation_title);
	    	alert(conversation.pepperTalk.pepperTalk_text);
	    	/* Success code */
	    	// alert(data.conversation[0].name);
	    },
	    error: function(e) {
	    	console.log(e);
	    	/* Error code */
	    	alert("ERROR");
	    	// alert("Can't connect to server.");
	    }
	});
}

function createConversation(){

	$.ajax({
		url: 'http://localhost:8888/communication_web/php/conversations',
	    // data: 'transaction=edit',
	    type: 'POST',
	    dataType: 'json',
	    // async: true,
	    // cache: false,
	    success: function(data) {
	    	alert(data[0].conversation_title);
	    	/* Success code */
	    	// alert(data.conversation[0].name);
	    },
	    error: function(e) {
	    	console.log(e);
	    	/* Error code */
	    	alert("ERROR");
	    	// alert("Can't connect to server.");
	    }
	});
}

function editConversation(){
	var conversationData = {
		"conversation_id": 1,
		"conversation_title": "This is a new Conversation Title",
		"conversation_trigger": "1",
		"conversation_priority": "1",
		"conversation_sharp": "135",
		"conversation_speed": "110",
		"conversation_dialogFile": "",
		"conversation_client": "4",
		"conversation_dis": "1",
		"pepperTalk": null
	};

	$.ajax({
		url: "http://localhost:8888/communication_web/php/conversations/1",
		dataType: "json",
		data: conversationData,
		type: "PUT",
		success: function(data){
			console.log(data);
		}
	});
}