<?php
   function queryTable($query)
   {
      include("config.php");
      $mysqli = new mysqli($DBServer, $DBUser, $DBPass, $DBName);
      $result = $mysqli->query($query);
      return $result;
   }
?>