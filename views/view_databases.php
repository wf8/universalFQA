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
					<h1>FQA Databases</h1>
					<button class="btn btn-info" onclick="javascript:window.location = 'new_database';return false;">Upload New Public FQA Database</button>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span12">
					<h2>Public Databases</h2>
					<table class="table table-hover sortable">
						<tr>
							<td><strong>Region</strong></td>
							<td><strong>Year Published</strong></td>
							<td><strong>Description</strong></td>
							<td><strong>Options</strong></td>
						</tr>
<?php
if (mysqli_num_rows($fqa_databases) == 0) {
?>
						<tr>
							<td colspan="4">There are no FQA databases available.</td>
						</tr>
<?php
} else {
	while ($fqa_database = mysqli_fetch_assoc($fqa_databases)) {
		$fqa_id = $fqa_database['id'];
		$region = $fqa_database['region_name'];
		$year = $fqa_database['publication_year'];
		$description = $fqa_database['description'];
?>
						<tr>
							<td><a href="view_database/<?php echo $fqa_id; ?>"><?php echo $region; ?></a></td>
							<td><?php echo $year; ?></td>
							<td><?php echo $description; ?></td>
							<td><a href="view_database/<?php echo $fqa_id; ?>">View</a> | <a href="customize_database/<?php echo $fqa_id; ?>">Customize</a> | <a href="javascript:download_database(<?php echo $fqa_id; ?>)">Download</a></td>
						</tr>
<?php
	}
}
?>
						</tr>
					</table>
					<h2>Your Customized Databases</h2>
					<table class="table table-hover sortable">
						<tr>
							<td><strong>Name</strong></td>
							<td><strong>Description</strong></td>
							<td><strong>Orginal FQA Database</strong></td>
							<td><strong>Options</strong></td>
						</tr>
<?php
if (mysqli_num_rows($custom_fqa_databases) == 0) {
?>
						<tr>
							<td colspan="4">You have not made any customized FQA databases.</td>
						</tr>
<?php
} else {
	while ($fqa_database = mysqli_fetch_assoc($custom_fqa_databases)) {
		$fqa_id = $fqa_database['id'];
		$customized_name = $fqa_database['customized_name'];
		$customized_description = $fqa_database['customized_description'];
		$region = $fqa_database['region_name'];
		$year = $fqa_database['publication_year'];
?>
						<tr>
							<td><a href="edit_custom_database/<?php echo $fqa_id; ?>"><?php echo $customized_name; ?></a></td>
							<td><?php echo $customized_description; ?></td>
							<td><?php echo $region; ?>, <?php echo $year; ?></td>
							<td><a href="edit_custom_database/<?php echo $fqa_id; ?>">Edit</a> | <a href="javascript:download_custom_database(<?php echo $fqa_id; ?>);">Download</a> | <a onclick="javascript:delete_custom_database(<?php echo $fqa_id; ?>);" href="#">Delete</a></td>
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
