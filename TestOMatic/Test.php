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

      public static function getByTestID($testID)
      {
         $result = queryTable("SELECT * FROM Tests WHERE TestID=$testID");
         if ($result->num_rows > 0)
         {
            $row = $result->fetch_assoc();
            return new Test($row["TestID"], $row["TestName"], $row["UserID"], $row["IsPublic"], $row["LastUpdated"], $row["Status"]);
         }
      }

      public static function getByUserID($userID)
      {
         $result = queryTable("SELECT * FROM Tests WHERE UserID=$userID AND Status=1");

         if ($result->num_rows > 0)
         {
            $tests = array();

            while ($row = $result->fetch_assoc())
            {
               array_push($tests, new Test($row["TestID"], $row["TestName"], $row["UserID"], $row["IsPublic"], $row["LastUpdated"], $row["Status"]));
            }
            return $tests;
         }
      }

      public static function Insert($pTestName = "", $pUserID = 0, $pIsPublic = false, $pStatus = false)
      {
         date_default_timezone_set('GMT');
         $date = date('Y-m-d H:i:s');
         $query = "INSERT INTO Tests (TestName, UserID, IsPublic, LastUpdated, Status) VALUES('$pTestName', $pUserID, $pIsPublic, '$date', $pStatus)";
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