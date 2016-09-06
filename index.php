<?php

/**
 * index.php
 *
 * Akinlabi O. Ajelabi
 * akinlabiajelabi@me.com
 *
 * A home page for Josla.
 */

if (isset($_POST["submit"])) {
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$email = $_POST['email'];
	$cname = $_POST['cname'];
	$jtitle = $_POST['jtitle'];
	$phone = $_POST['phone'];
	$region = $_POST['region'];
	$capacity = $_POST['capacity'];
	$from = 'Request Demo Form'; 
	$to = 'akinlabiajelabi@me.com'; 
	$subject = 'Message from JoslaOS Request Demo ';
		
	$body = "FName: $fname\n LName: $lname\n E-Mail: $email\n CName: $cname\n JTitle: $jtitle\n Phone: $phone\n Region: $region\n Capacity: $capacity";
 
	// Check if first name has been entered
	if (!$_POST['fname']) {
		$errFName = 'Please enter your First Name';
	}
		
	// Check if last name has been entered
	if (!$_POST['lname']) {
		$errLName = 'Please enter your Last Name';
	}
		
	// Check if email has been entered and is valid
	if (!$_POST['email'] || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
		$errEmail = 'Please enter a valid email address';
	}
		
	// Check if company name has been entered
	if (!$_POST['cname']) {
		$errCName = 'Please enter your Company Name';
	}
		
	// Check if job title has been entered
	if (!$_POST['jtitle']) {
		$errJTitle = 'Please enter your Job Title';
	}
		
	// Check if job title has been entered
	if (!$_POST['phone']) {
		$errPNumber = 'Please enter your Phone Number';
	}
		
	// If there are no errors, send the email
	if (!$errFName && !$errLName &&!$errEmail && !$errCName && !$errJTitle && !$errPNumber) {
		if (mail ($to, $subject, $body, $from)) {
			$result='<div class="alert alert-success">Thank You! Our tech team will be in touch</div>';
		} else {
			$result='<div class="alert alert-danger">Sorry there was an error sending your message. Please try again later</div>';
		}
	}
}
?>

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
	<div id="header">
		<nav class="navbar navbar-inverse">
			<div class="container">
				<div class="navbar-header">
					<a class="navbar-brand" href="index.php"><strong>Josla</strong></a>
				</div>
	    
				<ul class="nav navbar-nav navbar-right">
					<li><a href="app/login.php">Sign In</a></li>
					<li><button type="button" class="btn btn-primary outline btn-lg" data-toggle="modal" data-target="#myModal">Request Demo</button></li>

					<!-- Modal -->
					<div class="modal fade" id="myModal" role="dialog">
						<div class="modal-dialog">
    
							<!-- Modal content-->
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h4 class="modal-title">Request a Demo</h4>
								</div>
								<div class="modal-body">
									<p>You’ve got questions? Fill out the form below and a member of our technology team will contact you for a 1-to-1 walk through. You also get your first 30 days on us!</p>
									<br>
									<form class="form" role="form", method="post" action="index.php">
										<div class="row">
											<div class="col-xs-6 form-group">
												<label>First Name</label>
												<input class="form-control" type="text" id="fname" name="fname" placeholder="First Name" value="<?php echo htmlspecialchars($_POST['fname']); ?>"/>
												<?php echo "<p class='text-danger'>$errFName</p>";?>
											</div>
											<div class="col-xs-6 form-group">
												<label>Last Name</label>
												<input class="form-control" type="text" id="lname" name="lname" placeholder="Last Name" value="<?php echo htmlspecialchars($_POST['lname']); ?>"/>
												<?php echo "<p class='text-danger'>$errLName</p>";?>
											</div>
											<div class="col-xs-6 form-group">
												<label>Email Address</label>
												<input class="form-control" type="text" id="email" name="email" placeholder="Email Address" value="<?php echo htmlspecialchars($_POST['email']); ?>"/>
												<?php echo "<p class='text-danger'>$errEmail</p>";?>
											</div>
											<div class="col-xs-6 form-group">
												<label>Company Name</label>
												<input class="form-control" type="text" id="cname" name="cname" placeholder="Company Name" value="<?php echo htmlspecialchars($_POST['cname']); ?>"/>
												<?php echo "<p class='text-danger'>$errCName</p>";?>
											</div>
											<div class="col-xs-6 form-group">
												<label>Job Title</label>
												<input class="form-control" type="text" id="jtitle" name="jtitle" placeholder="Job Title" value="<?php echo htmlspecialchars($_POST['jtitle']); ?>"/>
												<?php echo "<p class='text-danger'>$errJTitle</p>";?>
											</div>
											<div class="col-xs-6 form-group">
												<label>Phone Number</label>
												<input class="form-control" type="text" id="phone" name="phone" placeholder="Phone Number" value="<?php echo htmlspecialchars($_POST['phone']); ?>"/>
												<?php echo "<p class='text-danger'>$errPNumber</p>";?>
											</div>
											<div class="col-xs-6 form-group">
												<label for="sel1">Distribution Region:</label>
												<select class="form-control" id="region" name="region">
													<option>Eko DisCo</option>
													<option>Ikeja DisCo</option>
													<option>Ibadan DisCo</option>
													<option>Abuja DisCo</option>
												</select>
											</div>
											<div class="col-xs-6 form-group">
												<label for="sel1">Utility Capacity:</label>
												<select class="form-control" id="capacity" name="capacity">
													<option>Below 10MW</option>
													<option>10 - 25MW</option>
													<option>25 - 50MW</option>
													<option>Over 50MW</option>
												</select>
											</div>
											<div class="col-xs-12 form-group text-center">
												<input id="submit" name="submit" type="submit" value="Send" class="btn btn-primary outline">
											</div>
											<div class="col-xs-12 form-group text-center">
												<?php echo $result; ?>
											</div>
										</div>
									</form>
								</div>
							</div>
      
						</div>
					</div>
				</ul>
			</div>
		</nav>
	
		<div class="container">
			<div class="jumbotron text-right">
				<h1>New <br>Electrification <br>Experience!</h1>
				<p>Electric power utilities use <strong>Josla</strong>OS to optimise <br>and effectively plan their network operations.</p>
			</div>
		</div>
	</div>
	
	<div id="service">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<h2 style="margin-top:20px">Use <strong>Josla</strong>OS to ensure your electric network is efficient, reliable and sustainable</h2>
					<br>
					<hr>
					<br>
					<p><strong>Josla</strong>OS enable utility stakeholders - financiers, managers, engineering and technicians - mitigate system downtime, improve collaborative decision making and account for lost revenue.</p>
					<div class="row">
						<div class="col-md-6">
							<ul class="list-unstyled">
								<li><span class="glyphicon glyphicon-ok"></span> Load forecast</li>
								<br>
								<li><span class="glyphicon glyphicon-ok"></span> Periodic report</li>
							</ul>
						</div>
						<div class="col-md-6">
							<ul class="list-unstyled">
								<li><span class="glyphicon glyphicon-ok"></span> Web & Mobile self-service</li>
								<br>
								<li><span class="glyphicon glyphicon-ok"></span> Network status</li>
							</ul>
						</div>
					</div>
					<br>
					<button type="button" class="btn btn-primary outline btn-lg" data-toggle="modal" data-target="#myModal">Request Demo</button>

					<!-- Modal -->
					<div class="modal fade" id="myModal" role="dialog">
						<div class="modal-dialog">
    
							<!-- Modal content-->
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h4 class="modal-title">Request a Demo</h4>
								</div>
								<div class="modal-body">
									<p>You’ve got questions? Fill out the form below and a member of our technology team will contact you for a 1-to-1 walk through. You also get your first 30 days on us!</p>
									<br>
									<form class="form" role="form", method="post" action="index.php">
										<div class="row">
											<div class="col-xs-6 form-group">
												<label>First Name</label>
												<input class="form-control" type="text" id="fname" name="fname" placeholder="First Name" value="<?php echo htmlspecialchars($_POST['fname']); ?>"/>
												<?php echo "<p class='text-danger'>$errFName</p>";?>
											</div>
											<div class="col-xs-6 form-group">
												<label>Last Name</label>
												<input class="form-control" type="text" id="lname" name="lname" placeholder="Last Name" value="<?php echo htmlspecialchars($_POST['lname']); ?>"/>
												<?php echo "<p class='text-danger'>$errLName</p>";?>
											</div>
											<div class="col-xs-6 form-group">
												<label>Email Address</label>
												<input class="form-control" type="text" id="email" name="email" placeholder="Email Address" value="<?php echo htmlspecialchars($_POST['email']); ?>"/>
												<?php echo "<p class='text-danger'>$errEmail</p>";?>
											</div>
											<div class="col-xs-6 form-group">
												<label>Company Name</label>
												<input class="form-control" type="text" id="cname" name="cname" placeholder="Company Name" value="<?php echo htmlspecialchars($_POST['cname']); ?>"/>
												<?php echo "<p class='text-danger'>$errCName</p>";?>
											</div>
											<div class="col-xs-6 form-group">
												<label>Job Title</label>
												<input class="form-control" type="text" id="jtitle" name="jtitle" placeholder="Job Title" value="<?php echo htmlspecialchars($_POST['jtitle']); ?>"/>
												<?php echo "<p class='text-danger'>$errJTitle</p>";?>
											</div>
											<div class="col-xs-6 form-group">
												<label>Phone Number</label>
												<input class="form-control" type="text" id="phone" name="phone" placeholder="Phone Number" value="<?php echo htmlspecialchars($_POST['phone']); ?>"/>
												<?php echo "<p class='text-danger'>$errPNumber</p>";?>
											</div>
											<div class="col-xs-6 form-group">
												<label for="sel1">Distribution Region:</label>
												<select class="form-control" id="region" name="region">
													<option>Eko DisCo</option>
													<option>Ikeja DisCo</option>
													<option>Ibadan DisCo</option>
													<option>Abuja DisCo</option>
												</select>
											</div>
											<div class="col-xs-6 form-group">
												<label for="sel1">Utility Capacity:</label>
												<select class="form-control" id="capacity" name="capacity">
													<option>Below 10MW</option>
													<option>10 - 25MW</option>
													<option>25 - 50MW</option>
													<option>Over 50MW</option>
												</select>
											</div>
											<div class="col-xs-12 form-group text-center">
												<input id="submit" name="submit" type="submit" value="Send" class="btn btn-primary outline">
											</div>
											<div class="col-xs-12 form-group text-center">
												<?php echo $result; ?>
											</div>
										</div>
									</form>
								</div>
							</div>
      
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<img src="https://s3-us-west-2.amazonaws.com/joslaelectric.com/images/dashboard-screenshot.png" class="img-rounded" alt="Cinque Terre" width="550" height="380">
				</div>
			</div>
		</div>
	</div>
	
	<div id="model">
		<div class="container">
			<div class="well text-center">
				<h2>Technology</h2>
				<br>
				<div class="row">
					<div class="col-md-4">
						<div class="panel panel-default">
							<div class="panel-heading">Smart Grid</div>
							<div class="panel-body">Integrate ICT between any points in electricity supply to enable your electric network become more observable, controllable, automated and interoperable with various renewable energy sources.</div>
						</div>	
					</div>
					<div class="col-md-4">
						<div class="panel panel-default">
							<div class="panel-heading">Data Science</div>
							<div class="panel-body">Transform your key electric network operation data into information, information into insight and insight into intelligent business decision that reduces time and effort required for O&M activities.</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="panel panel-default">
							<div class="panel-heading">Cloud Computing</div>
							<div class="panel-body">Store and process your electric network operation data using cost-effective and scalable computing resources to improve system efficiency and service reliability across various areas within an electric utility.</div>
						</div>
					</div>
				</div>
				<br>
				<p class="lead">We combine system design thinking with effective engineering principles to make a <strong>difference!</strong></p>
				<br>
				<a href="#" class="btn btn-primary outline btn-lg">Read Blog!</a>
			</div>
		</div>
	</div>
	
	<div id="team">
		<div class="container">
			<h2 class="text-center">Developer</h2>
			<br>
			<div class="row">
				<div class="col-md-6 text-right">
					<img src="https://s3-us-west-2.amazonaws.com/joslaelectric.com/images/akinlabi.jpg" class="img-circle" alt="Cinque Terre" width="300" height="200">
				</div>
				<div class="col-md-4 text-left">
					<h4>Akinlabi Ajelabi</h4>
					<h4><small>C.E.O / Data Scientist</small></h4>
					<br>
					<p>Akinlabi has an undergraduate degree in Electrical Electronics Engineering, two post graduate degrees in Data Analytics and Innovation & Entrepreneurship. Also as an Apple associate, he has previous startup experience integrating IT solution for individuals and businesses.</p>
				</div>
			</div>
		</div>
	</div>
	
	<div id="footer">
		<div class="container">
			<div class="well">
				<div class="row">
					<div class="col-md-4">
						<h4><a href="index.php"><strong>Josla</strong></a></h4>
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