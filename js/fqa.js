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
			if (response.indexOf("success") !== -1) 
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
			if (response.indexOf("success") !== -1) 
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
			if (response.indexOf("success") !== -1) 
				alert("Changes saved!");
			else 
				alert(response);
		}
	});
}

function forgot_password() {
	$.ajax({
		url: "../php/forgot_password.php",
		type: "POST",
		data: {
			email: $("#login_email").val(),
		},
		success: function( response ) {
			if (response.indexOf("success") !== -1) 
				alert("A new temporary password has been emailed to you. Please check your spam filter if you don't see the email.");
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
	if (msg.indexOf("Error") == -1)
		window.location='../php/view_database.php?id=' + msg;
	else
		$( "#upload_error" ).html( msg );
}
 
function download_database() {
}

/**
 * ---------------------------------------------------------
 *
 * custom FQA databases functions
 *
 * ---------------------------------------------------------
 */
 
 function delete_custom_database( id ) {
 	if (confirm("Are you sure you want to delete this custom FQA database?")) {
		$.ajax({
			url: "../php/delete_custom_database.php",
			type: "GET",
			data: {
				id: id,
			},
			success: function( response ) {
				window.location='../php/databases.php';
			}
		});
 	}
 }