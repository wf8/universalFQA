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
				</div>
			</div>
			<br>
			<div class="row-fluid">
				<div class="span12">
					<h3>Select the FQA database:</h3>
					<select id="fqa_select">
<?php
if (mysqli_num_rows($fqa_databases) !== 0) {
	while ($fqa_database = mysqli_fetch_assoc($fqa_databases)) {
		$fqa_id = $fqa_database['id'];
		$region = $fqa_database['region_name'];
		$year = $fqa_database['publication_year'];
?>
  						<option value="<?php echo $fqa_id; ?>"><?php echo $region; ?>, <?php echo $year; ?></option>
<?php
	}
}
if (mysqli_num_rows($custom_fqa_databases) !== 0) {
	while ($fqa_database = mysqli_fetch_assoc($custom_fqa_databases)) {
		$fqa_id = $fqa_database['id'];
		$name = $fqa_database['customized_name'];
		$year = $fqa_database['publication_year'];
?>
  						<option value="<?php echo $fqa_id; ?>"><?php echo $name; ?>, <?php echo $year; ?></option>
<?php
	}
}
?>
					</select><br>
					<button class="btn btn-info" onclick="javascript:window.location = 'finish_new_inventory/' + $('#fqa_select').val();return false;">OK</button>
					<button class="btn btn-info" onclick="javascript:window.location = 'view_assessments';return false;">Cancel</button>
				</div>
			</div>
		</div>
    </div> 
    <br><br>