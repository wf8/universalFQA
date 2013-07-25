    <div class="container padding-top">
		<div class="nice_margins">
			<div class="row-fluid">
				<div class="span1">
					<img src="/assets/images/blue-eyed.jpg" width="70" height="105" class="img-rounded">
					<br><br>
				</div>
				<div class="span11">
					<br>
					<h1>New Inventory Assessment</h1>
					<button class="btn btn-info" onclick="javascript:window.location = '/view_inventory';return false;">Save and View Results</button> 
					<button class="btn btn-info" onclick="javascript:window.location = '/view_assessments';return false;">Cancel</button><br>
				</div>
			</div>
			<br>
			<div class="row-fluid">
				<div class="span6">
					<p>
					<label class="small-text">Month: </label>
					<select>
<?php 	$current_month = date("m");
		$i = 1;
		while($i < 13) {
			if ($i == $current_month)
 				echo '<option selected>'.$i.'</option>';
 			else
 				echo '<option>'.$i.'</option>';
 			$i++;
 		}
?>
					</select>
					<label class="small-text">Day: </label>
					<select>
<?php 	$current_day = date("j");
		$i = 1;
		while($i < 32) {
			if ($i == $current_day)
 				echo '<option selected>'.$i.'</option>';
 			else
 				echo '<option>'.$i.'</option>';
 			$i++;
 		}
?>
					</select>
					<label class="small-text">Year: </label>
					<select>
<?php 	$current_year = date("Y");
		$i = $current_year;
		while($i > 1979) {
			if ($i == $current_year)
 				echo '<option selected>'.$i.'</option>';
 			else
 				echo '<option>'.$i.'</option>';
 			$i--;
 		}
?>
					</select>
				</div>	
				<?php require('../views/site_selector.php'); ?>		
			</div>
			<br>
			<div class="row-fluid">
				<div class="span6">
					<label class="small-text">Practitioner:</label>
					<input class="input-medium" type="text" id="change_first_name" value="" maxlength="256" /><br>
 					<label class="small-text">Latitude:</label>
					<input class="input-medium" type="text" id="change_first_name" value="" maxlength="256" /><br>
 					<label class="small-text">Longitude:</label>
					<input class="input-medium" type="text" id="change_first_name" value="" maxlength="256" /><br>
					<br>
					<label class="radio">
  						<input type="radio" name="publicOrPrivate" id="public_inventory" value="public" checked>
  						Public (viewable by any users of this site)
					</label>
					<label class="radio">
  						<input type="radio" name="publicOrPrivate" id="private_inventory" value="private">
  						Private (viewable only by you)
					</label>
 				</div>
 				<div class="span6">
 					<label class="small-text">Weather Notes:</label>
					<textarea rows="3" id="site_location3"></textarea><br>
 					<label class="small-text">Duration Notes:</label>
					<textarea rows="3" id="site_location3"></textarea><br>
 					<label class="small-text">Community Type Notes:</label>
					<textarea rows="3" id="site_location4"></textarea><br>
 					<label class="small-text">Other Notes:</label>
					<textarea rows="3" id="site_location5"></textarea><br>
 				</div>
 			</div>
			<br>
			<div class="row-fluid">
				<div class="span12">
				<h3>FQA Database: Chicago, 1994</h3>
				<br>
				<h4>To Add Species Individually:</h4>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span4">
					<label class="small-text">Search by Scientific Name:</label>
					<div class="input-append">
 					 	<input class="input-medium" id="scientific_name" type="text" data-provide="typeahead" data-items="10" autocomplete="off" data-source='<?php echo json_encode($scientific_names) ?>'>
  						<button class="btn btn-info" type="button" onclick="javascript:add_taxa_by_scientific_name();return false;">Add</button>
					</div>
				</div>
				<div class="span4">
					<label class="small-text">Search by Acronym:</label>
 					<div class="input-append">
 					 	<input class="input-medium" id="acronym" type="text" data-provide="typeahead" data-items="10" autocomplete="off" data-source='<?php echo json_encode($acronyms) ?>'>
  						<button class="btn btn-info" type="button" onclick="javascript:add_taxa_by_acronym();return false;">Add</button>
					</div>
				</div>
				<div class="span4">
					<label class="small-text">Search by Common Name:</label>
					<div class="input-append">
 					 	<input class="input-medium" id="common_name" type="text" data-provide="typeahead" data-items="10" autocomplete="off" data-source='<?php echo json_encode($common_names) ?>'>
  						<button class="btn btn-info" type="button" onclick="javascript:add_taxa_by_common_name();return false;">Add</button>
					</div>
				</div>	
			</div>
			<div class="row-fluid">
				<div class="span12">
				<h4>To Add Species In Bulk:</h4>
				List each species (by scientific name, acronym, or common name) separated by a comma. For example: "Acorus calamus, Alisma subcordatum, Anemone virginiana, etc."<br>
				<textarea class="input-xxlarge" rows="3" id="taxa_to_add_list"></textarea><br>
				<button class="btn btn-info" type="button" onclick="javascript:add_taxa_by_list();return false;">Add Species</button><br>
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
					<button class="btn btn-info" onclick="javascript:remove_taxa();return false;">Remove Selected Species</button>
				</div>
			</div>
			<br><br>
			<div class="row-fluid">
				<div class="span12">				
					<h4>Finished?</h4>
					<button class="btn btn-info" onclick="javascript:window.location = '/view_inventory';return false;">Save and View Results</button> 
					<button class="btn btn-info" onclick="javascript:window.location = '/view_assessments';return false;">Cancel</button><br>
				</div>
			</div>
		</div>
    </div> 
    <br><br>