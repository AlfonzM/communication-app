var apiUrl = 'http://localhost:8888/communication_web';

$(document).ready(function(){
	getConversationList();
	// getConversation(1);
	// editConversation();
	// createConversation();
});

function getConversationList(){
	$.ajax({
		url: apiUrl + '/php/conversations',
	    // data: 'transaction=edit',
	    type: 'GET',
	    dataType: 'json',
	    // async: true,
	    // cache: false,
	    success: function(conversations) {
	    	// alert(conversations[0].conversation_title);
	    	/* Success code */
	    	// alert(data.conversation[0].name);

	    	for(var id in conversations){
	    		var convo = conversations[id];
	    		console.log(convo.conversation_title + " " + convo.conversation_id);
	    	}
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
		url: apiUrl + '/php/conversations/' + id,
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
	var convo = {
		"conversation_id": null,
		"conversation_title": "This is a new Conversation Title",
		"conversation_trigger": "1",
		"conversation_priority": "1",
		"conversation_sharp": "135",
		"conversation_speed": "110",
		"conversation_dialogFile": "",
		"conversation_client": "4",
		"conversation_dis": "1",
		"pepperTalk": null
	}

	$.ajax({
		url: apiUrl + '/php/conversations',
	    data: convo,
	    type: 'POST',
	    dataType: 'json',
	    // async: true,
	    // cache: false,
	    success: function(data) {
	    	alert("Success");
	    	convo = data;
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
		url: apiUrl + '/php/conversations/1',
		dataType: "json",
		data: conversationData,
		type: "PUT",
		success: function(data){
			console.log(data);
		}
	});
}