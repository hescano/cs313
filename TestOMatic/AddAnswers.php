<?php 

   include_once("header.php");
   checkAccess(); //get outta here if no access
   include_once("User.php");
   include_once("Test.php");
   
   include_once("Update.php");
   include_once("AnswerType.php");
   include_once("Question.php");

   

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

   //get all questions
   $questions = Question::getQuestionsByTestID($testId);

   if (count($questions) <= 0)
   {
      Alert::setAlert("<strong>Invalid Test!</strong><br />The selected test has no questions. Please add some questions first.", "danger");
      header("Location: AddQuestions.php?testid=$testId");
   }

   if($_SERVER['REQUEST_METHOD'] == 'POST')
   {
      //add answers logic here
   }
?>

<div class="panel panel-default">
   <div class="panel-heading">
      <h3 class="panel-title">All Questions for Test: <strong><?php echo $tmpTest->TestName; ?></strong> (<?php echo count($questions) ?>)</h3>
   </div>
   <div class="panel-body">
      <?php
         foreach($questions as $key=>$question)
         {
            ?>

            <div class="panel panel-default">
               <div class="panel-heading">
                  <h3 class="panel-title"><?php $val=$key + 1; echo "Question $val - <strong>$question->AnswerTypeName</strong>"; ?></h3>
               </div>
               <div class="panel-body">
                  <strong><?php echo $question->QuestionText; ?></strong>
               </div>
            </div>

            <?php
         }
      ?>
   </div>
   <div class="panel-footer">Panel footer</div>
</div>

<?php 
  include_once("footer.php");
?>