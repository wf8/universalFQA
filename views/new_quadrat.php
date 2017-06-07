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
					<button class="btn btn-info" onclick="javascript:save_new_quadrat();">Save</button> 
					<button class="btn btn-info" onclick="javascript:window.history.back(-1);return false;">Cancel</button><br>
				</div>
			</div>
			<br>
			<div class="row-fluid">
				<div class="span12">
					<form id="quadrat_type">
						<label class="radio">
							<input type="radio" name="quadratType" value="0" checked>
							Quadrat/Subplot
						</label>
						<label class="radio">
							<input type="radio" name="quadratType" value="2">
							Outside Transect/Plot
						</label>
						<label class="radio">
							<input type="radio" name="quadratType" value="3">
							Rest of Transect/Plot
						</label>
					</form>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span12">
					<label class="small-text">Quadrat Number or Name: <font class="red">*</font></label>
					<input class="field" type="text" id="name" value="" maxlength="256" required />
 					<label class="small-text">Latitude: (optional)</label>
					<input class="field" type="text" id="latitude" value="" maxlength="256" /><br>
 					<label class="small-text">Longitude: (optional)</label>
					<input class="field" type="text" id="longitude" value="" maxlength="256" /><br>
					<label class="small-text">% Bare Ground: (optional)</label>
					<input class="field" type="text" id="bare_ground" value="" maxlength="3" /><br>
 					<label class="small-text">% Water: (optional)</label>
					<input class="field" type="text" id="water" value="" maxlength="3" />
				</div>
			</div>
			<br>

			<div class="row-fluid">
			  <div class="span12">
					<h4>Transect/Plot Cover Method:</h4>
					<input class="input-medium" id="cover_method_name" type="text" value='<?php echo $assessment->cover_method_name; ?>' disabled>
					<br>
					<br>		
				</div>
			</div>
			<div class="row-fluid">
				<div class="span12">
				<h4>To Add Species Individually:</h4>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span4">
					<form class="form-inline">
						<input class="input-medium" id="scientific_name" type="text" placeholder="Scientific Name" data-provide="typeahead" data-items="10" autocomplete="off" data-source='<?php echo json_encode($scientific_names) ?>'>
						<div class="input-append">
							<?php
								$selected_cover_method = $assessment->cover_method_name;
								if ($selected_cover_method === UFQA_DEFAULT_COVER_METHOD) {
									echo '<input class="input-mini" id="scientific_name_percent_cover" type="text" placeholder="% Cover">';
								} else {
									echo '<input class="input-mini" id="scientific_name_percent_cover" type="text" placeholder="% Cover" disabled>';					
								}
							?>
							<select class="input-medium" id="sciname_cover_range_midpoint">
							<?php
								$cover_methods = Quadrat::get_cover_methods();
							  $selected_cover_method = $assessment->cover_method_name;
								$selected_cover_ranges = $cover_methods[$selected_cover_method];
								echo '<option disabled>'. UFQA_COVER_RANGE_MIDPOINT_DEFAULT . '</option>';
								foreach ($selected_cover_ranges as $cover_method_range) {
									echo '<option>' . $cover_method_range['display'] . '</option>';
								}
							?>
							</select>
							<button class="btn btn-info" type="button" onclick="javascript:add_quadrat_taxa_by_scientific_name();return false;">Add</button>
						</div>
					</form>
				</div>
				<div class="span4">
					<form class="form-inline">
						<input class="input-medium" id="acronym" type="text" placeholder="Acronym" data-provide="typeahead" data-items="10" autocomplete="off" data-source='<?php echo json_encode($acronyms) ?>'>
						<div class="input-append">
							<?php
								$selected_cover_method = $assessment->cover_method_name;
								if ($selected_cover_method === UFQA_DEFAULT_COVER_METHOD) {
									echo '<input class="input-mini" id="acronym_percent_cover" type="text" placeholder="% Cover">';
								} else {
									echo '<input class="input-mini" id="acronym_percent_cover" type="text" placeholder="% Cover" disabled>';					
								}
							?>
							<select class="input-medium" id="acronym_cover_range_midpoint">
							<?php
								$cover_methods = Quadrat::get_cover_methods();
							  $selected_cover_method = $assessment->cover_method_name;
								$selected_cover_ranges = $cover_methods[$selected_cover_method];
								echo '<option disabled>'. UFQA_COVER_RANGE_MIDPOINT_DEFAULT . '</option>';
								foreach ($selected_cover_ranges as $cover_method_range) {
									echo '<option>' . $cover_method_range['display'] . '</option>';
								}
							?>
							</select>
							<button class="btn btn-info" type="button" onclick="javascript:add_quadrat_taxa_by_acronym();return false;">Add</button>
						</div>
					</form>
				</div>
				<div class="span4">
					<form class="form-inline">
						<input class="input-medium" id="common_name" type="text" placeholder="Common Name" data-provide="typeahead" data-items="10" autocomplete="off" data-source='<?php echo json_encode($common_names) ?>'>
						<div class="input-append">
							<?php
								$selected_cover_method = $assessment->cover_method_name;
								if ($selected_cover_method === UFQA_DEFAULT_COVER_METHOD) {
									echo '<input class="input-mini" id="common_name_percent_cover" type="text" placeholder="% Cover">';
								} else {
									echo '<input class="input-mini" id="common_name_percent_cover" type="text" placeholder="% Cover" disabled>';					
								}
							?>
							<select class="input-medium" id="common_cover_range_midpoint">
							<?php
								$cover_methods = Quadrat::get_cover_methods();
							  $selected_cover_method = $assessment->cover_method_name;
								$selected_cover_ranges = $cover_methods[$selected_cover_method];
								echo '<option disabled>'. UFQA_COVER_RANGE_MIDPOINT_DEFAULT . '</option>';
								foreach ($selected_cover_ranges as $cover_method_range) {
									echo '<option>' . $cover_method_range['display'] . '</option>';
								}
							?>
							</select>
							<button class="btn btn-info" type="button" onclick="javascript:add_quadrat_taxa_by_common_name();return false;">Add</button>
						</div>
					</form>
				</div>	
			</div>

            <div class="row-fluid">
                <div class="span12">
                <h4>To Add Species In Bulk:</h4>
                List each species and their percent coverage separated by a comma. For example: "Acorus calamus, 20, Alisma subcordatum, 15, Anemone virginiana, 5, etc."<br>
                <label class="radio">
                    <input type="radio" name="list_type" value="scientific_name" checked>
                    List of scientific names
                </label>
                <label class="radio">
                    <input type="radio" name="list_type" value="acronym">
                    List of acronyms
                </label>
                <label class="radio">
                    <input type="radio" name="list_type" value="common_name">
                    List of common names
                </label>
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
<td><strong>% Cover</strong></td>
<td><strong>Cover Range/Midpoint</strong></td>
<td><strong>Native?</strong></td>
<td><strong>C</strong></td>
<td><strong>W</strong></td>
<td><strong>Physiognomy</strong></td>
<td><strong>Duration</strong></td>
<td><strong>Common Name</strong></td>
</tr>                    
<tr>
<td colspan=11>You have not entered any species yet.</td>
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
					<button class="btn btn-info" onclick="javascript:save_new_quadrat();">Save</button> 
					<button class="btn btn-info" onclick="javascript:window.history.back(-1);return false;">Cancel</button><br>
				</div>
			</div>
		</div>
    </div> 
    <br><br>
