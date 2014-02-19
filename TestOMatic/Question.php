<?php
   include_once("dataaccess.php");

   class Question
   {
      var $QuestionID;
      var $QuestionText;
      var $TestID;
      var $AnswerTypeID;
      var $AnswerTypeName;
      var $TestName;
      var $Status;

      public function Question($pQuestionID = 0, $pQuestionText = "", $pTestID = 0, $pAnswerTypeID = 0, $pTestName = "", $pAnswerTypeName = "", $pStatus = 0)
      {
         $this->QuestionID = $pQuestionID;
         $this->QuestionText = $pQuestionText;
         $this->TestID = $pTestID;
         $this->AnswerTypeID = $pAnswerTypeID;
         $this->TestName = $pTestName;
         $this->Status = $pStatus;
         $this->AnswerTypeName = $pAnswerTypeName;
      }

      public static function getQuestionsByTestID($testID)
      {
         $result = queryTable("SELECT * FROM Questions q JOIN Tests t ON q.TestID = t.TestID JOIN AnswerTypes at ON q.AnswerTypeID = at.AnswerTypeID WHERE q.TestID=$testID AND q.Status=1");

         if ($result->num_rows > 0)
         {
            $questions = array();

            while ($row = $result->fetch_assoc())
            {
               array_push($questions, new Question($row["QuestionID"], $row["QuestionText"], $row["TestID"], $row["AnswerTypeID"], $row["TestName"], $row["AnswerTypeName"], $row["Status"]));
            }
            return $questions;
         }
      }

      public static function Insert($pQuestionText = "", $pTestID = 0, $pAnswerTypeID = 0, $pStatus = false)
      {
         $query = "INSERT INTO Questions (QuestionText, TestID, AnswerTypeID, Status) VALUES('$pQuestionText', $pTestID, $pAnswerTypeID, $pStatus)";
         $tmpQuestionId = insertTable($query);

         $result = queryTable("SELECT * FROM Questions q JOIN Tests t ON q.TestID = t.TestID WHERE q.QuestionID=$tmpQuestionId");

         if ($result->num_rows > 0)
         {
            $row = $result->fetch_assoc();
            return new Question($row["QuestionID"], $row["QuestionText"], $row["TestID"], $row["AnswerTypeID"], $row["TestName"], $row["Status"]);
         }
      }
   }
?>