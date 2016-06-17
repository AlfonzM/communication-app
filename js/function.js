$(document).ready(function(){
	// getConversationList();
	// getConversation(1);
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