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
					<h3>Select the Cover Method:</h3>
					<select name="coverMethod" id="coverMethod">
					<?php
						$cover_methods = CoverMethod::get_cover_methods();
						foreach ($cover_methods as $cover_method_name => $cover_method) {
							if (UFQA_DEFAULT_COVER_METHOD === $cover_method->id) {
								echo '<option value="' . $cover_method->id . '" selected>' . $cover_method_name . '</option>';
							} else {
								echo '<option value="' . $cover_method->id . '">' . $cover_method_name . '</option>';
							}
						}
					?>
					</select><br/>
					<button class="btn btn-info" onclick="javascript:window.location = 'finish_new_transect/' + $('#fqa_select').val() + '/' + $('#coverMethod').val();return false;">OK</button>
					<button class="btn btn-info" onclick="javascript:window.location = 'view_assessments';return false;">Cancel</button>
				</div>
			</div>
		</div>
    </div> 
    <br><br>