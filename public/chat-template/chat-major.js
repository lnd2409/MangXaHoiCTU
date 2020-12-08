// Your web app's Firebase configuration
var firebaseConfig = {
    apiKey: "AIzaSyAKmobXNJAls9qdE-6aTTBYUpMzrtGAkIw",
    authDomain: "my-chat-app-7e47b.firebaseapp.com",
    databaseURL: "https://my-chat-app-7e47b.firebaseio.com",
    projectId: "my-chat-app-7e47b",
    storageBucket: "my-chat-app-7e47b.appspot.com",
    messagingSenderId: "570655077052",
    appId: "1:570655077052:web:d589c9e1bd4696fb4316b9",
    measurementId: "G-2RCQ1JE087"
};
// Initialize Firebase
firebase.initializeApp(firebaseConfig);
// firebase.analytics();

var myName = "{!! $student->stu_code !!}";
// console.log(myName);
// document.getElementById("name").innerHTML += myName;

function sendMessage() {
    //get message
    var message = document.getElementById("messaage").value;
    //save in database
    firebase.database().ref("messages").push().set({
        "sender" : myName,
        "message" : message,
    });
    var frm = document.getElementsByName('chat-form')[0];
    frm.reset();  // Reset all form data
    return false;
}
//listen for incoming message
firebase.database().ref("messages").on("child_added", function (snapshot) {
    var html = "";
    // give each message a unique ID
    //open tag
    if(snapshot.val().sender == myName){
        html += "<div id='message-" + snapshot.key + "' class='d-flex justify-content-end mb-4'>"
    }
    html += "<div id='message-" + snapshot.key + "' class='d-flex justify-content-start mb-4'>"
    // show delete button if message is sent by me
    if (snapshot.val().sender == myName) {
        html += "<a style='margin-top: 12px;margin-right: 12px;color: red;' data-id='" + snapshot.key + "' onclick='deleteMessage(this);'>";
            html += "<i class='fas fa-trash'></i>";
        html += "</a>";
    }
    html += "<div class='img_cont_msg'><img src='https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg' class='rounded-circle user_img_msg'></div>";
    html += "<div class='msg_cotainer'>" + snapshot.val().message + "<span class='msg_time'>" + snapshot.val().sender + "</span></div>";
    //close tag
    html += "</div>";
    console.log(snapshot.val().message);
    document.getElementById("messages").innerHTML += html;
});

function deleteMessage(self) {
    // get message ID
    var messageId = self.getAttribute("data-id");

    // delete message
    firebase.database().ref("messages").child(messageId).remove();
}

// attach listener for delete message
firebase.database().ref("messages").on("child_removed", function (snapshot) {
    // remove message node
    document.getElementById("message-" + snapshot.key).innerHTML = "Tin nhắn này đã bị xóa";
});
