<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Thatcher Yard - Affordable Housing For Seniors and Families</title>
<link rel="stylesheet" type="text/css" href="style.css">
<link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script>
	$(function() {
	  $('a[href*=#]:not([href=#])').click(function() {
	    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {

	      var target = $(this.hash);
	      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
	      if (target.length) {
	        $('html,body').animate({
	          scrollTop: target.offset().top
	        }, 1000);
	        return false;
	      }
	    }
	  });
	});
</script>
<style type="text/css">
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	text-align: center;
	color: #FFFFFF;
}
</style>
</head>

<body>
<div id="Header">
	<div class="Logo"></div>
</div>

<div id="InterestList">
    <div class="information-wrapper" id="PropertyContainer">
		<div class="ConfirmationMessage">
<?php
require("api/functions.php");

if (isset($_POST['email']) && isset($_POST['name'])) { 
	// Create error array
	// Errors we catch will be added to this array
	$error = array();

	// Get the variables from the form
    $email = SanitizeEmail($_POST['email']);
    $name = SanitizeInputs($_POST['name']);

	// Check to make sure a name was entered
	if($name == ""){
		$error[] = "Please enter a name.";
	}

	// Check to make sure the email is valid
	if ( ! filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$error[] = "Please enter a valid email address.";
	}

	// If there are no errors, send the email
	// Else, output the errors and don't send the email
	if ( ! $error) {


		// Make the call to the client to send email. + Database
		SendConfirmationEmail($email,"Email Subscription Confirmation",$name);
	
		//echo "Email Sent to your email! Check your inbox and confirm it! Thank you";
		echo "Thank you for your interest in Thatcher Yard.<br>
				We have received your information<br>
				and will keep you informed on future news.";
	
	} else {
		// Output any errors

		foreach ($error as $line) {
		     echo "<div class='error'>$line</div>";
		}
		echo '<button type="button" class="submit-button" onClick="javascript: history.back()">Back</button>';
	}	
}
?>
		</div>
    	<br>
        <br>
	</div>
</div>
<div id="Footer">
	<a href="http://www.tsahousing.com"><div id="FooterLogo"></div></a>
	<span class="Slogan">Our Goal is to enhance the world in which we live and enrich the lives of the people who reside in our buildings.<br>
	© Copyright 2015 - Thomas Safran &amp; Associates. All Rights Reserved.</span><br>
	<br>
	<img src="images/legalicons.png" width="100" height="45" alt=""/></div>
</body>
</html>
