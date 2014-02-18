<?php
  session_start();
  require_once("alerts.php");
  require_once("User.php");

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
        $usr = User::getUserByUsername($username);
          
        if (isset($usr))
        {
          $encriptedPassword = md5($password);
          //compare hashes
          if ($encriptedPassword == $usr->Password)
          {
             //we have a authenticated user here
             $_SESSION["LoggedUser"] = $usr;
            Alert::setAlert("<strong>Welcome!</strong> $usr->UserName.", "success");

          }
          else
          {
            Alert::setAlert("Invalid Username or Password.", "danger");
          }
        }
        else
        {
          Alert::setAlert("Invalid Username or Password.", "danger");
        }
      }
      else
      {
        Alert::setAlert("Invalid Username or Password.", "danger");
      }

      $location = $_GET["previous"];
      header('Location: '.$location);
   }
?>