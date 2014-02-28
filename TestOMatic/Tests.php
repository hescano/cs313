<?php 
  include_once("header.php");
  include_once("Question.php");
  include_once("Answer.php");
?>
  <div class="row">
    <div class="col-xs-12">
      <?php
         $testId = (isset($_GET["testid"]) ? $_GET["testid"] : $_POST["hiddenId"]);
         
        if (isset($testId))
        {   
            if($_SERVER['REQUEST_METHOD'] == 'POST')
            {
               $submitted = true;
               
               //$rightAnswers = Answer::getAnswersByTestId($testId);
               //no need to load 'right answers', as they are already part
               //of the actual answers.
            } 
             $questions = Question::getQuestionsByTestID($testId);
             if (count($questions) > 0)
             {
               echo '<div class="panel panel-info">';
               echo '<div class="panel-heading">';
               echo "<h3 class='panel-title'><strong>Test Name: ";
               echo $questions[0]->TestName;
               echo "</strong></h3>";
               echo '</div>';
               echo "<form action='Tests.php?testid=$testId' method='post'>";
               echo "<input type='hidden' value='".$testId."' name='hiddenId' />";
               echo '<div class="panel-body">';
               echo "<ol>";
               foreach ($questions as $question)
               {
                 echo "<li class='content-fluid well' style='padding: 5px; margin-bottom: 10px; margin-top: 15px; font-weight: bold;'>".$question->QuestionText."</li>";

                 $answers = Answer::getAnswersByQuestionId($question->QuestionID);

                 if (count($answers) > 0)
                 {
                     switch ($question->AnswerTypeID)
                     {
                       case 1: //choose one (radio buttons)
                         echo "<ol type='a' data-questionid='$question->QuestionID'>";
                         foreach ($answers as $answer)
                         {
                           if (isset($submitted))
                           {
                              if ($submitted && $answer->IsAnswer)
                              {
                                 $result = "<img src='img/right.png'  style='width:20px; height: 20px; display: inline' />&nbsp;&nbsp;$answer->AnswerValue";
                              }
                              else
                              {
                                 $result = $answer->AnswerValue;
                              }
                           }
                           else
                           {
                              $result = "<div class='radio'><input name='".$question->QuestionID."' data-answerid='$answer->AnswerID' id='$answer->AnswerID' type='radio' /><label for='$answer->AnswerID'>". $answer->AnswerValue ."</label></div>";
                           }
                              
                           echo "<li>$result</li>";
                         }
                         echo "</ol>";
                         break;
                       case 2: //choose all that apply (checkboxes)
                         echo "<ol type='a'>";
                         foreach ($answers as $answer)
                         {
                           if (isset($submitted))
                           {
                              if ($submitted && $answer->IsAnswer)
                              {
                                 $result = "<img src='img/right.png'  style='width:20px; height: 20px; display: inline' />&nbsp;&nbsp;$answer->AnswerValue";
                              }
                              else
                              {
                                 $result = $answer->AnswerValue;
                              }
                           }
                           else
                           {
                              $result = "<div class='checkbox'><input name='".$question->QuestionID."' data-answerid='$answer->AnswerID' id='$answer->AnswerID' type='checkbox' /><label for='$answer->AnswerID'>". $answer->AnswerValue ."</label></div>";
                           }
                              
                           echo "<li>$result</li>";
                         }
                         echo "</ol>";
                         break;
                       case 3: //write on (textbox)
                         foreach ($answers as $answer)
                         {
                           echo "<label>Answer: </label> <input type='textbox' />";
                         }
                         break;
                     }
                   }
                 }
               }
               else
               {
                  Alert::setAlert("<strong style='font-size: 40px;'>404 Test Not Found!", "warning");
                  redirect("index.php");
               }
               echo "</ol>";
               echo '</div>';
               // echo  '<div class="panel-footer"><button type="submit" class="btn btn-default">Submit Test</button></div>';
               echo  '<div class="panel-footer"><button type="submit" class="btn btn-default">Submit Test</button></div>';
               echo "</form>";
               echo '</div>';
           }
           else
           {
             Alert::setAlert("<strong style='font-size: 40px;'>!404 Test Not Found.", "warning");
             redirect("index.php");
           }
      ?>
    </div>
  </div>

  <!-- End Header-->
</div>
<?php 
  include_once("footer.php");
?>