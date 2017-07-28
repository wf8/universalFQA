    <script> 
      $(function () {
        $('#fqa_select').searchableOptionList({
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
					<h1>New Transect/Plot Assessment</h1>
				</div>
			</div>
			<br>
			<div class="row-fluid">
				<div class="span12">
					<h3>Select the FQA database:</h3>
					<label class="small-text">FQA Database:</label>
					<select id="fqa_select" name="fqa_select" style="width:auto;">
						<?php
						foreach ($fqa_databases as $fqa_id => $fqa_database) {
							echo '<option value="' . $fqa_id . '">' . $fqa_database->selection_display_name . '</option>';
						}
						foreach ($custom_fqa_databases as $fqa_id => $fqa_database) {
							echo '<option value="custom' . $fqa_id . '">' . $fqa_database->selection_display_name . '</option>';
						}
						?>
					</select><br>
					<button class="btn btn-info" onclick="javascript:window.location = 'finish_new_transect/' + $('#fqa_select').val();return false;">OK</button>
					<button class="btn btn-info" onclick="javascript:window.location = 'view_assessments';return false;">Cancel</button>
				</div>
			</div>
		</div>
    </div> 
    <br><br>