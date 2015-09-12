@extends('frontend.layouts.default')
@include ('frontend.includes.format')
@section('content')
    @section('title')
        Chat
    @endsection

<script src="https://cdn.firebase.com/js/client/2.2.1/firebase.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<div class="all">
   <div id="content">
      <div class="container">
      <div class="col-md-12">
        <ul class="breadcrumb">
            <li><a href="#">Home</a>
            </li>

            <li class="active">chat</li>
        </ul>

    </div>

        <div class="col-sm-12">
          
            <div class="box">
            <h1>chat room realtime demo</h1>
              <div class="nameInput">
                <?php

                  if(isset(Auth::user()->email)){
                    $name   = Auth::user()->name;
                    $email  = Auth::user()->email; 
                  }else{
                    $name   = "Guest";
                    $email  = "";
                  }

                ?>
                <h1></h1>
                <div class="row">
                  <div class="col-sm-10">
                    <input type="text" id="nameInput" class="form-control" value="<?php echo $name ?>">
                  </div>
                  
                  <div class="col-sm-2"> 
                    <button class="btn btn-default">Nhập tên</button>
                  </div>
                </div>
              </div>
              <br>
              <div class="box">
                <div id="messagesDiv" rows="4" class="form-control" style="height:300px;overflow: scroll;"></div>
              </div>
              <div>
                <div class="col-sm-10">
                  <input id="messageInput" class="form-control">
                </div>
                <div class="col-sm-2">
                  <button type="button" class="btn btn-primary" id="guidi">Gửi tin nhắn</button>
                </div>
                <br>
                <br>
              

              
            </div>
          </div>
          <div class="col-sm-2">
            
          </div>
        </div>
      </div>
    </div>
</div>
<script>
      var myDataRef = new Firebase('https://oreju.firebaseio.com/');
      $('#messageInput').keypress(function (e) {
        if (e.keyCode == 13) {
          var name = $('#nameInput').val();
          var text = $('#messageInput').val();
          myDataRef.push({name: name, text: text});
          $('#messageInput').val('');
        }
      });

      myDataRef.on('child_added', function(snapshot) {
        var message = snapshot.val();
        displayChatMessage(message.name, message.text);
      });

      function displayChatMessage(name, text) {
        $('<div/>').text(text).prepend($('<em/>').text(name+': ')).appendTo($('#messagesDiv'));
        $('#messagesDiv')[0].scrollTop = $('#messagesDiv')[0].scrollHeight;
      };

    </script>
            
@stop