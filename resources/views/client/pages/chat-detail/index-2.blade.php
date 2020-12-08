<h1>Danh sach cuoc tro chuyen</h1>
<ul id="messages">
</ul>

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
        //listen for incoming message
        firebase.database().ref("messages-detail/{!! Auth::guard('student')->user()->stu_code !!}").on("child_added", function (snapshot) {
                // console.log(snapshot.val() == myName)
                var html = "";
                html += "<li id='message-" + snapshot.key + "'>";
                html += snapshot.val().{!! Auth::guard('student')->user()->stu_code !!};
                html += "</li>";
                document.getElementById("messages").innerHTML += html;
                // console.log(snapshot.val().{!! Auth::guard('student')->user()->stu_code !!});
            console.log(snapshot.val());
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
