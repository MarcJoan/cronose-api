<?php require 'layouts/head.php';?>
<style type="text/css">
  .scroll {
    max-height: 400px;
    overflow-y: auto;
  }
  .chatBox {
    height: 400px;
  }
</style>
<h1>Chat</h1>




<div class="container mt-2">
  <div class="container border">
    <div class="row justify-content-center w-100 ">
      <div class="col-md-3 mt-4 scroll">
        <h4>Chats:</h4>
        <div id="chats">
          
        </div>
      </div>
      <div class="col-md-9 mb-4 mt-4">
        <div class="card w-100" id="myForm">
          <div class="card-header white p-2" id="toggle">
            <div class="d-flex">
              <div class="profile-photo">
                <img src="https://cdn.pixabay.com/photo/2012/04/26/19/43/profile-42914_960_720.png" alt="..." width="80" class="mr-3 rounded-circle img-thumbnail shadow-sm">
              </div>
              <div class="data">
                <p class="name mb-0"><strong id="name"></strong></p>
                <p class="activity text-muted mb-0"><!-- Active now --></p>
              </div>
            </div>
          </div>
          <div class="my-custom-scrollbar">
            <div class="card-body p-3">
              <div class="chat-message scroll chatBox" id="chat">
              </div>
            </div>
          </div>
          <div class="input-group">
            <span class="input-group-btn">
              <button id="send-btn" class="btn btn-secondary" type="button"><i class="far fa-paper-plane"></i></button>
            </span>
            <input id="message" type="text" class="form-control">
          </div>
        </div>
      </div>
    </div>
  </div>
<a href="/wallet">wallet</a><br>
<a href="/card">card</a>
</div>


<script>

  $(document).ready(function(){

    // See chats
    showChats();
    scrollDownChat();

    // Get reciver ID;

    if (window.location.pathname.split('/')[3]) getId();

    let reciverId;

    function getId() {
      const url = '/api/user/get/id/'+window.location.pathname.split('/')[3]+'/'+window.location.pathname.split('/')[4];
      $.ajax({
        type: 'get',
        url: url,
        dataType: 'json',
        success: (data) => {
          reciverId = data.user.id;
          show();
        }
      });
    }

    function showChats() {
      const url = '/api/chat';
      $.ajax({
        type: 'get',
        url: url,
        dataType: 'json',
        data: {},
        success: (data) => {
          if (data.status == 'success') {
            let msg = data.users;
            htmlLi = '<ul class="list-unstyled chat">';
            $.each (msg, function(key, value) {
              htmlLi += '<a href="/' + window.location.pathname.split('/')[1] + '/chat/' + value['initials']  + '/'+ value['tag'] + '" title=""><strong>' + value['name'] +'</small></a></br>';
            });
            htmlLi += "</ul>"
            document.getElementById("chats").innerHTML = htmlLi;
          };
        },
        error: ((data) => {
          console.log(data)
        })
      });
    };



    // Set title name

    if (window.location.pathname.split('/')[3]) $('#name').html(window.location.pathname.split('/')[3] + '<small>#'+window.location.pathname.split('/')[4] + '</small>');

    // Show chat 
    
    // setInterval(function () {
    //   show();
    //   showChats();
    // },1000);

    let lastMsg;

    function show() {
      const url = '/api/chat/<?= $user->id; ?>/'+reciverId;
      $.ajax({
        type: 'get',
        url: url,
        dataType: 'json',
        success: (data) => {
          if (data.status == 'success') {
            let msg = data.msg;
            let auxLastMsg;
            html = '<ul class="list-unstyled chat">';
            $.each (msg, function(key, value) {
              if (value.sender_id == reciverId) {
                html += '<div class="card bg-light rounded w-75 z-depth-0 mb-1"><div class="card-body p-2"><p class="card-text black-text"> ' + value['message'] + ' </p></div></div>';
              } else {
                html += '<div class="card bg-primary rounded w-75 float-right z-depth-0 mb-1"><div class="card-body p-2"><p class="card-text text-white">' + value['message'] + '</p></div></div>';
              }
              auxLastMsg = value.sended_date;
            });
            html += "</ul>"
            document.getElementById("chat").innerHTML = html;
            if (auxLastMsg != lastMsg) {
              lastMsg = auxLastMsg;
              scrollDownChat();
            }
          };
        }
      });
    };

    // Send MSG

    $("#message").keypress(function(event) {
      if (event.keyCode === 13) {
          $("#send-btn").click();
      }
    });

    $('#send-btn').click(() => {
      if (!$.trim($('#message').val()) == "") send();
    });

    function send() {
      const url = '/api/chat/send/<?= $user->id; ?>/' + reciverId;
      const reciver = window.location.pathname.split('/')[3];
      const msg = $('#message').val();
      $.ajax({
        type: 'POST',
        url: url,
        dataType: 'json',
        data: { reciver, msg },
        success: (data) => {
          $('#message').val('');
          show();
        },
        error: ((data) => {
        })
      });
    };

    function scrollDownChat() {
      setTimeout(function wait(){
        var objDiv = document.getElementById("chat");
        objDiv.scrollTop = objDiv.scrollHeight;
      }, 10);
    }

  });

</script>

<?php require '../views/layouts/footer.php';?>
