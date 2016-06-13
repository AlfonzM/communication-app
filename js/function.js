$(document).ready(function(){
	getArray();
});

function getArray(){
	$.ajax({
	    url: './php/Controller/ConversationController.php',
	    data: 'transaction=edit',
	    type: 'POST',
	    dataType: 'json',
	    async: true,
	    cache: false,
	    success: function(data) {
	    	alert(data);
	    	/* Success code */
	    	alert(data.conversation[0].name);
	    },
	    error: function() {
	    	/* Error code */
	    	alert("Can't connect to server.");
	    }
	});
}