<?php
  //so we can use baseurl later
  require("settings.php");
?>


<html>
  <head>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"></script>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  </head>

  <body>
    <div class="container">
      <div class="well" style="margin-top:10px">
        <h1>Welcome to the Twilio Wrapper</h1>
        <p>Using a php proxy to get twilio response texts from within your application <strong>WITHOUT</strong> portforwarding</p>
      </div>

      <div class="well">
        <h2>Create an account</h2>
        <hr/>
        <input id="user" type="text" style="width:100%;" placeholder="Username"><br>
        <button id="submit" class="btn btn-success" style="width:100%;margin-top:20px;">Create Account!</button>

      </div>

      <div class="well" id="help">
        <h1>Usage:</h1>
        <hr>
        <h4> Request this webpage  from within your app to get all your unread text messages in json:<br>
        <small>You can also add &all=true at the end of your url to show you ALL messages, not only unread</small>
        <br><br>
        <pre><strong><span id="userUrl"></span></strong></h4></pre>

        <h4 style="margin-top:70px;"> And tell Twilio to <strong>POST</strong> text messages to this url:<br><br>
        <pre><strong><span id="twilUrl"></span></strong></h4></pre>


      </div>
    </div>
  </body>


  <script>
    $("#token").hide();
    $("#help").hide();

    $("#submit").click( function (){

      //empty username
      if ($("#user").val() == "")
      {
        alert("invalid username!");
        return null;
      }
      $("#token").show();
      $("#customUrl").show();

      $("#submit").attr("disabled", true);

      var username = $("#user").val();
      var xhttp = new XMLHttpRequest();

      xhttp.open("GET", "<?php echo $baseUrl ?>" + "/createAcc.php?username=" + username , false);
      xhttp.send();
      var response = xhttp.responseText;


      var split = response.split("<br>");

      //if the response string contains Err sd
      if (response.indexOf("Err") !== -1)
      {
        alert("Something went wrong! " + response);
        $("#submit").attr("disabled", false);
      }
      else {

        $("#help").fadeIn(800);
        //no error
        var twilUrl = split[0];
        var userUrl = split[1];


        $("#userUrl").html(userUrl);
        $("#twilUrl").html(twilUrl);

      }




    });



  </script>


</html>
