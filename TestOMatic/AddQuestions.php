<?php 
   include_once("User.php");
   include_once("Test.php");
   include_once("header.php");
   include_once("Update.php");
   include_once("AnswerType.php");
   include_once("Question.php");

   checkAccess(); //get outta here if no access

   $allAnswerTypes = AnswerType::getAllAnswerTypes();

   $testId = $_GET["testid"];

   if ($testId <= 0)
   {
      Alert::setAlert("<strong>Invalid Test!</strong><br />Invalid test selected.", "danger");
      header("Location: index.php");
   }
   else
   {
      $tmpTest = Test::getByTestID($testId);

      if (!isset($tmpTest))
      {
         Alert::setAlert("<strong>Invalid Test!</strong><br />Invalid test selected.", "danger");
         header("Location: index.php");
      }
   }

   if($_SERVER['REQUEST_METHOD'] == 'POST')
   {
      $questionText = "";
      $answerType = 0;

      foreach(array_keys($_POST) as $field) 
      {
         $value = $_POST[$field];

         if (strpos($field, "txtQuestion") > -1)
         {
            $questionText = $value;
         }
         else if (strpos($field, "selectAnswerType") > -1)
         {
            $answerType = $value;

            if ($questionText != "" && $answerType > 0)
            {
               $insertedQuestion = Question::Insert($questionText, $testId, $answerType, true);

               $answerType = 0;
               $questionText = "";

               //in case there is any error, redirect to the home.
               //user can try and fix it from the Tests page.
               if (!isset($insertedQuestion))
               {
                  Alert::setAlert("<strong>Error inserting question</strong> Please try again.", "danger");
                  header("Location: index.php");
                  exit;
               }
            }
         }
      }
      //if we get to here after a post, it means we inserted all questions successfully.
      //now we add answers for this test and its questions.
      Alert::setAlert("<strong>Questions added successfully!</strong> You are almost done! Last step, add some answers to your questions.", "success");
      redirect("AddAnswers.php?testid=$testId");

   }
?>

<form role="form" method="post" action="AddQuestions.php?testid=<?php echo $_GET['testid']; ?>">
   <div class="panel panel-default">
      <div class="panel-heading">
         <h3 class="panel-title">Add Questions for Test: <strong><?php echo $tmpTest->TestName; ?></strong></h3>
      </div>
      <div class="panel-body">
         <table class="table table-hover" id="tblQuestions">
            <thead>
               <tr>
                  <th>
                     #
                  </th>
                  <th>
                     Question
                  </th>
                  <th>
                     Answer Type
                  </th>
                  <th>
                     Action
                  </th>
               </tr>
            </thead>
            <tbody>
               <tr><td colspan="4" class="warning">No questions yet. Click on the <strong>New Question</strong> button.</td></tr>
            </tbody>
         </table>
         <div class="row top5 col-md-12">
            <div class="form-group">
               <button type="button" id="btnAddQuestion" class="btn btn-info"><i class="glyphicon glyphicon-plus-sign"></i> New Question</button>
            </div>
         </div>
      </div>
      <div class="panel-footer">
         <button type="submit" class="btn btn-default">Add Questions</button>
      </div>
   </div>
</form>

<?php 
  include_once("footer.php");
?>

<script type="text/javascript">

   $(function()
   {
      $("#btnAddQuestion").on("click", function()
      {
         //remove first message
         var warning = $("#tblQuestions tbody .warning")
         warning.unwrap().remove();

         //counts rows (not 0 based)
         var count = $("#tblQuestions tbody tr").length + 1;
         
         var $tr = $("<tr data-rowcount='" + count + "'>");
         var $td1 = $("<td>").html(count);
         var $td2 = $("<td>");
         var $td3 = $("<td>");
         var $td4 = $("<td>").html("<span class='link removeItem' data-questionindex='" + count + "'>Delete</span> &nbsp;<i class='glyphicon glyphicon-trash'></i>");

         var $txt = $("<input>").attr("type", "text").addClass("form-control").attr("id", "question" + count).attr("placeholder", "Type Question Here").attr("name", "txtQuestion" + count);
         
         var select = $("<select>").addClass("form-control").attr("name", "selectAnswerType" + count);
         select.append($("<option>").attr("value", "-1").html("Select Answer Type"));

         //adds the answers to the dropdown menus
         <?php 
            foreach($allAnswerTypes as $answerTypes)
            {
               echo "select.append($('<option>').attr('value', '$answerTypes->AnswerTypeID').html('$answerTypes->AnswerTypeName'));\n";
            }
         ?>

         $td2.append($txt);
         $td3.append(select);

         $tr.append($td1).append($td2).append($td3).append($td4);
         //appends to row
         $("#tblQuestions tbody").append($tr);

         //add count

         //scrolls to bottom
         $('html, body').scrollTop($(document).height());
      });

      //removes a row from the table
      $("#tblQuestions").on("click",  ".removeItem", function()
      {
         var index = $(this).data("questionindex");
         $row = $("#tblQuestions tr[data-rowcount='" + index + "']");
         $row.remove();

         updateTable();

         index = $("#tblQuestions tbody tr").length;
         
         if (index === 0)
         {
            $("#tblQuestions tbody").append("<tr><td colspan='4' class='warning'>No questions yet. Click on the <strong>New Question</strong> button.</td></tr>");
         }
      });

      //updates the table's cells
      updateTable = function()
      {
         var count = 1;
         $("#tblQuestions tbody tr td:first-child").each(function()
         {
            $(this).html(count);
            count ++;
         });
      }
   });
</script>