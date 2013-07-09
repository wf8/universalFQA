<?php
session_start(); 
require('fqa_config.php');

//destroy all of the session variables
$_SESSION = array(); 
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Universal FQA Calculator</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/bootstrap-responsive.min.css" rel="stylesheet">
    <link href="../css/fqa.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    
    <script src="../js/jquery-1.9.1.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<script src="../js/fqa.js"></script>
  </head>
  <body>
    <div class="navbar navbar-inverse navbar-fixed-top">
    	<div class="navbar-inner">
        	<div class="container">
          		<a class="brand" href="../index.html">Universal FQA</a>
          		<div class="nav-collapse collapse pull-right">
            		<ul class="nav">
            		</ul>
          		</div>
        	</div>
      	</div>
    </div>
	<br>
    <div class="container padding-top">
		<div class="nice_margins">
			<div class="row-fluid">
				<div class="span3">
					<img src="../images/blue-eyed.jpg" class="img-rounded">
					<br><br>
				</div>
				<div class="span9">
					<br>
					<p class="nice-text">You are now logged out. Thanks for using the Universal FQA Calculator!</p>
					<h2>Log back in:</h2>
					<label class="small-text">Email:</label>
					<input class="field" type="email" placeholder="hello@something.com" id="login_email" value="" size="23" />
					<label class="small-text">Password:</label>
					<input class="field" type="password" id="login_password" size="23" />
					<br><br><button class="btn btn-info" onClick="login();">Log In</button><br><br>
				</div>
			</div>
			
		</div>
    </div> 
    <br><br><br><br>
	<footer class="footer">
		<div class="container">
			<p><a href="http://universalFQA.org">universalFQA.org</a> | <a href="../about.html">About this site</a></p>
		</div>
	</footer>
  </body>
</html>