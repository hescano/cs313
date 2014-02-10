<?php
   include_once("dataaccess.php");

   class User
   {
      var $UserID;
      var $UserName;
      var $Email;
      var $Password;
      var $FullName;
      var $LastUpdated;
      var $RoleID;
      var $Status;

      public function User($pUserID = 0, $pUserName = "", $pEmail = "", $pPassword = "", $pFullName = "", $pLastUpdated = "", $pRoleID = "", $pStatus = false)
      {
         $this->UserID = $pUserID;
         $this->UserName = $pUserName;
         $this->Email = $pEmail;
         $this->Password = $pPassword;
         $this->FullName = $pFullName;
         $this->LastUpdated = $pLastUpdated;
         $this->RoleID = $pRoleID;
         $this->Status = $pStatus;
      }

      public static function getUserById($userId)
      {
         $result = queryTable("SELECT * FROM Users WHERE UserID=$userId");

         if ($result->num_rows > 0)
         {
            $row = $result->fetch_assoc();
            return new User($row["UserID"], $row["UserName"], $row["Email"], $row["Password"], $row["FullName"], $row["LastUpdated"], $row["RoleID"], $row["Status"]);
         }
      }
   }
?>