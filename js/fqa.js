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

				alert("successful registration and login");
				$("#toggle a").toggle();
				$("div#panel").slideUp("slow");

//				loadKmlTree(response.substring(14));
//				document.getElementById("loginMenu").innerHTML = "Logout";
//				if ( isAdmin() )
//					document.getElementById("adminMenu").style.visibility = "visible";
//				closeAllPanels()

			} else {
//				document.getElementById("loginError").value = response;
				alert("registration error: " + response);
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
				alert("successful logout");
	//			loadKmlTree(-1);
	//			document.getElementById("loginMenu").innerHTML = "Login";
	//			document.getElementById("adminMenu").style.visibility = "hidden";
	//			closeAllPanels();
				// turn off activity monitor
	//			$('#activity_loading').activity(false);
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

				alert("successful login");
				$("#toggle a").toggle();
				$("div#panel").slideUp("slow");

//				loadKmlTree(response.substring(14));
//				document.getElementById("loginMenu").innerHTML = "Logout";
//				if ( isAdmin() )
//					document.getElementById("adminMenu").style.visibility = "visible";
//				closeAllPanels()

			} else {
//				document.getElementById("loginError").value = response;
				alert("login error: " + response);
			}
		}
	}			
	ajaxRequest.open("POST", url, true);				
	// Send the proper header information along with the request 
	ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	ajaxRequest.send(params);
}