<!DOCTYPE html>
<!-- Neeraj Jain : 27 Feb, 2018 -->
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<link rel="stylesheet" href="signup.css">
	<title>LinkedIn_SignUp</title>
</head>
<body onload="form1.reset();">
	<div class="body">
		<div class="logo" align="center">
			<h2>Job <span style="background-color:#0077B5;">Ster</span></h2>
		</div>
		<br><br><br><br>
		<h3 align="center"><b>Join to view full profiles for free</b></h3>
		<br><br>
		<form method="GET" action="" name="form1">
		
		<div class="input" align="center">
			<input name="studentid" type="id" placeholder="studentID">
			<br>
			<input name="password" type="password" placeholder="Password (6 or more characters)">
			<br>
			<input name="studentname" type="text" placeholder="Student Name">
			<br>
		</div>

		</form>
		<br>
		<div align="center" style="font-size : 16px;">
		By clicking Join now ,you agree to the Jobster <a href="#">User<br>Agreement</a>,<a href="#"> Privacy Policy</a>, and <a href="#">Cookie Policy</a>
		</div>
		<br><br><br>
		<div class="button" align="center">
		
		<button onclick="form1.action='StudentSignUp_Redirect.php';form1.submit();">Join now</button>
		</div>
		<p align="center">Already have an account? <strong><a href="index.php">Sign in</a></strong></p>
	</div>
</body>
</html>