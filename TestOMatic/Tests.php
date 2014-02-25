<?php 
  include_once("header.php");
  include_once("Question.php");
  include_once("Answer.php");
?>
  <div class="row">
    <div class="col-xs-12">
      <?php
        if (isset($_GET["testid"]))
        {
          $questions = Question::getQuestionsByTestID($_GET["testid"]);
          if (count($questions) > 0)
          {
            echo '<div class="panel panel-info">';
            echo '<div class="panel-heading">';
            echo "<h3 class='panel-title'><strong>Test Name: ";
            echo $questions[0]->TestName;
            echo "</strong></h3>";
            echo '</div>';
            echo '<div class="panel-body">';
            echo "<form>";
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
                      echo "<ol type='a'>";
                      foreach ($answers as $answer)
                      {
                        echo "<li><input name='".$question->QuestionID."' type='radio' /><label>". $answer->AnswerValue ."</label></li>";
                      }
                      echo "</ol>";
                      break;
                    case 2: //choose all that apply (checkboxes)
                      echo "<ol type='a'>";
                      foreach ($answers as $answer)
                      {
                        echo "<li><input name='".$question->QuestionID."' type='checkbox' /><label>". $answer->AnswerValue ."</label></li>";
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
            echo "</form>";
            echo '</div>';
            echo  '<div class="panel-footer"><button type="button" class="btn btn-default" onclick="alert(\'Coming  Soon...\'); return false;">Submit Test</button></div>';
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