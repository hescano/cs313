<?php
   function queryTable($query)
   {
      include("config.php");
      $mysqli = new mysqli($DBServer, $DBUser, $DBPass, $DBName);
      $result = $mysqli->query($query);
      return $result;
   }

   function insertTable($query)
   {
      include("config.php");
      $mysqli = new mysqli($DBServer, $DBUser, $DBPass, $DBName);
      $mysqli->query($query);

      return $mysqli->insert_id;
   }
   
   function execute($query)
   {
      include("config.php");
      $mysqli = new mysqli($DBServer, $DBUser, $DBPass, $DBName);
      $mysqli->query($query);
   }
?>