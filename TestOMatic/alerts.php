<?php
   class Alert
   {
      var $message;
      var $type;
      
      public function Alert($pmessage = "Error", $ptype = "danger")
      {
         //types: success, info, warning, danger
         $this->message = $pmessage;
         $this->type = $ptype;
      }

      public static function setAlert($message, $type)
      {
         $alert = new Alert($message, $type);
         $_SESSION["alert"] = $alert;
      }
   }

   function showAlert()
   {
      $alert = $_SESSION["alert"];
      $type = $alert->type;

      echo "<div class='alert alert-$type alert-dismissable'>";
      echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
      echo $alert->message;
      echo "</div>";

      unset($_SESSION["alert"]);
   }
?>