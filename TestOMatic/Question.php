<?php
   include_once("dataaccess.php");

   class Question
   {
      var $QuestionID;
      var $QuestionText;
      var $TestID;
      var $AnswerTypeID;
      var $TestName;
      var $Status;

      public function Question($pQuestionID = 0, $pQuestionText = "", $pTestID = 0, $pAnswerTypeID = 0, $pTestName = "", $pStatus = 0)
      {
         $this->QuestionID = $pQuestionID;
         $this->QuestionText = $pQuestionText;
         $this->TestID = $pTestID;
         $this->AnswerTypeID = $pAnswerTypeID;
         $this->TestName = $pTestName;
         $this->Status = $pStatus;
      }

      public static function getQuestionsByTestID($testID)
      {
         $result = queryTable("SELECT * FROM Questions q JOIN Tests t ON q.TestID = t.TestID WHERE q.TestID=$testID AND q.Status=1");

         if ($result->num_rows > 0)
         {
            $questions = array();

            while ($row = $result->fetch_assoc())
            {
               array_push($questions, new Question($row["QuestionID"], $row["QuestionText"], $row["TestID"], $row["AnswerTypeID"], $row["TestName"], $row["Status"]));
            }
            return $questions;
         }
      }
   }
?>