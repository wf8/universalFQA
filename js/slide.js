$(document).ready(function() {
	
	// Expand Panel
	$("#open").click(function(){
		$("div#panel").slideDown("slow");
	
	});	
	
	// Collapse Panel
	$("#close").click(function(){
		$("div#panel").slideUp("slow");	
	});		
	
	// Log Out
	$("#log_out").click(function(){
		logout();
		//$("div#panel").slideUp("slow");	
	});
	
	// Switch buttons from "Log In | Register" to "Close Panel" on click
	$("#toggle a").click(function () {
		// if logged out
		$("#toggle a").toggle();
		// if logged in show "Log Out"
		
	});		
		
});