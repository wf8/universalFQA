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

/**
 * ---------------------------------------------------------
 *
 * site functions
 *
 * ---------------------------------------------------------
 */

function save_site_changes( site_id ) {
	if ($("#site_name").val().trim() == '') {
		alert("Please enter a site name.");
	} else {
		$.ajax({
			url: "/ajax/save_site_changes",
			type: "POST",
			data: {
				id: site_id,
				name: $("#site_name").val().trim(),
				notes: $("#site_notes").val().trim(),
				city: $("#site_city").val().trim(),
				county: $("#site_county").val().trim(),
				state: $("#site_state").val().trim(),
				country: $("#site_country").val().trim()
			},
			success: function( response ) { 
					alert("Changes saved!");
			}
		});
	}
}

function save_new_site() {
	if ($("#site_name").val().trim() == '') {
		alert("Please enter a site name.");
	} else {
		$.ajax({
			url: "/ajax/save_new_site",
			type: "POST",
			data: {
				name: $("#site_name").val().trim(),
				notes: $("#site_notes").val().trim(),
				city: $("#site_city").val().trim(),
				county: $("#site_county").val().trim(),
				state: $("#site_state").val().trim(),
				country: $("#site_country").val().trim()
			},
			success: function( response ) { 
				if (response.indexOf("Error") !== -1) 
					alert( response );
				else
					alert("New site saved!");
			}
		});
	}
}

/**
 * ---------------------------------------------------------
 *
 * inventory assessment functions
 *
 * ---------------------------------------------------------
 */
 
 function add_taxa_by_scientific_name() {
 	$.ajax({
		url: "/ajax/add_taxa_by_scientific_name",
		type: "POST",
		data: {
			species: $("#scientific_name").val()
		},
		success: function( response ) {
			if (response.indexOf("success") == -1) {
				alert("That scientific name is not found in this database.");
			} else {
				clear_add_fields();
				update_species_list();
			}
		}
	});
 }
 
function add_taxa_by_acronym() {
 	$.ajax({
		url: "/ajax/add_taxa_by_acronym",
		type: "POST",
		data: {
			species: $("#acronym").val()
		},
		success: function( response ) {
			if (response.indexOf("success") == -1) {
				alert("That acronym is not found in this database.");
			} else {
				clear_add_fields();
				update_species_list();
			}
		}
	});
}
 
function add_taxa_by_common_name() {
 	$.ajax({
		url: "/ajax/add_taxa_by_common_name",
		type: "POST",
		data: {
			species: $("#common_name").val()
		},
		success: function( response ) {
			if (response.indexOf("success") == -1) {
				alert("That common name is not found in this database.");
			} else {
				clear_add_fields();
				update_species_list();
			}
		}
	});
}

function add_taxa_by_list() {
 	$.ajax({
		url: "/ajax/add_taxa_by_list",
		type: "POST",
		data: {
			taxa: $("#taxa_to_add_list").val()
		},
		success: function( response ) {
				$( "#species_error" ).html( response );
				$("#taxa_to_add_list").val('');
				update_species_list();
		}
	});
}

function clear_add_fields() {
	$("#scientific_name").val('');
	$("#acronym").val('');
	$("#common_name").val('');
	$("#taxa_to_add_list").val('');
	$("#species_error").html('');
}

function update_species_list() {
	$.ajax({
		url: "/ajax/get_assessment_species_list",
		type: "POST",
		success: function( response ) {
			$( "#species_list" ).html( response );
		}
	});	
}

function remove_taxa() {
	if (confirm("Are you sure you want to remove the selected taxa?")) {
		var taxa_to_remove = new Array();
		$("input:checkbox[name=taxa]:checked").each( function() {
			taxa_to_remove.push($(this).val());
		});
	
		$.ajax({
			url: "/ajax/remove_taxa",
			type: "POST",
			data: {
				taxa: taxa_to_remove
			},
			success: function( response ) {
				clear_add_fields();
				update_species_list();
			}
		});
	}
}

function save_new_inventory() {

	var public_inv = $('input[name=publicOrPrivate]:checked', '#public_inventory').val();
	if ($("#site_select").length) {
		// user has selected an existing site
		$.ajax({
			url: "/ajax/save_new_inventory",
			type: "POST",
			data: {
				site_id: $("#site_select").val().trim(),
				month: $("#month").val().trim(),
				day: $("#day").val().trim(),
				year: $("#year").val().trim(),
				practitioner: $("#practitioner").val().trim(),
				latitude: $("#latitude").val().trim(),
				longitude: $("#longitude").val().trim(),
				public_inventory: public_inv,
				weather_notes: $("#weather_notes").val().trim(),
				duration_notes: $("#duration_notes").val().trim(),
				community_notes: $("#community_notes").val().trim(),
				other_notes: $("#other_notes").val().trim()
			},
			success: function( response ) { 
					window.location = '/view_inventory/' + response;
			}
		});
	} else {
		// user is creating a new site
		if ($("#site_name").val().trim() == '') {
			alert("Please enter a site name.");
		} else {
			$.ajax({
				url: "/ajax/save_new_inventory",
				type: "POST",
				data: {
					site_name: $("#site_name").val().trim(),
					site_city: $("#site_city").val().trim(),
					site_county: $("#site_county").val().trim(),
					site_state: $("#site_state").val().trim(),
					site_country: $("#site_country").val().trim(),
					
					month: $("#month").val().trim(),
					day: $("#day").val().trim(),
					year: $("#year").val().trim(),
					practitioner: $("#practitioner").val().trim(),
					latitude: $("#latitude").val().trim(),
					longitude: $("#longitude").val().trim(),
					public_inventory: public_inv,
					weather_notes: $("#weather_notes").val().trim(),
					duration_notes: $("#duration_notes").val().trim(),
					community_notes: $("#community_notes").val().trim(),
					other_notes: $("#other_notes").val().trim()
				},
				success: function( response ) { 
						window.location = '/view_inventory/' + response;
				}
			});
		}
	}
}

function delete_inventory( id ) {
 	if (confirm("Are you sure you want to delete this inventory assessment?")) {
		$.ajax({
			url: "/ajax/delete_inventory",
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

function update_inventory() {
	var public_inv = $('input[name=publicOrPrivate]:checked', '#public_inventory').val();
	$.ajax({
		url: "/ajax/update_inventory",
		type: "POST",
		data: {
			site_id: $("#site_select").val().trim(),
			month: $("#month").val().trim(),
			day: $("#day").val().trim(),
			year: $("#year").val().trim(),
			practitioner: $("#practitioner").val().trim(),
			latitude: $("#latitude").val().trim(),
			longitude: $("#longitude").val().trim(),
			public_inventory: public_inv,
			weather_notes: $("#weather_notes").val().trim(),
			duration_notes: $("#duration_notes").val().trim(),
			community_notes: $("#community_notes").val().trim(),
			other_notes: $("#other_notes").val().trim()
		},
		success: function( response ) { 
				window.location = '/view_inventory/' + response;
		}
	});
}

function change_inventory_fqa_db() {
 	if (confirm("Are you sure you want to change the FQA database? Some species may not be found in the new database.")) {
		$.ajax({
			url: "/ajax/change_inventory_fqa_db",
			type: "POST",
			data: {
				fqa_id: $("#fqa_select").val(),
			},
			success: function( response ) {
				$( "#species_error" ).html( response );
				update_species_list();
				// now populate the typeaheads with new fqa db data				
				$.ajax({
					url: "/ajax/get_typeahead_data",
					type: "POST",
					data: {
						fqa_id: $("#fqa_select").val(),
					},
					dataType: 'json',
					success: function( response ) { 
						$('#scientific_name').typeahead().data('typeahead').source = response['scientific_name'];
						$('#acronym').typeahead().data('typeahead').source = response['acronym'];
						$('#common_name').typeahead().data('typeahead').source = response['common_name'];
					},
				});		
			}
		});
 	}
}

/**
 * ---------------------------------------------------------
 *
 * transect assessment functions
 *
 * ---------------------------------------------------------
 */
 
 function update_quadrat_list() {
	$.ajax({
		url: "/ajax/get_assessment_quadrat_list",
		type: "POST",
		success: function( response ) {
			$( "#quadrat_list" ).html( response );
		}
	});	
}

function save_new_transect() {
	var public_inv = $('input[name=publicOrPrivate]:checked', '#public_inventory').val();
	if ($("#site_select").length) {
		// user has selected an existing site
		$.ajax({
			url: "/ajax/save_new_transect",
			type: "POST",
			data: {
				site_id: $("#site_select").val().trim(),
				month: $("#month").val().trim(),
				day: $("#day").val().trim(),
				year: $("#year").val().trim(),
				practitioner: $("#practitioner").val().trim(),
				latitude: $("#latitude").val().trim(),
				longitude: $("#longitude").val().trim(),
				public_inventory: public_inv,
				weather_notes: $("#weather_notes").val().trim(),
				duration_notes: $("#duration_notes").val().trim(),
				community_notes: $("#community_notes").val().trim(),
				other_notes: $("#other_notes").val().trim()
			},
			success: function( response ) { 
					window.location = '/view_transect/' + response;
			}
		});
	} else {
		// user is creating a new site
		if ($("#site_name").val().trim() == '') {
			alert("Please enter a site name.");
		} else {
			$.ajax({
				url: "/ajax/save_new_transect",
				type: "POST",
				data: {
					site_name: $("#site_name").val().trim(),
					site_city: $("#site_city").val().trim(),
					site_county: $("#site_county").val().trim(),
					site_state: $("#site_state").val().trim(),
					site_country: $("#site_country").val().trim(),
					
					month: $("#month").val().trim(),
					day: $("#day").val().trim(),
					year: $("#year").val().trim(),
					practitioner: $("#practitioner").val().trim(),
					latitude: $("#latitude").val().trim(),
					longitude: $("#longitude").val().trim(),
					public_inventory: public_inv,
					weather_notes: $("#weather_notes").val().trim(),
					duration_notes: $("#duration_notes").val().trim(),
					community_notes: $("#community_notes").val().trim(),
					other_notes: $("#other_notes").val().trim()
				},
				success: function( response ) { 
						window.location = '/view_transect/' + response;
				}
			});
		}
	}
}

function update_transect() {
	var public_inv = $('input[name=publicOrPrivate]:checked', '#public_inventory').val();
	$.ajax({
		url: "/ajax/update_transect",
		type: "POST",
		data: {
			site_id: $("#site_select").val().trim(),
			month: $("#month").val().trim(),
			day: $("#day").val().trim(),
			year: $("#year").val().trim(),
			practitioner: $("#practitioner").val().trim(),
			latitude: $("#latitude").val().trim(),
			longitude: $("#longitude").val().trim(),
			public_inventory: public_inv,
			weather_notes: $("#weather_notes").val().trim(),
			duration_notes: $("#duration_notes").val().trim(),
			community_notes: $("#community_notes").val().trim(),
			other_notes: $("#other_notes").val().trim()
		},
		success: function( response ) { 
				window.location = '/view_transect/' + response;
		}
	});
}

function delete_transect( id ) {
 	if (confirm("Are you sure you want to delete this transect assessment?")) {
		$.ajax({
			url: "/ajax/delete_transect",
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

function toggle_active( quadrat_name ) {
	$.ajax({
		url: "/ajax/toggle_active",
		type: "POST",
		data: {
			quadrat_name: quadrat_name,
		},
		success: function( response ) {
		}
	});
}

	function change_transect_fqa_db() {
 	if (confirm("Are you sure you want to change the FQA database? Some species may not be found in the new database.")) {
		$.ajax({
			url: "/ajax/change_transect_fqa_db",
			type: "POST",
			data: {
				fqa_id: $("#fqa_select").val(),
			},
			success: function( response ) {
				$( "#species_error" ).html( response );	
				update_quadrat_list();
			}
		});
 	}
}

/**
 * ---------------------------------------------------------
 *
 * quadrat functions
 *
 * ---------------------------------------------------------
 */

function save_new_quadrat() {
	$.ajax({
		url: "/ajax/save_new_quadrat",
		type: "POST",
		data: {
			name: $("#name").val().trim(),
			latitude: $("#latitude").val().trim(),
			longitude: $("#longitude").val().trim(),
			bare_ground: $("#bare_ground").val().trim(),
			water: $("#water").val().trim(),
		},
		success: function( response ) { 
			if (response.indexOf("success") == -1) {
				alert( response );
			} else {
				window.history.back(-1);
				update_quadrat_list();
			}
		}
	});
}

function save_edited_quadrat() {
	$.ajax({
		url: "/ajax/save_edited_quadrat",
		type: "POST",
		data: {
			name: $("#name").val().trim(),
			latitude: $("#latitude").val().trim(),
			longitude: $("#longitude").val().trim(),
			bare_ground: $("#bare_ground").val().trim(),
			water: $("#water").val().trim(),
		},
		success: function( response ) { 
			if (response.indexOf("success") == -1) {
				alert( response );
			} else {
				window.history.back(-1);
				update_quadrat_list();
			}
		}
	});
}

function add_quadrat_taxa_by_acronym() {
 	$.ajax({
		url: "/ajax/add_quadrat_taxa_by_acronym",
		type: "POST",
		data: {
			species: $("#acronym").val(),
			percent_cover: $("#acronym_percent_cover").val()
		},
		success: function( response ) {
			if (response.indexOf("success") == -1) {
				alert("That acronym is not found in this database.");
			} else {
				clear_add_fields_quadrat();
				update_quadrat_species_list();
			}
		}
	});
}
 
function add_quadrat_taxa_by_common_name() {
 	$.ajax({
		url: "/ajax/add_quadrat_taxa_by_common_name",
		type: "POST",
		data: {
			species: $("#common_name").val(),
			percent_cover: $("#common_name_percent_cover").val()
		},
		success: function( response ) {
			if (response.indexOf("success") == -1) {
				alert("That common name is not found in this database.");
			} else {
				clear_add_fields_quadrat();
				update_quadrat_species_list();
			}
		}
	});
}

function add_quadrat_taxa_by_scientific_name() {
 	$.ajax({
		url: "/ajax/add_quadrat_taxa_by_scientific_name",
		type: "POST",
		data: {
			species: $("#scientific_name").val(),
			percent_cover: $("#scientific_name_percent_cover").val()
		},
		success: function( response ) {
			if (response.indexOf("success") == -1) {
				alert("That scientific name is not found in this database.");
			} else {
				clear_add_fields_quadrat();
				update_quadrat_species_list();
			}
		}
	});
}

function add_quadrat_taxa_by_list() {
 	$.ajax({
		url: "/ajax/add_quadrat_taxa_by_list",
		type: "POST",
		data: {
			taxa: $("#taxa_to_add_list").val()
		},
		success: function( response ) {
				$( "#species_error" ).html( response );
				$("#taxa_to_add_list").val('');
				update_quadrat_species_list();
		}
	});
}

function update_quadrat_species_list() {
	$.ajax({
		url: "/ajax/get_quadrat_species_list",
		type: "POST",
		success: function( response ) {
			$( "#species_list" ).html( response );
		}
	});	
}

function remove_quadrat_taxa() {
	if (confirm("Are you sure you want to remove the selected taxa?")) {
		var taxa_to_remove = new Array();
		$("input:checkbox[name=taxa]:checked").each( function() {
			taxa_to_remove.push($(this).val());
		});
	
		$.ajax({
			url: "/ajax/remove_quadrat_taxa",
			type: "POST",
			data: {
				taxa: taxa_to_remove
			},
			success: function( response ) {
				clear_add_fields_quadrat();
				update_quadrat_species_list();
			}
		});
	}
}

function update_quadrat_taxa( id, percent_cover ) {
 	$.ajax({
		url: "/ajax/update_quadrat_taxa",
		type: "POST",
		data: {
			id: id,
			percent_cover: percent_cover
		},
		success: function( response ) {
		}
	});
}

function clear_add_fields_quadrat() {
	$("#scientific_name").val('');
	$("#acronym").val('');
	$("#common_name").val('');
	$("#scientific_name_percent_cover").val('');
	$("#acronym_percent_cover").val('');
	$("#common_name_percent_cover").val('');
	$("#taxa_to_add_list").val('');
	$("#species_error").html('');
}

function delete_quadrat( id ) {
 	if (confirm("Are you sure you want to delete this quadrat?")) {
		$.ajax({
			url: "/ajax/delete_quadrat",
			type: "POST",
			data: {
				id: id,
			},
			success: function( response ) {
				update_quadrat_list();
			}
		});
 	}
}

/**
 * ---------------------------------------------------------
 *
 *  utility functions
 *
 * ---------------------------------------------------------
 */

function warn_user() {
	alert('Please either click Save or Cancel before navigating away from this page.');
}