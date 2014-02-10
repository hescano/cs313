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

                require_once("User.php");

                $usr = User::getUserById(2);
                $_SESSION["LoggedUser"] = $usr;

                if (isset($_SESSION["LoggedUser"]))
                {
              ?>
                  <!-- Begin account menu -->
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">My Account <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                      <li class="dropdown-submenu"><a href="#"><i class="glyphicon glyphicon-eye-open"></i>&nbsp;View My Tests</a>
                        <ul class="dropdown-menu">
                          <li><a tabindex="-1" href="#">Second level</a></li>
                          <li class="dropdown-submenu">
                            <a href="#">More..</a>
                            <ul class="dropdown-menu">
                              <li><a href="#">3rd level</a></li>
                              <li><a href="#">3rd level</a></li>
                            </ul>
                          </li>
                          <li><a href="#">Second level</a></li>
                          <li><a href="#">Second level</a></li>
                        </ul>
                      </li>
                      <li><a href="#"><i class="glyphicon glyphicon-share"></i>&nbsp;Tests Shared With Me</a></li>
                      <li class="divider"></li>
                      <li><a href="#"><i class="glyphicon glyphicon-plus-sign"></i>&nbsp;Create New Test</a></li>
                      <li class="divider"></li>
                      <li><a href="#"><i class="glyphicon glyphicon-cog"></i>&nbsp;Account Settings</a></li>
                      <li class="divider"></li>
                      <li><a href="#"><i class="glyphicon glyphicon-log-out"></i>&nbsp;Log Out</a></li>
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