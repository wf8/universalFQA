/**
 * ---------------------------------------------------------
 * login/logout/register functions
 *
 * ---------------------------------------------------------
 */
function register() {
	//setup new AJAX request 
	var ajaxRequest  = new XMLHttpRequest();
	// prepare POST parameters
	var email = document.getElementById("register_email").value;
	var last_name = document.getElementById("register_last_name").value;
	var first_name = document.getElementById("register_first_name").value;
	var password1 = document.getElementById("register_password1").value;
	var password2 = document.getElementById("register_password2").value;
	
	var params = "email=" + email + "&password1=" + password1 + "&password2=" + password2 + "&last_name=" + last_name + "&first_name=" + first_name;
	// send the new request 
	var url = "php/register.php";
	ajaxRequest.onreadystatechange=function() {
		if (ajaxRequest.readyState==4 && ajaxRequest.status==200) {
			var response = ajaxRequest.responseText;
			if (response.indexOf("success") != -1) {

				$("#toggle a").toggle();
				$("div#panel").slideUp("slow");
				clear_login_forms();
				document.getElementById("toggle").innerHTML = '<a id="log_out" onClick="logout();" href="#">Log Out</a>';

			} else {
				alert(response);
			}
		}
	}			
	ajaxRequest.open("POST", url, true);				
	// Send the proper header information along with the request 
	ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	ajaxRequest.send(params);
}

function logout() {
	//setup new AJAX request 
	var ajaxRequest  = new XMLHttpRequest();
	var params = "";
	var url = "php/logout.php";	
	ajaxRequest.onreadystatechange=function() {
		if (ajaxRequest.readyState==4 && ajaxRequest.status==200) {
			var response = ajaxRequest.responseText;
			if (response == "success logout") {				
				document.getElementById("toggle").innerHTML = '<a id="open" class="open" href="#">Log In | Register</a><a id="close" style="display: none;" class="close" href="#">Close Panel</a>';

				$("#open").click(function(){
					$("div#panel").slideDown("slow");
				});	

				$("#close").click(function(){
					$("div#panel").slideUp("slow");	
				});		
	
	
				
				$("#toggle a").click(function () {

					$("#toggle a").toggle();
	
				});	
			}
		}
	}		
	ajaxRequest.open("POST", url, true);				
	// Send the proper header information along with the request 
	ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	// send the new request 
	ajaxRequest.send(params);
}

function login() {
	//setup new AJAX request 
	var ajaxRequest  = new XMLHttpRequest();
	// prepare POST parameters
	var email = document.getElementById("login_email").value;
	var login_password = document.getElementById("login_password").value;
	var params = "email=" + email + "&password=" + login_password;
	// send the new request 
	var url = "php/login.php";
	ajaxRequest.onreadystatechange=function() {
		if (ajaxRequest.readyState==4 && ajaxRequest.status==200) {
			var response = ajaxRequest.responseText;
			if (response.indexOf("success") != -1) {

				$("#toggle a").toggle();
				$("div#panel").slideUp("slow");
				clear_login_forms();
				document.getElementById("toggle").innerHTML = '<a id="log_out" onClick="logout();" href="#">Log Out</a>';

			} else {
				alert(response);
			}
		}
	}			
	ajaxRequest.open("POST", url, true);				
	// Send the proper header information along with the request 
	ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	ajaxRequest.send(params);
}

function clear_login_forms() {
	document.getElementById("register_email").value = "";
	document.getElementById("register_last_name").value = "";
	document.getElementById("register_first_name").value = "";
	document.getElementById("register_password1").value = "";
	document.getElementById("register_password2").value = "";
	document.getElementById("login_email").value = "";
	document.getElementById("login_password").value = "";
}