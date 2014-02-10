<?php 
  include_once("header.php");
  include_once("Question.php");
  include_once("Answer.php");
?>
    <!--<div class="jumbotron">
      <h1>Welcome</h1>
      <p>This example is a quick exercise to illustrate how the default, static navbar and fixed to top navbar work. It includes the responsive CSS and HTML, so it also adapts to your viewport and device.</p>
      <p>
      <a class="btn btn-lg btn-primary" href="../../components/#navbar" role="button">View navbar docs &raquo;</a>
      </p>
    </div>
    -->
  <div class="row">
    <div class="col-xs-12">
      <?php
        if (isset($_GET["testid"]))
        {
          $questions = Question::getQuestionsByTestID($_GET["testid"]);
          if (count($questions) > 0)
          {
            echo "<h3>Test: ".$questions[0]->TestName."</span></h3>";
            echo "<form>";
            echo "<ol>";
            foreach ($questions as $question)
            {
              echo "<li class='content-fluid' style='background-color: silver; padding: 5px; margin-bottom: 10px; font-weight: bold;'>".$question->QuestionText."</li>";


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
            echo "</ol>";
            echo "</form>";
        }
        else
        {
          
        }
      ?>
    </div>
  </div>

  <!-- End Header-->
</div>
<?php 
  include_once("footer.php");
?>