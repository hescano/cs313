<%@ page language="java" contentType="text/html; charset=ISO-8859-1"
	pageEncoding="ISO-8859-1"%>
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
<link rel="stylesheet" type="text/css"
	href="http://bootstrap-growl.remabledesigns.com/css/bootstrap-growl.css">
<title>Forum</title>


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
	function showAlert(message, type) {
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
	<div class="container top5">
		<div class="show-alert"></div>
		<div class="row">
			<div class="col-xs-f">
				<div class="container">
					<div id="loginbox" style="margin-top: 50px;"
						class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
						<div class="panel panel-info">
							<div class="panel-heading">
								<div class="panel-title">Sign In</div>
							</div>

							<div style="padding-top: 30px" class="panel-body">
								<div style="display: none" id="login-alert"
									class="alert alert-danger col-sm-12"></div>
								<form id="loginform" class="form-horizontal" role="form"
									action="DoLogin" method="post">
									<div style="margin-bottom: 25px" class="input-group">
										<span class="input-group-addon"><i
											class="glyphicon glyphicon-user"></i></span> <input
											id="login-username" type="text" class="form-control"
											name="username" value="" placeholder="username or email">
									</div>
									<div style="margin-bottom: 25px" class="input-group">
										<span class="input-group-addon"><i
											class="glyphicon glyphicon-lock"></i></span> <input
											id="login-password" type="password" class="form-control"
											name="password" placeholder="password">
									</div>
									<div style="margin-top: 10px" class="form-group">
										<!-- Button -->

										<div class="col-sm-12 controls">
											<button id="btn-login" type="submit" class="btn btn-primary">Login
											</button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- End Header-->
	</div>
	<!-- Bootstrap core JavaScript
   ================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script type="text/javascript">
		$(function() {
			hideAlert();
	<%if (request.getSession().getAttribute("validUser") != null) {
				Boolean isLogged = (Boolean) request.getSession().getAttribute(
						"validUser");

				if (!isLogged) {
					out.println("showAlert('Username/Password combination invalid.', 'danger');");
				}
				request.getSession().removeAttribute("validUser");
			}%>
		});
		function hideAlert() {
			if ($(".alert").length > 0) {
				setTimeout(function() {
					$(".alert").slideUp("slow");
				}, 10000);
			}
		}
	</script>
</body>
</html>