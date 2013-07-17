/**
 * ---------------------------------------------------------
 *
 * login / register / change account functions
 *
 * ---------------------------------------------------------
 */
function register() {
	$.ajax({
		url: "../php/register_user.php",
		type: "POST",
		data: {
			email: $("#register_email").val(),
			first_name: $("#register_first_name").val(),
			last_name: $("#register_last_name").val(),
			password1: $("#register_password1").val(),
			password2: $("#register_password2").val()
		},
		success: function( response ) {
			if (response.indexOf("success") != -1) 
				window.location='../php/assessments.php';
			else 
				alert(response);
		}
	});
}

function login() {
	$.ajax({
		url: "../php/login_user.php",
		type: "POST",
		data: {
			email: $("#login_email").val(),
			password: $("#login_password").val(),
		},
		success: function( response ) {
			if (response.indexOf("success") != -1) 
				window.location='../php/assessments.php';
			else 
				alert(response);
		}
	});
}

function save_account_changes() {
	$.ajax({
		url: "../php/change_user_info.php",
		type: "POST",
		data: {
			email: $("#change_email").val(),
			first_name: $("#change_first_name").val(),
			last_name: $("#change_last_name").val(),
			password1: $("#change_password1").val(),
			password2: $("#change_password2").val()
		},
		success: function( response ) {
			if (response.indexOf("success") != -1) 
				alert("Changes saved!");
			else 
				alert(response);
		}
	});
}

/**
 * ---------------------------------------------------------
 *
 * upload/download FQA databases functions
 *
 * ---------------------------------------------------------
 */
 
 function start_database_upload() {
	$( "#upload_error" ).html( "Uploading..." );
}
function stop_database_upload( msg ){	
	$( "#upload_error" ).html( msg );
}
 
function download_database() {
}