<?php
  require_once("alerts.php");
  require_once("User.php");
  require_once("Test.php");

  session_start();

  function checkAccess()
  {
    //redirects to home page if access denied
    if (!isset($_SESSION["LoggedUser"]))
    {
      header("Location: index.php");
    }
  }

  function redirect($path = "index.php", $time = "0")
  {
    echo '<META HTTP-EQUIV="Refresh" Content="'.$time.'; URL='.$path.'">';
  }
  
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="/ico/favicon.ico">
    <link rel="stylesheet" type="text/css" href="css/TestOMatic.css">
    <link rel="stylesheet" type="text/css" href="http://bootstrap-growl.remabledesigns.com/css/bootstrap-growl.css">
    <title>Welcome to TestO'Matic</title>


    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <!-- Custom styles for this template -->
  
  <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript">
      function showAlert(message, type)
      {
         var a = "<div class='alert alert-" + type + " alert-dismissable'>";
         a += "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
         a += message + "</div>";
         $(".show-alert").append(a);
         hideAlert();
      }

    </script>
  </head>

  <body>
    <!-- Begin Header -->
    <div class="container top15">
      <div class="col-md-4">
        TestO'Matic
      </div>
      <div class="text-right">
        <a href="#">New Tests <span class="badge">2</span></a>
      </div>
    </div>
    
    <div class="container top5">
      <!-- Static navbar -->
      <div class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">Home</a>
          </div>
          <div class="navbar-collapse collapse">
            <!-- <ul class="nav navbar-nav">
              <li class="active"><a href="#">Tests</a></li>
            </ul> -->
            <ul class="nav navbar-nav navbar-right">
              <?php 

                

                /*$usr = User::getUserById(2);
                $_SESSION["LoggedUser"] = $usr;*/
                if (isset($_SESSION["LoggedUser"]))
                {
              ?>
                  <!-- Begin account menu -->
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">My Account <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                      <li><a href="#"><i class="glyphicon glyphicon-share"></i>&nbsp;Tests Shared With Me</a></li>
                      <li class="divider"></li>
                      <li><a href="CreateTest.php"><i class="glyphicon glyphicon-plus-sign"></i>&nbsp;Create New Test</a></li>
                      <li class="divider"></li>
                      <li><a href="#"><i class="glyphicon glyphicon-cog"></i>&nbsp;Account Settings</a></li>
                      <li class="divider"></li>
                      <li><a href='logout.php?previous=<?php echo $_SERVER["REQUEST_URI"]; ?>'><i class="glyphicon glyphicon-log-out"></i>&nbsp;Log Out</a></li>
                      <?php
                        $myTests = Test::getByUserID($_SESSION["LoggedUser"]->UserID);

                        if (count($myTests))
                        {
                          echo "<li class='dropdown-submenu'><a href='#'><i class='glyphicon glyphicon-eye-open'></i>&nbsp;View My Tests</a>";
                          echo "<ul class='dropdown-menu'>";

                        foreach($myTests as $test)
                        {
                          echo "<li><a href='Tests.php?testid=$test->TestID'>$test->TestName</a></li>";
                        }
                          echo "</ul>";
                          echo "</li>";
                        }
                      ?>
                    </ul>
                  </li>
                  <!-- End account menu -->
                <?php
                }
                else
                {
                ?>
                  <li><a href="#" data-toggle="modal" data-target="#myModal">Log In</a></li>
                  <li><a href="#">Sign Up</a></li>
                
                <?php
                }
                ?>
            </ul>
          </div>
        </div>
      </div>
      <!-- Static navbar End -->
      <div class="show-alert">
      </div>
      <?php 
        if (isset($_SESSION["alert"]))
        {
          showAlert();
        }
      ?>
