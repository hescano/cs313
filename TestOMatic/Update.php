<?php
   include_once("dataaccess.php");

   class Update
   {
      var $UpdateID;
      var $TestID;
      var $UpdateHtmlText;

      public function Update($pUpdateID = 0, $pTestID = 0, $pUpdateHtmlText = "")
      {
         $this->UpdateID = $pUpdateID;
         $this->TestID = $pTestID;
         $this->UpdateHtmlText = $pUpdateHtmlText;
      }

      public static function getAllUpdates()
      {
         $result = queryTable("SELECT * FROM Updates up JOIN Tests t ON up.TestID = t.TestID JOIN Users u ON t.UserID = t.UserID WHERE t.IsPublic = 1");

         if ($result->num_rows > 0)
         {
            $updates = array();

            while ($row = $result->fetch_assoc())
            {
               array_push($updates, new Update($row["UpdateID"], $row["TestID"], "<li>The user <a href='Users.php?userid=".$row["UserID"]."'>".$row["UserName"]."</a> has created a new public test named <strong><a href='Tests.php?testid=".$row["TestID"]."'>".$row["TestName"]."</a></strong></li>"));
            }
            return $updates;
         }
      }
   }
?>