    <script> 
    	$(function () { 
    		$('#omernik_ecoregion').searchableOptionList({
    			maxHeight: '250px'
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
					<h1>New Site</h1>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span4">
					<label class="small-text">Name: <font class="red">*</font></label>
					<input class="input-medium" type="text" id="site_name" value="" size="23" maxlength="23" required />
					<label class="small-text">Notes:</label>
					<textarea rows="3" cols="23" id="site_notes"></textarea>
				</div>	
				<div class="span8">	
					<label class="small-text">City:</label>
					<input class="input-medium" type="text" id="site_city" value="" size="23" maxlength="256" />
					<label class="small-text">County:</label>
					<input class="input-medium" type="text" id="site_county" value="" size="23" maxlength="256" />
					<label class="small-text">State:</label>
					<input class="input-medium" type="text" id="site_state" value="" size="23" maxlength="256" />
					<label class="small-text">Country:</label>
					<input class="input-medium" type="text" id="site_country" value="" size="23" maxlength="256" />
				</div>
			</div>
			<div class="row-fluid">
				<div class="span8">
					<label class="small-text">Omernik Level 3 Ecoregion</label>
					<select style="width:auto;" id="omernik_ecoregion" name="omernik_ecoregion">
						<?php
							foreach ($omernik_ecoregions as $ecoregion) {
								echo '<option value="' . $ecoregion->id . '">' . $ecoregion->display_name . '</option>';
							}
						?>
					</select>
					<br><br>
					<button class="btn btn-info" onClick="save_new_site();">Save New Site</button> 
					<button class="btn btn-info" onclick="javascript:window.history.back(-1); $(document).ready(function () {update_quadrat_list(); update_species_list();});">Done</button><br>
					<font class="red">* required</font>
				</div>
			</div>
		</div>
    </div> 
    <br><br>