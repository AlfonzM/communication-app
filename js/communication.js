var conversationCollection = [];
var dialogueResponseCount = 0;

function Conversation(conversation = null){
                   this.localID = conversationCollection.length;

           this.conversation_id = -1;
        this.conversation_title = "Untitled "+this.localID;
      this.conversation_trigger = "1";
     this.conversation_priority = "1";
        this.conversation_sharp = -1;
        this.conversation_speed = -1;
       this.conversation_client = -1;
          this.conversation_dis = false;
       this.conversation_remove = 0;
               this.pepperTalks = [];

 this.addDialogue = function (props = null){
   var dialogue;

   if(props){
    dialogue = new PepperTalk(props); 
   } else {
    dialogue = new PepperTalk();
   }

   dialogue.localID =  this.pepperTalks.length;
   this.pepperTalks.push(dialogue);
   return dialogue;
 }

 for(var prop in conversation){
  if(prop == "pepperTalks"){
    for(var index in conversation.pepperTalks){
      this.addDialogue(conversation.pepperTalks[index]);
    }
  } else {
    this[prop] = conversation[prop];
  }
 }

 if(this.pepperTalks.length <= 0 ){
   this.addDialogue();
 }
}

function PepperTalk(pepperTalk){
                this.localID = -1;

          this.pepperTalk_id = -1;
       this.pepperTalk_group = -1;
this.pepperTalk_conversation = 0;
        this.pepperTalk_text = "";
      this.pepperTalk_output = "";
      this.pepperTalk_remove = 0;
                 this.groups = [];

 this.addResponse = function (props){
   var response = new Group();
   response.localID = dialogueResponseCount;
   response.pepperTalkParent = this.localID;

   console.log(this.id);

   if(props){
    this.init(props);
   }

   dialogueResponseCount++;
   this.groups.push(response);
   return response;
 }

  for(var prop in pepperTalk){
    if(prop == "groups"){
      for(var index in pepperTalk.groups){
        this.groups.push(new Group(pepperTalk.groups[index]));
      }
    } else {
      this[prop] = pepperTalk[prop];
    }
  }
}


function Group(group){
                 this.localID = -1;

                this.group_id = -1;
  this.group_pepperTalkParent = -1;
 // this.group_pepperResponse = "";
          // this.group_child = -1;
               this.group_dis = true;
            this.group_remove = 0;

             this.userReplies = [];
              this.pepperTalk = null;

  this.child = function(){
    return this.group_pepperTalk.pepperTalk_id;
  }

  this.pepperResponse = function(){
    return this.group_pepperTalk.pepperTalk_text;
  }

 this.addUserResponse = function(props){
   var userResponse;

   if(props){
    userResponse = new UserReply(props);
   } else {
    userResponse = new UserReply();
   }

   userResponse.localID = this.userReplies.length;
   this.userReplies.push(userResponse);
   return userResponse;
 }

 this.changeResponse = function($inputField, newVal){
   $inputField.val(newVal);
 }

  for(var prop in group){
    if(prop == "userReplies"){
      for(var index in group.userReplies){
        this.addUserResponse(group.userReplies[index]);
      }
    }
    else {
      this[prop] = group[prop];
    }

    if(prop == "pepperTalk"){
      group.pepperTalk.groups = [];
    }
  }

}

function UserReply(userReply){
            this.localID = -1;

       this.userReply_id = -1;
   this.userReply_answer = "";
    this.userReply_group = -1;
   this.userReply_remove = 0;

  for(var prop in userReply){
    this[prop] = userReply[prop];
  }
}

function Clone(obj){
    if(obj == null || typeof(obj) != 'object')
        return obj;

    var temp = new obj.constructor();
    for(var key in obj)
        temp[key] = Clone(obj[key]);

    return temp;
}