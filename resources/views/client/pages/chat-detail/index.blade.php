<div class="card-body msg_card_body" id="messages">
    {{-- chat content --}}
</div>
<div class="card-footer">
    <form onsubmit="return sendMessage();" name="chat-form">
        <div class="input-group">
            <input name="" class="form-control type_msg" id="messaage" placeholder="Nhập nội dung . . ."></input>
            <input type="submit">
        </div>
    </form>
</div>

<!-- The core Firebase JS SDK is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/7.19.1/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.19.1/firebase-database.js"></script>
<script>
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

        var myName = "{!! Auth::guard('student')->user()->stu_code !!}";
        var receiver = "{!! $sinhVien->stu_code !!}";

        function sendMessage() {
            //get message
            var message = document.getElementById("messaage").value;
            //save in database
            firebase.database().ref("messages-detail/"+receiver+"/"+myName).push(
                // {
                    // {!! $sinhVien->stu_code !!} :
                    {
                        "sender" : myName,
                        "message" : message,
                        "receiver" : receiver,
                        "status" : "0",
                    }
                // }
            );
            var frm = document.getElementsByName('chat-form')[0];
            frm.reset();  // Reset all form data
            return false;
        }
        //listen for incoming message
        firebase.database().ref("messages-detail").on("child_added", function (snapshot) {
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
            html += "<div class='msg_cotainer' style='max-width: 200px;'>" + snapshot.val().message + "<span class='msg_time'>---------" + snapshot.val().sender + "</span></div>";
            //close tag
            html += "</div>";
            // console.log(snapshot.val().message);
            document.getElementById("messages").innerHTML += html;
        });

        function deleteMessage(self) {
            // get message ID
            var messageId = self.getAttribute("data-id");

            // delete message
            firebase.database().ref("messages").child(messageId).remove();
        }

        // attach listener for delete message
        firebase.database().ref("messages-detail").on("child_removed", function (snapshot) {
            // remove message node
            document.getElementById("message-" + snapshot.key).innerHTML = "Tin nhắn này đã bị xóa";
        });

</script>
