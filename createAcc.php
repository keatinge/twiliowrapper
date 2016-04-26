<?php

  require("settings.php");

  if (isset($_GET['username']))
  {

    //generate user information
    $user = $_GET['username'];
    $user = substr($user, 0, 100);
    $authToken = random_string(50);

    //url twilio requests
    $twilUrl = $baseUrl . "twilioUrl.php?id=" . $user . "&auth=" . $authToken;

    //url user requests to get messages
    $userUrl = $baseUrl . "getMessages.php?id=" . $user . "&auth=" . $authToken;


    //check if username is in database
    $query = $pdo->prepare("SELECT * FROM `users` WHERE `username` = :user");
    $query->bindParam(":user", $user);
    $query->execute();
    $respRows = $query->rowCount();


    if ($respRows > 0)
    {
      exit("Err: That username already exists");
    }

    //put in database
    $query = $pdo->prepare("INSERT INTO users(username, token) VALUES (:username, :token)");
    $query->bindParam(":username", $user);
    $query->bindParam(":token", $authToken);
    $query->execute();

    //everything went ok
    echo $twilUrl;
    echo "<br>";
    echo $userUrl;



  }
  else {
    echo "Err: Missing username";
  }


  function random_string($length)
  {
    $characters = "ajksdhajksdhioqwetryueiwbnmczxvmbcnx817293673541203919823719kjasdh";
    $returnString = "";



    for ($i = 0; $i < $length; $i++)
    {

      $randNum = rand(0, strlen($characters));
      $returnString = $returnString . substr($characters, $randNum, 1);
    }

    return $returnString;

  }




 ?>
