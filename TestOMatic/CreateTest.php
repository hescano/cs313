<?php 
  include_once("User.php");
  include_once("Test.php");
  include_once("header.php");
  include_once("Update.php");

  
  checkAccess(); //get outta here if no access

   $step = 1;

   if($_SERVER['REQUEST_METHOD'] == 'POST')
   {
      $step = $_POST["hiddenStep"];

      if ($step == 2)
      {
         //added test, check fields
         $testName = $_POST["txtTestName"];

         if ($testName != "")
         {
            $loggedUser = $_SESSION["LoggedUser"];
            $isPublic = (isset($_POST["chkPublic"]) ? 1 : 0);
            $tmpTest = Test::Insert($testName, $loggedUser->UserID, $isPublic, 1);

            if (isset($tmpTest))
            {
               //we have the test created, ready to add questions,
               //generate hidden field with TestID
            }
         }
      }
   }

?>
<?php if ($step == 1) {?>
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
            <input type="hidden" name="hiddenStep" value="2" />
         </form>
      </div>
   </div>
<?php } elseif ($step == 2) { ?>
   <div class="panel panel-default">
      <div class="panel-heading">
         <h3 class="panel-title">Add Questions</h3>
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
                  <button type="submit" class="btn btn-default">Create Test</button>
               </div>
            </div>
            <input type="hidden" name="hiddenStep" value="3" />
            <input type="hidden" name="testID" value='<?php echo $tmpTest->TestID; ?>' />
         </form>
      </div>
   </div>
   <?php } ?>
<?php 
  include_once("footer.php");
?>