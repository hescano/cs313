<?php
   session_start();
   unset($_SESSION["LoggedUser"]);
   $location = $_GET["previous"];
   header('Location: '.$location);
?>