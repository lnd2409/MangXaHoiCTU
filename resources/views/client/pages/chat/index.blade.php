<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html>
	<head>
		<title>Chat</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.js"></script>
        <link rel="stylesheet" href="{{ asset('/chat-template/style.css') }}">
	</head>
	<!--Coded With Love By Mutiullah Samim-->
	<body>
		<div class="container-fluid h-100">
			<div class="row justify-content-center h-100">
				<div class="col-md-4 col-xl-3 chat"><div class="card mb-sm-3 mb-md-0 contacts_card">
					<div class="card-header">
						<div class="input-group">
                            <h2>Nhóm</h2>
                            <p style="font-weight: bold">{{ $studentInClass->major_name }}-{{ $studentInClass->course_name }}</p>
                            <p style="margin-bottom: 0px;">Thành viên</p>
						</div>
					</div>
					<div class="card-body contacts_body">
						<ui class="contacts">
                            @foreach ($listStudent as $item)
                                <li class="active">
                                    <div class="d-flex bd-highlight">
                                        <div class="img_cont">
                                            <img src="https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg" class="rounded-circle user_img">
                                        </div>
                                        <div class="user_info">
                                            <span>{{ $item->stu_name }}</span>
                                            <p>{{ $item->stu_code }}</p>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
						</ui>
					</div>
					<div class="card-footer"></div>
				</div></div>
				<div class="col-md-8 col-xl-6 chat">
					<div class="card">
						<div class="card-header msg_head">
							<div class="d-flex bd-highlight">
								<div class="img_cont">
									<img src="https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg" class="rounded-circle user_img">
								</div>
								<div class="user_info">
									<span>Trò chuyện</span>
								</div>
							</div>
						</div>
						<div class="card-body msg_card_body" id="messages">
                            {{-- chat content --}}
						</div>
						<div class="card-footer">
                            <form onsubmit="return sendMessage();" name="chat-form">
                                <div class="input-group">
                                    <input name="" class="form-control type_msg" id="messaage" placeholder="Nhập nội dung . . ."></input>
                                    {{-- <div class="input-group-append">
                                        <span class="input-group-text send_btn"><i class="fas fa-location-arrow"></i></span>
                                    </div> --}}
                                    <input type="submit">
                                </div>
                            </form>
						</div>
					</div>
				</div>
			</div>
        </div>
        <!-- The core Firebase JS SDK is always required and must be listed first -->
    <script src="https://www.gstatic.com/firebasejs/7.19.1/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.19.1/firebase-database.js"></script>

    <!-- TODO: Add SDKs for Firebase products that you want to use
        https://firebase.google.com/docs/web/setup#available-libraries -->
    <!-- <script src="https://www.gstatic.com/firebasejs/7.19.1/firebase-analytics.js"></script> -->

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
            html += "<div class='msg_cotainer' style='max-width: 200px;'>" + snapshot.val().message + "<span class='msg_time'>" + snapshot.val().sender + "</span></div>";
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
        firebase.database().ref("messages").on("child_removed", function (snapshot) {
            // remove message node
            document.getElementById("message-" + snapshot.key).innerHTML = "Tin nhắn này đã bị xóa";
        });
    </script>
	</body>
</html>
