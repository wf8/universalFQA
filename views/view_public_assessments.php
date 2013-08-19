    <script src="assets/js/sorttable.js"></script>
    <div class="container padding-top">
		<div class="nice_margins">
			<div class="row-fluid">
				<div class="span1">
					<img src="/assets/images/blue-eyed.jpg" width="70" height="105" class="img-rounded">
					<br><br>
				</div>
				<div class="span11">
					<br>
					<h1>Public Assessments</h1>
					<button class="btn btn-info" onclick="javascript:public_assessment_summary();">Download Summary</button>
					<button class="btn btn-info" onclick="javascript:window.location = '/view_assessments';return false;">View Your Assessments</button>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span12">
					<h2>Public Inventory Assessments</h2>
					<table class="table table-hover sortable">
						<tr>
							<td><strong>Site</strong></td>
							<td><strong>Date</strong></td>
							<td><strong>Native FQI</strong></td>
							<td><strong>Public / Private</strong></td>
							<td><strong>Options</strong></td>							
						</tr>
<?php
if (count($inventory_assessments) == 0) {
?>
						<tr>
							<td colspan="5">There are no public inventory assessments.</td> 
						</tr>
<?php
} else {
	foreach ($inventory_assessments as $assessment) {
?>						
						<tr>
							<td><a href="/view_public_inventory/<?php echo $assessment->id; ?>"><?php echo $assessment->site->name; ?></a></td>
							<td><?php echo $assessment->date; ?></td>
							<td><?php echo $assessment->metrics->native_fqi; ?></td>
							<td><?php echo $assessment->private; ?></td>
							<td><a href="/view_public_inventory/<?php echo $assessment->id; ?>">View</a> | <a href="javascript:download_inventory(<?php echo $assessment->id; ?>);">Download</a></td>
						</tr>
<?php
	}
}
?>
					</table>
					<h2>Public Transect Assessments</h2>
					<table class="table table-hover sortable">
						<tr>
							<td><strong>Site</strong></td>
							<td><strong>Date</strong></td>
							<td><strong>Native FQI</strong></td>
							<td><strong>Public / Private</strong></td>
							<td><strong>Options</strong></td>							
						</tr>
<?php
if (count($transect_assessments) == 0) {
?>
						<tr>
							<td colspan="5">There are no public transect assessments.</td> 
						</tr>
<?php
} else {
	foreach ($transect_assessments as $assessment) {
?>
						<tr>
							<td><a href="/view_public_transect/<?php echo $assessment->id; ?>"><?php echo $assessment->site->name; ?></a></td>
							<td><?php echo $assessment->date; ?></td>
							<td><?php echo $assessment->metrics->native_fqi; ?></td>
							<td><?php echo $assessment->private; ?></td>
							<td><a href="/view_public_transect/<?php echo $assessment->id; ?>">View</a> | <a href="javascript:download_transect(<?php echo $assessment->id; ?>);">Download</a></td>
						</tr>
<?php
	}
}
?>
					</table>
				</div>
			</div>
		</div>
    </div> 
    <br><br>
    <form id="download_csv_form" method="post" action="/download_report">
		<input type="hidden" id="download_csv" name="download_csv" />
	</form>    
