    <div class="container padding-top">
		<div class="nice_margins">
			<div class="row-fluid">
				<div class="span1">
					<img src="/assets/images/blue-eyed.jpg" width="70" height="105" class="img-rounded">
					<br><br>
				</div>
				<div class="span11">
					<br>
					<h1>New Quadrat</h1>
					<button class="btn btn-info" onclick="javascript:save_new_quadrat();return false;">Save</button> 
					<button class="btn btn-info" onclick="javascript:window.history.back(-1);return false;">Cancel</button><br>
				</div>
			</div>
			<br>
			<div class="row-fluid">
				<div class="span12">
					<label class="small-text">Quadrat Number or Name: <font class="red">*</font></label>
					<input class="field" type="text" id="name" value="" maxlength="256" required />
 					<label class="small-text">Latitude:</label>
					<input class="field" type="text" id="latitude" value="" maxlength="256" /><br>
 					<label class="small-text">Longitude:</label>
					<input class="field" type="text" id="longitude" value="" maxlength="256" /><br>
					<label class="small-text">% Bare Ground:</label>
					<input class="field" type="text" id="bare_ground" value="" maxlength="3" /><br>
 					<label class="small-text">% Water:</label>
					<input class="field" type="text" id="water" value="" maxlength="3" /><br>						
				</div>
			</div>
			<br>

			<div class="row-fluid">
				<div class="span12">
				<h4>To Add Species Individually:</h4>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span4">
					<label class="small-text">Search by Scientific Name:</label>
					<div class="input-append">
 					 	<input class="input-medium" id="scientific_name" type="text" data-provide="typeahead" data-items="10" autocomplete="off" data-source='<?php echo json_encode($scientific_names) ?>'>
  						<button class="btn btn-info" type="button" onclick="javascript:add_quadrat_taxa_by_scientific_name();return false;">Add</button>
					</div>
				</div>
				<div class="span4">
					<label class="small-text">Search by Acronym:</label>
 					<div class="input-append">
 					 	<input class="input-medium" id="acronym" type="text" data-provide="typeahead" data-items="10" autocomplete="off" data-source='<?php echo json_encode($acronyms) ?>'>
  						<button class="btn btn-info" type="button" onclick="javascript:add_quadrat_taxa_by_acronym();return false;">Add</button>
					</div>
				</div>
				<div class="span4">
					<label class="small-text">Search by Common Name:</label>
					<div class="input-append">
 					 	<input class="input-medium" id="common_name" type="text" data-provide="typeahead" data-items="10" autocomplete="off" data-source='<?php echo json_encode($common_names) ?>'>
  						<button class="btn btn-info" type="button" onclick="javascript:add_quadrat_taxa_by_common_name();return false;">Add</button>
					</div>
				</div>	
			</div>
			<div class="row-fluid">
				<div class="span12">
				<h4>To Add Species In Bulk:</h4>
				List each species (by scientific name, acronym, or common name) separated by a comma. For example: "Acorus calamus, Alisma subcordatum, Anemone virginiana, etc."<br>
				<textarea class="input-xxlarge" rows="3" id="taxa_to_add_list"></textarea><br>
				<button class="btn btn-info" type="button" onclick="javascript:add_quadrat_taxa_by_list();return false;">Add Species</button><br>
				</div>
				<div id="species_error" class="red"></div>
			</div>
			<br>
			<div class="row-fluid">
				<div class="span12">	
					<h4>To Remove Species:</h4>
					Select the species to remove and click remove at the bottom of the list.<br>
					<br>
					<div id="species_list">
<table class="table table-hover">
<tr>
<td></td>
<td><strong>Scientific Name</strong></td>
<td><strong>Family</strong></td>
<td><strong>Acronym</strong></td>
<td><strong>Native?</strong></td>
<td><strong>C</strong></td>
<td><strong>W</strong></td>
<td><strong>Physiognomy</strong></td>
<td><strong>Duration</strong></td>
<td><strong>Common Name</strong></td>
</tr>                    
<tr>
<td colspan=10>You have not entered any species yet.</td>
</tr>
</table>
					</div>
					<button class="btn btn-info" onclick="javascript:remove_quadrat_taxa();return false;">Remove Selected Species</button>
				</div>
			</div>
			<br><br>
			<div class="row-fluid">
				<div class="span12">				
					<h4>Finished?</h4>
					<button class="btn btn-info" onclick="javascript:save_new_quadrat();return false;">Save</button> 
					<button class="btn btn-info" onclick="javascript:window.history.back(-1);return false;">Cancel</button><br>
				</div>
			</div>
		</div>
    </div> 
    <br><br>