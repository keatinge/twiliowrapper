<?php


  require("settings.php");


  if (isset($_GET['id']) && isset($_GET['auth']))
  {
    //validate user and auth are good
    $user = $_GET['id'];
    $auth = $_GET['auth'];
    $query = $pdo->prepare("SELECT * FROM `users` WHERE `username` = :user AND `token` = :token");
    $query->bindParam(":user", $user);
    $query->bindParam(":token", $auth);
    $query->execute();
    $rows =  $query->rowCount();

    if ($rows != 1)
    {
      exit("wrong id and auth");
    }

    //get last check time
    $query = $pdo->prepare("SELECT * FROM `users` WHERE `username` = :user");
    $query->bindParam(":user", $user);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);
    $lastViewTime = $result['lastView'];


    //if they set all then set the time = 0 so it shows them everything
    if (isset($_GET['all']))
    {
      $lastViewTime = 0;
    }

    //get all items after that time
    $query = $pdo->prepare("SELECT * FROM `messages` WHERE `user` = :checkUser AND `time` > :checkTime LIMIT 100");
    $query->bindParam(":checkUser", $user);
    $query->bindParam(":checkTime", $lastViewTime);
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);

    //print them as json
    if ($result)
    {
      echo json_encode($result);
    }


    //update the last checked time to current time
    $newTime = time();
    $query = $pdo->prepare("UPDATE `users` SET `lastView` = :currentTime WHERE `username` = :user");
    $query->bindParam(":currentTime", $newTime);
    $query->bindParam(":user", $user);
    $query->execute();





  }
  else
  {
    exit("Err: id and auth not set");

  }








 ?>
