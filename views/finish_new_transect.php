    <script> 
	    $(window).bind("pageshow", function(event) {
		if (event.originalEvent.persisted)
			// catch back-forward cache in safari
			update_quadrat_list();
	    });
	    $(document).ready( function () { update_quadrat_list(); }); 
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
					<h1>New Transect Assessment</h1>
					<button class="btn btn-info" onclick="javascript:save_new_transect();return false;">Save and View Results</button>
					<button class="btn btn-info" onclick="javascript:window.location = '/view_assessments';return false;">Cancel</button><br>
				</div>
			</div>
			<br>
			<div class="row-fluid">
				<div class="span6">
					<p>
					<label class="small-text">Month: </label>
					<select id="month">
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
					<select id="day">
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
					<select id="year">
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
					<label class="small-text">Assessment Name: <font class="red">*</font></label>
					<input class="input-large" type="text" id="name" value="" maxlength="256" /><br>
					<label class="small-text">Practitioner: <font class="red">*</font></label>
					<input class="input-large" type="text" id="practitioner" value="" maxlength="256" /><br>
 					<label class="small-text">Latitude:</label>
					<input class="input-medium" type="text" id="latitude" value="" maxlength="256" /><br>
 					<label class="small-text">Longitude:</label>
					<input class="input-medium" type="text" id="longitude" value="" maxlength="256" /><br>
					<br>
					<form id="public_inventory">
					<label class="radio">
  						<input type="radio" name="publicOrPrivate" value="public" checked>
  						Public (viewable by all users of this site)
					</label>
					<label class="radio">
  						<input type="radio" name="publicOrPrivate" value="private">
  						Private (viewable only by you)
					</label>
					</form>
 				</div>
 				<div class="span6">
 					<label class="small-text">Weather Notes:</label>
					<textarea rows="3" id="weather_notes"></textarea><br>
 					<label class="small-text">Duration Notes:</label>
					<textarea rows="3" id="duration_notes"></textarea><br>
 					<label class="small-text">Community Type Notes:</label>
					<textarea rows="3" id="community_notes"></textarea><br>
 					<label class="small-text">Other Notes:</label>
					<textarea rows="3" id="other_notes"></textarea><br>
 				</div>
 			</div>
			<br>
			<div class="row-fluid">
				<div class="span12">	
					<h3>Quadrats:</h3>
					<button class="btn btn-info" onclick="javascript:window.location = '/new_quadrat';return false;">Add New Quadrat</button><br><br>
					Select which quadrats you want actively included in the FQA calculations. The unselected quadrats will remain saved here if you wish to include them in the future.<br><br>
					<div id="quadrat_list">
					</div>
					<br><br>
					<form id="upload_quadrat_string_form" action="/ajax/upload_quadrat_string" method="post" enctype="multipart/form-data" target="upload_target">
						<input type="file" id="upload_file" name="upload_file"><br>
					</form>
					<button onclick="javascript:start_upload_quadrat_string();" class="btn btn-info">Upload Quadrat String</button> (optional)
					<br><br>
					<div id="upload_error"></div>
				</div>
			</div>
			<br><br>
			<div class="row-fluid">
				<div class="span12">				
					<h4>Finished?</h4>
					<button class="btn btn-info" onclick="javascript:save_new_transect();return false;">Save and View Results</button> 
					<button class="btn btn-info" onclick="javascript:window.location = '/view_assessments';return false;">Cancel</button><br>
				</div>
			</div>
		</div>
    </div> 
    <br><br>
    <iframe id="upload_target" name="upload_target" src="#"></iframe>
