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
				<div class="span2">
					<img src="../images/blue-eyed.jpg" class="img-rounded">
					<br><br>
				</div>
				<div class="span10">
					<br>
					<h1>Welcome to the Universal FQA Calculator</h1>
					<p class="nice-text">To save site inventory and transect FQA studies, or to upload and share regional FQA databases you will need to create a free account.</p>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span6">
					<h2>Already have an account?</h2>
					<label class="small-text">Email:</label>
					<input class="field" type="email" placeholder="hello@something.com" id="login_email" value="" size="23" />
					<label class="small-text">Password:</label>
					<input class="field" type="password" id="login_password" size="23" />
					<br><br><button class="btn btn-info" onClick="login();">Log In</button><br><br>
					<a class="lost-pwd" href="#">Lost your password?</a><br><br>
				</div>
				<div class="span6">
					<h2>Create new account:</h2>
					<label class="small-text">First name:</label>
					<input class="field" type="text" id="register_first_name" value="" size="23" />
					<label class="small-text">Last name:</label>
					<input class="field" type="text" id="register_last_name" value="" size="23" />
					<label class="small-text">Email:</label>
					<input class="field" type="email" placeholder="hello@something.com" id="register_email" size="23" />
					<label class="small-text">Password:</label>
					<input class="field" type="password" id="register_password1" size="23" />
					<label class="small-text">Password (again):</label>
					<input class="field" type="password" id="register_password2" size="23" /><br><br>
					<button class="btn btn-info" onClick="register();">Register</button> 
				</div>
			</div>
			<br><br>
		</div>
		<footer class="footer">
			<div class="container">
        		<p><a href="http://universalFQA.org">universalFQA.org</a> | <a href="../about.html">About this site</a></p>
      		</div>
      	</footer>
    </div> 
  </body>
</html>