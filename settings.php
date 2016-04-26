<?php

  //edit the four lines below to use your own database

  //note that you need two tables
  //------------------------------
  //table `messages` should have 8 columns:
  //id, user, time, messageSid, accountSid, from, to, body

  //table `users` should have 4 columns
  //id, username, token, lastView


  $pdoHost = "localhost";
  $pdoUsername = "";
  $pdoPassword = "";
  $pdoDatabase = "";

  //don't edit this line
  $pdo = new PDO("mysql:host=$pdoHost;dbname=$pdoDatabase", $pdoUsername, $pdoPassword);

  //edit baseUrl to use the url that you will be hosting your website on
  //$baseUrl should look like http://twiliowrap.x10.bz/,
  //be sure to include http: and an ending slash
  $baseUrl = "http://twiliowrap.x10.bz/";
 ?>
