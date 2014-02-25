<?php 

   include_once("header.php");
   checkAccess(); //get outta here if no access
   include_once("User.php");
   include_once("Test.php");
   
   include_once("Update.php");
   include_once("AnswerType.php");
   include_once("Question.php");
   include_once("Answer.php");

   if (!is_numeric($_GET["testid"]))
   {
      Alert::setAlert("<strong>Invalid Test!</strong><br />Invalid test selected.", "danger");
      redirect();
      exit;
   }
   else
   {
      $testId = $_GET["testid"];
   }

   $tmpTest = Test::getByTestID($testId);

   if (!isset($tmpTest))
   {
      Alert::setAlert("<strong>Invalid Test!</strong><br />Invalid test selected.", "danger");
      redirect();
      exit;
   }

   //if we get to here, it means everything is working fine

   //get all questions for this test
   $questions = Question::getQuestionsByTestID($testId);
   
   //get all existing answers for this test
   //TODO: improve this with just one big JOIN with
   //Tests, Answers, AnswersTypes, etc...
   
   $answers = array();
   if (count($questions) <= 0)
   {
      //redirect to add questions, if the test has no questions
      Alert::setAlert("<strong>Invalid Test!</strong><br />The selected test has no questions. Please add some questions first.", "danger");
      header("Location: AddQuestions.php?testid=$testId");
   }
?>

<div class="panel panel-default">
<form action="submitAnswers.php" method="post" id="frmAnswers">
   <div class="panel-heading">
      <h3 class="panel-title">All Questions for Test: <strong><?php echo $tmpTest->TestName; ?></strong> (<?php echo count($questions) ?>)</h3>
   </div>
   <div class="panel-body">
      <?php
      foreach($questions as $key=>$question)
      {
         $answers = array();
         $answers = Answer::getAnswersByQuestionId($question->QuestionID);

      ?>
            <div class="panel panel-default">
               <div class="panel-heading">
                  <h3 class="panel-title"><?php $val=$key + 1; echo "Question $val - <strong>$question->AnswerTypeName</strong>"; ?></h3>
               </div>
               <div class="panel-body">
                  <table class="table table-hover tblQuestions" data-answertype='<?php echo $question->AnswerTypeID; ?>'>
                     <thead>
                        <tr>
                           <th style="width: 300px;">
                              Question
                           </th>
                           <th style="width: 200px;">
                              Answer Settings
                           </th>
                           <th>
                              Answers
                           </th>
                        </tr>
                     </thead>
                     <tbody>
                        <tr data-questionid='<?php echo $question->QuestionID; ?>'>
                           <td>
                              <strong><?php echo $question->QuestionText; ?></strong>
                           </td>
                           <td>
                              <?php 
                                 switch ($question->AnswerTypeID)
                                 {
                                    case 1:
                                    case 2:
                                       echo "<strong># of Answers: </strong>";
                                       echo "<select class='form-control answer-settings' data-answertype='$question->AnswerTypeID'>";
                                       echo "<option value='-1'>Choose One</option>";
                                       
                                       //do we have answers for this question?
                                       $aCount = 0;
                                       if (isset($answers))
                                       {
                                          $aCount = count($answers);
                                       }
                                       
                                       for($i = 2; $i < 7; $i++)
                                       {
                                          if ($aCount > 0 && $i == $aCount)
                                          {
                                             echo "<option value='$i' selected>$i</option>";
                                          }
                                          else
                                          {
                                             echo "<option value='$i'>$i</option>";
                                          }
                                       }
                                       
                                       echo "</select>";
                                       break;
                                    case 3:
                                       echo "<strong>Case sensitive?</strong>&nbsp;<input type='checkbox' />";
                                       break;
                                 }
                              ?>
                           </td>
                           <td>
                              <?php
                                 switch ($question->AnswerTypeID)
                                 {
                                    case 1:
                                    case 2:
                                       if (isset($answers) && count($answers) > 0)
                                       {
                                          echo "<ol type='a'>";
                                          $i = 0;
                                          foreach ($answers as $answer)
                                          {
                                             $isAnswer = "";
                                             if ($answer->IsAnswer)
                                             {
                                                $isAnswer = "checked";
                                             }

                                             echo "<li><div class='input-group'><span class='input-group-addon'>";
                                             
                                             if ($question->AnswerTypeID == 1)
                                             {
                                                echo "<input type='radio' name='question_".$question->QuestionID."_isanswer' $isAnswer value='question_".$question->QuestionID."_answer_$i' />";
                                             }
                                             else
                                             {
                                                echo "<input type='checkbox' name='question_".$question->QuestionID."_isanswer_$i' $isAnswer value='question_".$question->QuestionID."_answer_$i' />";
                                             }
                                             
                                             echo "</span><input type='text' class='form-control' name='question_".$question->QuestionID."_answer_$i' value='$answer->AnswerValue' required/></div></li>";
                                             $i++;
                                          }
                                          echo "</ol>";
                                       }
                                       break;
                                    case 3:
                                       $actualAnswer = "";
                                       foreach ($answers as $answer)
                                       {
                                          if ($answer->QuestionID == $question->QuestionID)
                                          {
                                             if (isset($answer->ActualAnswer))
                                             {
                                                $actualAnswer = $answer->ActualAnswer;
                                             }
                                          }
                                       }
                                       echo "<input type='text' class='form-control' value='$actualAnswer' required />";
                                       break;
                                 }
                              ?>
                           </td>
                        </tr>
                     </tbody>
                  </table>
               </div>
            </div>
            <?php
         }
      ?>
   </div>
      <div class="panel-footer">
         <button type="button" id="btnAddQuestion" class="btn btn-info"><i class="glyphicon glyphicon-share-alt"></i> Cancel</button>
         <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-plus-sign"></i> Create Test</button>
      </div>
      <input type="hidden" name="hiddenTestId" value='<?php echo $tmpTest->TestID; ?>' />
   </form>
</div>

<?php 
  include_once("footer.php");
?>
<script type="text/javascript" src="http://bootstrap-growl.remabledesigns.com/js/bootstrap-growl.js"></script>
<script type="text/javascript">
   $(function()
   {
      //submit begin
      
      $("#frmAnswers").on("submit", function(evt)
      {
         var continueSubmit = true;
         //validate the whole form
         $(".tblQuestions").each(function()
         {
            var answerType = $(this).data("answertype");
            var questionId = $(this).index() + 2;
            
            switch (answerType)
            {
               case 1:
                  //to be valid, we need all textboxes filled,
                  //and one radio button checked
                  var radios = $(this).find("input[type='radio']");
                  //to be valid, we also need at least 2 answers
                  
                  if (radios.length < 2)
                  {
                     //problem here, more than 2 answers need provided
                    $.growl('At least 2 answers are needed in question ' + questionId + '.', { type: 'danger' });
                    evt.preventDefault();
                    continueSubmit = false;
                  }
                  
                  //need at least one right answer
                  var isChecked = $(this).find("input[type='radio']:checked").length;
                  
                  if (isChecked == 0)
                  {
                     $.growl('You need to select a right answer in question ' + questionId + '.', { type: 'danger' });
                     evt.preventDefault();
                     continueSubmit = false;
                  }
                  
                  //now we need all texts filled in
                  var isEmpty = $(this).find("input[type='text']:text[value='']");
                  if (isEmpty.length > 0)
                  {
                     $.growl('All answers are required in question ' + questionId + '.', { type: 'danger' });
                     evt.preventDefault();
                     continueSubmit = false;
                  }
                  break;
               case 2:
                  //to be valid we need all textboxes filled,
                  //and at least one checkbox checked
                  //to be valid, we need all textboxes filled,
                  //and one checkboxes checked
                  
                  var checkboxes = $(this).find("input[type='checkbox']");
                  //to be valid, we also need at least 2 answers
                  
                  if (checkboxes.length < 2)
                  {
                     //problem here, more than 2 answers need provided
                    $.growl('At least 2 answers are needed in question ' + questionId + '.', { type: 'danger' });
                    evt.preventDefault();
                    continueSubmit = false;
                  }
                  
                  //need at least one right answer
                  var isChecked = $(this).find("input[type='checkbox']:checked").length;
                  if (isChecked == 0)
                  {
                     $.growl('You need to select a right answer in question ' + questionId + '.', { type: 'danger' });
                     evt.preventDefault();
                     continueSubmit = false;
                  }
                  
                  //now we need all texts filled in
                  var isEmpty = $(this).find("input[type='text']:text[value='']");
                  if (isEmpty.length > 0)
                  {
                     $.growl('All answers are required in question ' + questionId + '.', { type: 'danger' });
                     evt.preventDefault();
                     continueSubmit = false;
                  }
                  break;
               case 3:
                  //to be valid we need the texbox filled
                  break;
            }
         });
         
         if (continueSubmit)
         {
            $.ajax(
            {
              type: "POST",
              url: $(this).attr("action"),
              data: $(this).serialize(), // serializes the form's elements.
              success: function(response)
              {
                  if (response == "success")
                  {
                     var nav = confirm("Answers added successfully! Do you wish to navigate to this Test?");
                     if (nav)
                     {
                        location.href = "Tests.php?testid=<?php echo $testId; ?>";
                     }
                  }
              }
            });
            evt.preventDefault();
         }
         else
         {
            evt.preventDefault();
            return false;
         }
      });
      //end submit
      
      
      //for choose one/and all that apply answer types
      $(".answer-settings").on("change", function()
      {
         var questionId = $(this).closest("tr").data("questionid");
         var answersCount = $(this).val();
         var answerType = $(this).data("answertype");


         //get the cell with the answers
         var $cell = $("tr[data-questionid='" + questionId + "'] td:last-child");
         var actualCount = $("tr[data-questionid='" + questionId + "'] td:last-child input[type='text']").length;
        
         //logically, if the actual count is less than the amount we want to add
         //then we simply append new controls to the bottom,
         //otherwise, we remove the extra ones
         
         if (answersCount > 0 && answersCount > actualCount)
         {
            //if we already have a list, let's use it
            var $ul = $cell.find("ol");
            
            if ($ul.length == 0)
            {
               //no list, create it
               $ul = $("<ol>").attr("type", "a");
            }
            
            for (var i = actualCount; i < answersCount; i++)
            {
               var $li = $("<li>");
               var $div = $("<div>").addClass("input-group");
               var $span = $("<span>").addClass("input-group-addon");
               var $txtAnswer = $("<input>").attr("type", "text").attr("name", "question_" + questionId + "_answer_" + i).attr("required","").addClass("form-control");
               var $controls;

               if (answerType == 1)
               {
                  $controls = $("<input>").attr("type", "radio").attr("name", "question_" + questionId + "_isanswer").attr("value", "question_" + questionId + "_answer_" + i);
               }
               else
               {
                  $controls = $("<input>").attr("type", "checkbox").attr("name", "question_" + questionId + "_isanswer_answerid_" + i).attr("value", "question_" + questionId + "_answer_" + i);
               }

               $span.append($controls);
               $div.append($span).append($txtAnswer);

               $li.append($div);
               $ul.append($li); //add items to the list
            }

            $cell.append($ul);
         }
         else if(answersCount > 0 && answersCount < actualCount)
         {
            //remove the difference
            var difference = actualCount - answersCount;
            if (difference > 0)
            {
               //get the difference last ones
               var $extraElems = $("tr[data-questionid='" + questionId + "'] td:last-child li").slice(answersCount, actualCount);
               $.each($extraElems, function(){
                  $(this).remove();
               });
            }
         }
         else if (answersCount == -1)
         {
            $cell.empty();
         }
      });
   });
</script>