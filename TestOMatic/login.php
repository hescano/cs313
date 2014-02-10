<?php
   if($_SERVER['REQUEST_METHOD'] == 'POST')
   {
      if (isset($_POST["username"]))
      {
         $username = $_POST["username"];
      }

      if (isset($_POST["password"]))
      {
         $password = $_POST["password"];
      }

      if (isset($username) && isset($password) && $username != "" && $password!= "")
      {
         
      }
      else
      {
         $location = $_GET["previous"];
         echo $location;
         header('Location: '.$location);  
      }

   }
?>