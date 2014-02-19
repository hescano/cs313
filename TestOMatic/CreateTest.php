<?php 
   include_once("User.php");
   include_once("Test.php");
   include_once("header.php");
   include_once("Update.php");
  
   checkAccess(); //get outta here if no access

   if($_SERVER['REQUEST_METHOD'] == 'POST')
   {
      //added test, check fields
      $testName = $_POST["txtTestName"];

      if ($testName != "")
      {
         $loggedUser = $_SESSION["LoggedUser"];
         $isPublic = (isset($_POST["chkPublic"]) ? 1 : 0);
         $tmpTest = Test::Insert($testName, $loggedUser->UserID, $isPublic, 1);
         //generate hidden field with TestID
         //in case there is any error, redirects.
         if (!isset($tmpTest))
         {
            Alert::setAlert("<strong>Error Creating Test!</strong><br />Possible cause of error: Duplicate Test name and User combination (you already have a test with this name). Please try with a different name.", "danger");
            header("Location: CreateTest.php");
         }
         else
         {
            Alert::setAlert("<strong>Test created successfully!</strong><br />Now you can add <strong>Questions</strong> to this test. First click the <strong><i>New Question</i></strong> button to get started! ", "success");
            header("Location: AddQuestions.php?testid=$tmpTest->TestID");  
         }
      }
   }
?>
   <div class="panel panel-default">
      <div class="panel-heading">
         <h3 class="panel-title">Create New Test</h3>
      </div>
      <div class="panel-body">
         <form class="form-horizontal" role="form" method="post" action="CreateTest.php">
            <div class="form-group">
               <label for="inputEmail3" class="col-sm-2 control-label">Test Name</label>
               <div class="col-sm-10">
                  <input type="text" class="form-control" id="txtTestName" name="txtTestName" placeholder="Name of the test">
               </div>
            </div>
            <div class="form-group">
               <div class="col-sm-offset-2 col-sm-10">
                  <div class="checkbox">
                     <label>
                        <input type="checkbox" name="chkPublic" value="doPublic"> Make test Public?
                     </label>
                  </div>
               </div>
            </div>
            <div class="form-group">
               <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" class="btn btn-default">Create Test</button>
               </div>
            </div>
         </form>
      </div>
   </div>
<?php 
  include_once("footer.php");
?>