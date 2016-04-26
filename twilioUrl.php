<?php


  require("settings.php");


  //got an id and auth
  if (isset($_GET['id']) && isset($_GET['auth']))
  {

    $user = $_GET['id'];
    $auth = $_GET['auth'];

    //validate user and auth are good
    $query = $pdo->prepare("SELECT * FROM `users` WHERE `username` = :user AND `token` = :token");
    $query->bindParam(":user", $user);
    $query->bindParam(":token", $auth);
    $query->execute();
    $rows =  $query->rowCount();

    if ($rows != 1)
    {
      exit("Err: wrong id and auth");
    }

    $messageSid = $_POST['MessageSid'];
    $accountSid = $_POST['AccountSid'];
    $from = $_POST['From'];
    $to = $_POST['To'];
    $body = $_POST['Body'];




    //add the message to the database
    $time = time();
    $query = $pdo->prepare("INSERT INTO `messages` (`user`, `time`, `messageSid`, `accountSid`, `from`, `to`, `body`) VALUES (:usr, :currTime, :msg, :acc, :fr, :to, :body)");
    $query->bindParam("usr", $user);
    $query->bindParam("currTime", $time);
    $query->bindParam(":msg", $messageSid);
    $query->bindParam(":acc", $accountSid);
    $query->bindParam(":fr", $from);
    $query->bindParam(":to", $to);
    $query->bindParam(":body", $body);
    $query->execute();





  }
  else
  {
    exit("Err: Missing id or auth");
  }






 ?>
