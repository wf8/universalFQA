	<script> 
		$(document).ready( function () { 
			update_quadrat_species_list(); 
			$('input[name=quadratType]', '#quadrat_type').click(function(){
				var id = $('input[name=quadratType]:checked', '#quadrat_type').val();
				var fixed_quadrat_types = ["<?php echo UFQA_FULL_PLOT; ?>", "<?php echo UFQA_OUTSIDE_PLOT; ?>", "<?php echo UFQA_REST_OF_PLOT; ?>"];
				var fixed_quadrat_names = ["", "FullTransectPlot", "OutsideTransectPlot", "RestOfTransectPlot"];
				if (jQuery.inArray(id, fixed_quadrat_types) >= 0) {
					$('#name').val(fixed_quadrat_names[id]);
					$('#name').attr("disabled",true);
				} else {
					$('#name').val("");
					$('#name').attr("disabled",false);
				}
			});
		});
	</script>
	<div class="container padding-top">
		<div class="nice_margins">
			<div class="row-fluid">
				<div class="span1">
					<img src="/assets/images/blue-eyed.jpg" width="70" height="105" class="img-rounded">
					<br><br>
				</div>
				<div class="span11">
					<br>
					<h1>Edit Quadrat/Subplot</h1>
					<button class="btn btn-info" onclick="javascript:save_edited_quadrat();return false;">Save Changes</button> 
					<button class="btn btn-info" onclick="javascript:window.history.back(-1); $(document).ready(function () {update_quadrat_list(); });">Cancel</button><br>
				</div>
			</div>
			<br>
			<div class="row-fluid">
				<div class="span12">
					<form id="quadrat_type">
					<?php
						$quadrat_types = $quadrat->get_quadrat_types();
						foreach ($quadrat_types as $quadrat_type) {
							if (($quadrat_type->id == 0) OR ($quadrat_type->id == $quadrat->quadrat_type) OR !$assessment->has_quadrat_type($quadrat_type->id)) {
								$checked = ($quadrat->quadrat_type == $quadrat_type->id) ? 'checked' : '';
								$disabled = ($quadrat->quadrat_type == UFQA_FULL_PLOT OR $quadrat->quadrat_type == UFQA_OUTSIDE_PLOT OR $quadrat->quadrat_type == UFQA_REST_OF_PLOT) ? 'disabled' : '';
								echo '<label class="radio">';
								echo '<input type="radio" name="quadratType" value="' . $quadrat_type->id . '" ' . $checked . ' ' . $disabled . '>';
								echo $quadrat_type->display_name;
								echo '</label>';
							}
						}
					?>
					</form>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span12">
				  <?php 
						$disabled = '';
						if ($quadrat->quadrat_type == UFQA_FULL_PLOT OR $quadrat->quadrat_type == UFQA_OUTSIDE_PLOT OR $quadrat->quadrat_type == UFQA_REST_OF_PLOT) {
							$disabled = 'disabled';
						}
					?>
					<label class="small-text">Quadrat/Subplot Number or Name: <font class="red">*</font></label>
					<input class="field" type="text" id="name" value="<?php echo $quadrat->name; ?>" maxlength="256" required <?php echo $disabled; ?>/>
 					<label class="small-text">Latitude: (optional)</label>
					<input class="field" type="text" id="latitude" value="<?php echo $quadrat->latitude; ?>" maxlength="256" /><br>
 					<label class="small-text">Longitude: (optional)</label>
					<input class="field" type="text" id="longitude" value="<?php echo $quadrat->longitude; ?>" maxlength="256" /><br>
					<label class="small-text">% Bare Ground: (optional)</label>
					<input class="field" type="text" id="bare_ground" value="<?php echo $quadrat->percent_bare_ground; ?>" maxlength="3" /><br>
 					<label class="small-text">% Water: (optional)</label>
					<input class="field" type="text" id="water" value="<?php echo $quadrat->percent_water; ?>" maxlength="3" /><br>	
				</div>
			</div>
			<br>

			<div class="row-fluid">
			  <div class="span12">
					<h4>Transect/Plot Cover Method:</h4>
					<input class="input-xlarge" id="cover_method_name" type="text" value='<?php echo $assessment->get_cover_method()->get_name(); ?>' disabled>
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
								$cover_method_values = $assessment->get_cover_method()->get_values();
								if (empty($cover_method_values)) {
									echo '<input class="input-mini" id="scientific_name_percent_cover" type="text" placeholder="% Cover">';
									echo '<select disabled class="input-medium" id="sciname_cover_value_id">';
									echo '<option disabled>'. UFQA_COVER_RANGE_MIDPOINT_DEFAULT . '</option>';
									foreach ($cover_method_values as $cover_method_value) {
										echo '<option value="' . $cover_method_value->id . '">' . $cover_method_value->display_name . '</option>';
									}
									echo '</select>';
								} else {
									echo '<input disabled class="input-mini" id="scientific_name_percent_cover" type="text" placeholder="% Cover">';					
									echo '<select class="input-medium" id="sciname_cover_value_id">';
									echo '<option disabled>'. UFQA_COVER_RANGE_MIDPOINT_DEFAULT . '</option>';
									foreach ($cover_method_values as $cover_method_value) {
										echo '<option value="' . $cover_method_value->id . '">' . $cover_method_value->display_name . '</option>';
									}
									echo '</select>';
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
								$cover_method_values = $assessment->get_cover_method()->get_values();
								if (empty($cover_method_values)) {
									echo '<input class="input-mini" id="acronym_percent_cover" type="text" placeholder="% Cover">';
									echo '<select disabled class="input-medium" id="acronym_cover_value_id">';
									echo '<option disabled>'. UFQA_COVER_RANGE_MIDPOINT_DEFAULT . '</option>';
									foreach ($cover_method_values as $cover_method_value) {
										echo '<option value="' . $cover_method_value->id . '">' . $cover_method_value->display_name . '</option>';
									}
									echo '</select>';
								} else {
									echo '<input disabled class="input-mini" id="acronym_percent_cover" type="text" placeholder="% Cover">';					
									echo '<select class="input-medium" id="acronym_cover_value_id">';
									echo '<option disabled>'. UFQA_COVER_RANGE_MIDPOINT_DEFAULT . '</option>';
									foreach ($cover_method_values as $cover_method_value) {
										echo '<option value="' . $cover_method_value->id . '">' . $cover_method_value->display_name . '</option>';
									}
									echo '</select>';
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
								$cover_method_values = $assessment->get_cover_method()->get_values();
								if (empty($cover_method_values)) {
									echo '<input class="input-mini" id="common_name_percent_cover" type="text" placeholder="% Cover">';
									echo '<select disabled class="input-medium" id="common_cover_value_id">';
									echo '<option disabled>'. UFQA_COVER_RANGE_MIDPOINT_DEFAULT . '</option>';
									foreach ($cover_method_values as $cover_method_value) {
										echo '<option value="' . $cover_method_value->id . '">' . $cover_method_value->display_name . '</option>';
									}
									echo '</select>';
								} else {
									echo '<input disabled class="input-mini" id="common_name_percent_cover" type="text" placeholder="% Cover">';					
									echo '<select class="input-medium" id="common_cover_value_id">';
									echo '<option disabled>'. UFQA_COVER_RANGE_MIDPOINT_DEFAULT . '</option>';
									foreach ($cover_method_values as $cover_method_value) {
										echo '<option value="' . $cover_method_value->id . '">' . $cover_method_value->display_name . '</option>';
									}
									echo '</select>';
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
				List each species and their cover value separated by a comma. For example: "Acorus calamus, 20, Alisma subcordatum, 15, Anemone virginiana, 5, etc."<br>
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
					<button class="btn btn-info" onclick="javascript:save_edited_quadrat();return false;">Save Changes</button> 
					<button class="btn btn-info" onclick="javascript:window.history.back(-1); $(document).ready(function () {update_quadrat_list(); });">Cancel</button><br>
				</div>
			</div>
		</div>
    </div> 
    <br><br>
