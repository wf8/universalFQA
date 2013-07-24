/**
 * ---------------------------------------------------------
 *
 * login / register / change account functions
 *
 * ---------------------------------------------------------
 */
function register() {
	$.ajax({
		url: "/ajax/register_user",
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
				window.location='/view_assessments';
			else 
				alert(response);
		}
	});
}

function login() {
	$.ajax({
		url: "/ajax/login_user",
		type: "POST",
		data: {
			email: $("#login_email").val(),
			password: $("#login_password").val(),
		},
		success: function( response ) {
			if (response.indexOf("success") !== -1) {
				window.location = '/view_assessments';
			} else 
				alert(response);
		}
	});
}

function save_account_changes() {
	$.ajax({
		url: "/ajax/change_user_info",
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
		url: "/ajax/forgot_password",
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
		window.location='/view_database/' + msg;
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
			url: "/ajax/delete_custom_database",
			type: "POST",
			data: {
				id: id,
			},
			success: function( response ) {
				window.location='/view_databases';
			}
		});
 	}
}

function delete_custom_taxa( id ) {
 	if (confirm("Are you sure you want to delete this taxa?")) {
		$.ajax({
			url: "/ajax/delete_custom_taxa",
			type: "POST",
			data: {
				id: id,
			},
			success: function( response ) {
				location.reload(true);
			}
		});
 	}
}
 
function done_creating_custom_db() {
	if ( $("#customized_fqa_name").val() == "" )
		alert("Please enter a name for the customized FQA database.");
	else if ( $("#customized_fqa_description").val() == "" ) 
		alert("Please enter a description for the customized FQA database.");
	else
		window.location='/view_databases';
}

function custom_fqa_update( custom_fqa_id ) {
	$.ajax({
		url: "/ajax/custom_fqa_update",
		type: "POST",
		data: {
			id: custom_fqa_id,
			name: $("#customized_fqa_name").val(),
			description: $("#customized_fqa_description").val()
		},
		success: function( response ) {
		}
	});
}

function custom_taxa_update( element_id, col_name, custom_taxa_id ) {
	$.ajax({
		url: "/ajax/custom_taxa_update",
		type: "POST",
		data: {
			id: custom_taxa_id,
			col_name: col_name,
			value: $("#" + element_id).val(),
		},
		success: function( response ) {
			if (response.indexOf("success") == -1)
				alert(response);
		}
	});
}

function new_custom_taxa( original_fqa_id, custom_fqa_id ) {
	$.ajax({
		url: "/ajax/new_custom_taxa",
		type: "POST",
		data: {
			custom_fqa_id: custom_fqa_id,
			original_fqa_id: original_fqa_id,
			scientific_name: $("#new_scientific_name").val(),
			family: $("#new_family").val(),
			acronym: $("#new_acronym").val(),
			native: $("#new_native").val(),
			c_o_c: $("#new_c").val(),
			c_o_w: $("#new_w").val(),
			physiognomy: $("#new_physiognomy").val(),
			duration: $("#new_duration").val(),
			common_name: $("#new_common_name").val(),
		},
		success: function( response ) {
			if (response.indexOf("success") == -1)
				alert(response);
			else
				location.reload(true);
		}
	});
}

function check_form( url ) {
	if ( $("#customized_fqa_name").val() == "" )
		alert("Please enter a name for the customized FQA database.");
	else if ( $("#customized_fqa_description").val() == "" ) 
		alert("Please enter a description for the customized FQA database.");
	else
		window.location = url;
}


/**
 * ---------------------------------------------------------
 *
 * new assessment functions
 *
 * ---------------------------------------------------------
 */
 
