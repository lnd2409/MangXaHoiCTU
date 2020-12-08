<!DOCTYPE html>
<html lang="en">

@include('client.template.head')
{{-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> --}}
<link rel="stylesheet" href="{{ asset('chat-template') }}/style.css">
{{-- <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script> --}}
<style>

</style>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

<!------ Include the above in your HEAD tag ---------->

<body data-spy="scroll">
    <div id="app">

        @include('client.template.navbar')
        <!-- Page Content -->
        <section class="container blog">
            @include('client.template.error')
            @yield('breadcrumb')
            @yield('content')
        </section>
        {{-- @include('client.template.footer') --}}
    </div>

    {{-- ~~((^-^))~~ --}}
    {{-- {{ dd(Request::segment(1)) }} --}}
    @if (Request::segment(1) == 'quan-tri')
    @else
        <?php
            $youth_branch = DB::table('youth_branchs')
                        ->join('majors','majors.major_id','youth_branchs.major_id')
                        ->join('courses','courses.course_id','youth_branchs.course_id')
                        ->where('yb_id',Auth::guard('student')->user()->yb_id)->first();
        ?>
    @endif
    @if (Request::segment(1) != 'quan-tri')
        @if(Auth::guard('student')->check())
        <div id="live-chat">

            <header class="clearfix">

                <a href="#" class="chat-close">x</a>
                <h4>{{ $youth_branch->major_name }} {{ $youth_branch->course_name }}</h4>
            </header>

            <div class="chat" id="chat2">

                <div class="chat-history" id="messages">


                    <div id="scrollBottom"></div>
                </div> <!-- end chat-history -->
            </div> <!-- end chat -->
            <div class="send-message">
                <form onsubmit="return sendMessage();" name="chat-form">
                    <div class="form-group">
                        <input type="text" class="form-control type_msg" id="messaage"
                            placeholder="Nhập nội dung . . ."></input>
                        <input type="submit" hidden>
                    </div>
                </form>
            </div>

        </div> <!-- end live-chat -->
        @endif
    @endif
    @include('client.template.script')
    {{-- <script>
        $(document).ready(function () {
            $('#user-click').click(function (e) {
                $('#app').css("opacity", 0.5);
            });
            $('#close-modal').click(function (e) {
                e.preventDefault();
                $('#app').css("opacity", 1);
            });
        });
    </script> --}}

    <script>
        (function() {
            $('#live-chat header').on('click', function() {
                $('.chat').slideToggle(300, 'swing');
                $('.chat-message-counter').fadeToggle(300, 'swing');

                $('.send-message').fadeToggle(300,'swing');
            });

            $('.chat-close').on('click', function(e) {
                e.preventDefault();
                $('#live-chat').fadeOut(300);
                $('.send-message').fadeOut(300);
            });

        }) ();
    </script>

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
        @if(Auth::guard('student')->check())
            var myName = "{{  Auth::guard('student')->user()->stu_code  }}";
            var branch =  "{{ Auth::guard('student')->user()->yb_id }}";
        @endif

        // console.log(branch);
        function sendMessage() {

            //get message
            var message = document.getElementById("messaage").value;
            //save in database
            firebase.database().ref("messages").push().set({
                "sender" : myName,
                "message" : message,
                "branch" : branch
            });
            console.log(message);

            var frm = document.getElementsByName('chat-form')[0];
            frm.reset();  // Reset all form data
            return false;
        }

        // listen for incoming message
        firebase.database().ref("messages").on("child_added", function (snapshot) {
            var html = "";
            if(snapshot.val().branch == branch){
                if(snapshot.val().sender == myName){
                    html += '<div class="chat-message clearfix">' +
                                '<img src="{{ asset("client/images/img/avatar.jpg") }}" alt="" width="32" height="32">' +
                                '<div class="chat-message-content clearfix">' +
                                    '<span class="chat-time"><b>13:35</b></span>' +
                                        '<b>' + 'Tôi' + '</b>' +
                                    '<p class="title-message">' + snapshot.val().message + '</p>' +
                                '</div>' +
                            '</div>'
                    document.getElementById("messages").innerHTML += html;
                    // console.log(html);
                }else{
                    html += '<div class="chat-message clearfix">' +
                                '<img src="{{ asset("client/images/img/avatar.jpg") }}" alt="" width="32" height="32">' +
                                '<div class="chat-message-content clearfix">' +
                                    '<span class="chat-time"><b>13:35</b></span>' +
                                        '<b>' + snapshot.val().sender + '</b>' +
                                    '<p class="title-message-rep">' + snapshot.val().message + '</p>' +
                                '</div>' +
                            '</div>'
                    document.getElementById("messages").innerHTML += html;
                }
            }
        });

    </script>
    <script>
        //đóng mở box
        $(document).on('click', '.panel-heading span.icon_minim', function (e) {
        var $this = $(this);
            if (!$this.hasClass('panel-collapsed')) {
                $this.parents('.panel').find('.panel-body').slideUp();
                $this.addClass('panel-collapsed');
                $this.removeClass('glyphicon-minus').addClass('glyphicon-plus');
            } else {
                $this.parents('.panel').find('.panel-body').slideDown();
                $this.removeClass('panel-collapsed');
                $this.removeClass('glyphicon-plus').addClass('glyphicon-minus');
            }
        });
        $(document).on('focus', '.panel-footer input.chat_input', function (e) {
            var $this = $(this);
            if ($('#minim_chat_window').hasClass('panel-collapsed')) {
                $this.parents('.panel').find('.panel-body').slideDown();
                $('#minim_chat_window').removeClass('panel-collapsed');
                $('#minim_chat_window').removeClass('glyphicon-plus').addClass('glyphicon-minus');
            }
        });
        $(document).on('click', '#new_chat', function (e) {
            var size = $( ".chat-window:last-child" ).css("margin-left");
            size_total = parseInt(size) + 400;
            alert(size_total);
            var clone = $( "#chat_window_1" ).clone().appendTo( ".container" );
            clone.css("margin-left", size_total);
        });
        $(document).on('click', '.icon_close', function (e) {
            //$(this).parent().parent().parent().parent().remove();
            $( "#chatbox" ).hide();
        });
    </script>


</body>

</html>
