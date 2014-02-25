<?php
   include_once("dataaccess.php");

   class Answer
   {
      var $AnswerID;
      var $QuestionID;
      var $AnswerValue;
      var $IsAnswer;
      var $ActualAnswer;
      var $Status;

      public function Answer($pAnswerID = 0, $pQuestionID = 0, $pAnswerValue = "", $pIsAnswer = 0, $pActualAnswer = "", $pStatus = 0)
      {
         $this->AnswerID = $pAnswerID;
         $this->QuestionID = $pQuestionID;
         $this->AnswerValue = $pAnswerValue;
         $this->IsAnswer = $pIsAnswer;
         $this->ActualAnswer = $pActualAnswer;
         $this->Status = $pStatus;
      }

      public static function getAnswersByQuestionId($questionID)
      {
         $result = queryTable("SELECT * FROM Answers a JOIN Questions q ON a.QuestionID = q.QuestionID WHERE a.Status=1 AND a.QuestionID=$questionID");

         if ($result->num_rows > 0)
         {
            $answers = array();

            while ($row = $result->fetch_assoc())
            {
               array_push($answers, new Answer($row["AnswerID"], $row["QuestionID"], $row["AnswerValue"], $row["IsAnswer"], $row["ActualAnswer"], $row["Status"]));
            }
            return $answers;
         }
      }
      
      public static function Insert($pQuestionID = 0, $pAnswerValue = "", $pIsAnswer = 0, $pActualAnswer = "", $pStatus = 0)
      {
         $query = "INSERT INTO Answers (QuestionID, AnswerValue, IsAnswer, ActualAnswer, Status) VALUES($pQuestionID, '$pAnswerValue', $pIsAnswer, '$pActualAnswer', $pStatus)";
         
         $tmpAnswerID = insertTable($query);

         $result = queryTable("SELECT * FROM Answers WHERE AnswerID=$tmpAnswerID");

         if ($result->num_rows > 0)
         {
            $row = $result->fetch_assoc();
            return new Answer($row["AnswerID"], $row["QuestionID"], $row["AnswerValue"], $row["IsAnswer"], $row["ActualAnswer"], $row["Status"]);
         }


      }
      
      public static function deleteAllByQuestionID($questionID)
      {
         $result = execute("DELETE FROM Answers WHERE QuestionID=$questionID");
      }
   }
?>