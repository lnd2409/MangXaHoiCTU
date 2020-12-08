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

// send function start

function send(){
	var chat = $("#btn-input").val();
    var dt = new Date();
    var time = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();

    if (chat =="") {
        console.log("rỗng");
    } else
    {
        firebase.database().ref("messages").push().set({
            "sender" : myName,
            "message" : chat,
        });
        var body = '<div class="row msg_container base_sent">' +
                        '<div class="col-md-10 col-xs-10 ">' +
                            '<div class="messages msg_sent">' +
                                '<p>'+ chat + '</p>'+
                            ' ime datetime="2009-11-13T20:00">Administrator • Today '+time+'</time>'+
                            '</div>' +
                        '</div>' +
                        '<div class="col-md-2 col-xs-2 avatar">' +
                            '<img class="chatimg" src="https://cheme.mit.edu/wp-content/uploads/2017/01/stephanopoulosgeorge-431x400.jpg" class=" img-responsive ">' +
                        '</div>' +
                    '</div>';
    }
    $(body).appendTo("#messagebody");
    $('#btn-input').val('');
    $("#messagebody").animate({ scrollTop: $("#messagebody")[0].scrollHeight}, 'slow');
}

    //listen for incoming message
    firebase.database().ref("messages").on("child_added", function (snapshot) {
        var html = "";
        // give each message a unique ID
        //open tag
        if(snapshot.val().sender == myName){
            html += "<div id='message-" + snapshot.key + "' class='d-flex justify-content-end mb-4'>"
            html += '<div class="row msg_container base_sent">' +
                        '<div class="col-md-10 col-xs-10 ">' +
                            '<div class="messages msg_sent">' +
                                '<p>'+ snapshot.val().message + '</p>'+
                            ' ime datetime="2009-11-13T20:00">Administrator • Today '+time+'</time>'+
                            '</div>' +
                        '</div>' +
                        '<div class="col-md-2 col-xs-2 avatar">' +
                            '<img class="chatimg" src="https://cheme.mit.edu/wp-content/uploads/2017/01/stephanopoulosgeorge-431x400.jpg" class=" img-responsive ">' +
                        '</div>' +
                    '</div>';
        }
        html += '<div class="row msg_container base_receive">' +
                    '<div class="col-md-10 col-xs-10 ">' +
                        '<div class="messages msg_sent">' +
                            '<p>'+ snapshot.val().message + '</p>'+
                        ' ime datetime="2009-11-13T20:00">Administrator • Today '+time+'</time>'+
                        '</div>' +
                    '</div>' +
                    '<div class="col-md-2 col-xs-2 avatar">' +
                        '<img class="chatimg" src="https://cheme.mit.edu/wp-content/uploads/2017/01/stephanopoulosgeorge-431x400.jpg" class=" img-responsive ">' +
                    '</div>' +
                '</div>';
        document.getElementById("messagebody").innerHTML += html;
    });


// send function end




$( "#btn-chat" ).click(function() {
send()
});

$('#btn-input').keypress(function (e) {
  if (e.which == 13) {
    send()
  }
});




