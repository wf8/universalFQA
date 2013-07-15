/**
 * ---------------------------------------------------------
 * login/logout/register/change account functions
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
	var url = "../php/register_user.php";
	ajaxRequest.onreadystatechange=function() {
		if (ajaxRequest.readyState==4 && ajaxRequest.status==200) {
			var response = ajaxRequest.responseText;
			if (response.indexOf("success") != -1) {
				window.location='../php/assessments.php';
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

function login() {
	//setup new AJAX request 
	var ajaxRequest  = new XMLHttpRequest();
	// prepare POST parameters
	var email = document.getElementById("login_email").value;
	var login_password = document.getElementById("login_password").value;
	var params = "email=" + email + "&password=" + login_password;
	// send the new request 
	var url = "../php/login_user.php";
	ajaxRequest.onreadystatechange=function() {
		if (ajaxRequest.readyState==4 && ajaxRequest.status==200) {
			var response = ajaxRequest.responseText;
			if (response.indexOf("success") != -1) {
				window.location='../php/assessments.php';
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

function save_account_changes() {
	//setup new AJAX request 
	var ajaxRequest  = new XMLHttpRequest();
	// prepare POST parameters
	var email = document.getElementById("change_email").value;
	var last_name = document.getElementById("change_last_name").value;
	var first_name = document.getElementById("change_first_name").value;
	var password1 = document.getElementById("change_password1").value;
	var password2 = document.getElementById("change_password2").value;
	var params = "email=" + email + "&password1=" + password1 + "&password2=" + password2 + "&last_name=" + last_name + "&first_name=" + first_name;
	// send the new request 
	var url = "../php/change_user_info.php";
	ajaxRequest.onreadystatechange=function() {
		if (ajaxRequest.readyState==4 && ajaxRequest.status==200) {
			var response = ajaxRequest.responseText;
			if (response.indexOf("success") != -1) {
				alert("Changes saved!");
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

/**
 * ---------------------------------------------------------
 * upload/download FQA databases functions
 *
 * ---------------------------------------------------------
 */
 
 function start_database_upload() {
	$( "#upload_error" ).html( "Uploading..." );
	return true;
}
function stop_database_upload( msg ){	
	if ( msg.indexOf("Error:") != -1 ) {
		$( "#upload_error" ).html( msg );
	} else {
		$( "#upload_error" ).html( "Data successfully uploaded." );
	} 
}
 
function download_database() {
}