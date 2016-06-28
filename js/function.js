var apiUrl = 'http://localhost:8888/communication_web';

function Test(){
	this.id = 0;
	this.text = "hi";
	this.words = ['he', 'lo', 'world'];

	this.getText = function(){
		return this.text;
	}
}

$(document).ready(function(){
	// var test = new Test();
	// console.log(test);
	// test = Object.assign({"id":3, "text":'qwer'});
	// test.words = ['qwe', '123'];

	// console.log(test);
	// console.log(JSON.stringify(test));

	getConversationList();
	// getConversation(1);
	// editConversation();
	// createConversation();
});

function getConversationList(){
	$.ajax({
		url: apiUrl + '/php/conversations',
		type: 'GET',
		dataType: 'json',
		success: function(conversations) {

    		// Add all Conversations to collection
    		for(var index in conversations){
    			var convo = conversations[index];

    			var newConvo = new Conversation(convo);
    			conversationCollection.push(newConvo);
    			break;
	    	}
	    	console.log(JSON.stringify(conversationCollection));

	    	// conversationCollection[0].toJson();
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