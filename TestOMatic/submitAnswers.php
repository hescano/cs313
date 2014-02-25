<?php
   require_once("Answer.php");
   
   //if its a post, no need to do much, insert and leave
   if($_SERVER['REQUEST_METHOD'] == 'POST')
   {
      $answers = array();
      
      $isAnswer = array();
      
      foreach(array_keys($_POST) as $field) 
      {
         $value = $_POST[$field];
         if (strpos($field, "_isanswer") > - 1)
         {
            array_push($isAnswer, $value);
         }
      }
      
      foreach(array_keys($_POST) as $field) 
      {
         $value = $_POST[$field];
   
         if (strpos($field, "_answer_") > - 1)
         {
            $id = explode("_", $field);
            $answerText = $value;
            Answer::deleteAllByQuestionID($id[1]);
            
            $itsAnswer = 0;
            if (count($isAnswer) > 0)
            {
               foreach ($isAnswer as $posAnswer)
               {
                  if ($posAnswer == $field)
                  {
                     $itsAnswer = 1;
                  }
               }
            }
            array_push($answers, new Answer(0, $id[1], $answerText, $itsAnswer, $answerText, 1));
         }
      }
      
      $inserted = 0;
      if (count($answers) > 0)
      {
         foreach ($answers as $answer)
         {
            $ans = Answer::Insert($answer->QuestionID, $answer->AnswerValue, $answer->IsAnswer, $answer->ActualAnswer, $answer->Status);
            
            if (isset($ans))
            {
               $inserted++;
            }
         }
         
         if ($inserted == count($answers))
         {
            echo "success";
         }
      }
   }
   else
   {
      echo "Error";
   }

?>