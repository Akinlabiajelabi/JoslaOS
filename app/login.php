<?php
/**
* login.php
*
* Akinlabi O. Ajelabi
* akinlabiajelabi@me.com
*
* A login page for Josla.
*/

include("config.php");
session_start();
   
if($_SERVER["REQUEST_METHOD"] == "POST") {
	// username and password sent from form 
      
	$myusername = mysqli_real_escape_string($db,$_POST['username']);
	$mypassword = mysqli_real_escape_string($db,$_POST['password']); 
      
	$sql = "SELECT id FROM admin WHERE username = '$myusername' and passcode = '$mypassword'";
	$result = mysqli_query($db,$sql);
	$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	$active = $row['active'];
      
	$count = mysqli_num_rows($result);
      
	// If result matched $myusername and $mypassword, table row must be 1 row
		
	if($count == 1) {
		$_SESSION['login_user'] = $myusername;
         
		header("location: dashboard.php");
	}else {
		$error = "Your Login Name or Password is invalid";
	}
}
?>
<html>
   
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>Josla | Smart Grid Solution</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://s3-us-west-2.amazonaws.com/joslaelectric.com/JoslaOS-bootstrap.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	  
</head>
   
<body>
	<div id="login">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-md-offset-3">
					<div class="well text-center">
						<h3>Login to JoslaOS</h3>
						<hr>
						<form class="form" role="form", method="post" action="">
							<div class="row">
								<div class="col-xs-6 col-xs-offset-3 form-group">
									<label>UserName</label>
									<input class="form-control" type="text" id="username" name="username" placeholder="UserName" value="<?php echo htmlspecialchars($_POST['username']); ?>"/>
								</div>
								<div class="col-xs-6 col-xs-offset-3 form-group">
									<label>Password</label>
									<input class="form-control" type="password" id="password" name="password" placeholder="Password" value="<?php echo htmlspecialchars($_POST['password']); ?>"/>
								</div>
								<div class="col-xs-12 form-group text-center">
									<input id="submit" name="submit" type="submit" value="Login" class="btn btn-primary outline">
								</div>
								<div class="col-xs-12 form-group text-center">
									<?php echo $error; ?>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	
      
	<div id="footer">
		<div class="container">
			<div class="well">
				<div class="row">
					<div class="col-md-4">
						<h4><a href="../index.php"><strong>Josla</strong></a></h4>
					</div>
					<div class="col-md-3 col-md-offset-2">
						<h5>Location</h5>
					</div>
					<div class="col-md-3">
						<h5>Get in touch</h5>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-md-4">
						<p>Utilities use JoslaOS to optimise and effectively plan their network operations.</p>
					</div>
					<div class="col-md-3 col-md-offset-2">
						<p>c/0 OA&A Partnership<br>27/29 Fortune Towers (6th Floor),<br>Adeyemo Alakija, Victoria Island,<br>Lagos State, Nigeria.</p>
					</div>
					<div class="col-md-3">
						<ul class="list-unstyled">
							<li>+ 234 (0) 808 748 8793</li>
							<li>service@joslaelectric.awsapps.com</li>
							<li>facebook</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	
		<nav class="navbar navbar-inverse">
			<div class="container">
				<ul class="nav navbar-nav navbar-right">
					<li><a href="#">2015-2016 Josla Electric Company Ltd.</a></li>
					<li><a href="#">Contact Us!</a></li>
				</ul>
			</div>
		</nav>
	</div>

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="js/bootstrap.min.js"></script>
</body>
</html>