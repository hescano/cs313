<?php 

   class Test
   {
      var $TestID;
      var $TestName;
      var $UserID;
      var $IsPublic;
      var $LastUpdated;
      var $Status;
      
      public function Test($pTestID = 0, $pTestName = "", $pUserID = 0, $pIsPublic = false, $pLastUpdated = 0, $pStatus = false)
      {
         //types: success, info, warning, danger
         $this->TestID = $pTestID;
         $this->TestName = $pTestName;
         $this->UserID = $pUserID;
         $this->IsPublic = $pIsPublic;
         $this->LastUpdated = $pLastUpdated;
         $this->Status = $pStatus;
      }

      public static function Insert($pTestName = "", $pUserID = 0, $pIsPublic = false, $pStatus = false)
      {
         $query = "INSERT INTO Tests (TestName, UserID, IsPublic, Status) VALUES('$pTestName', $pUserID, $pIsPublic, $pStatus)";
         $tmpTestId = insertTable($query);

         $result = queryTable("SELECT * FROM Tests WHERE TestID=$tmpTestId");

         if ($result->num_rows > 0)
         {
            $row = $result->fetch_assoc();
            return new Test($row["TestID"], $row["TestName"], $row["UserID"], $row["IsPublic"], $row["LastUpdated"], $row["Status"]);
         }


      }
   }
?>