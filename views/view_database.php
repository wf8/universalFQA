    <div class="container padding-top">
		<div class="nice_margins">
			<div class="row-fluid">
				<div class="span1">
					<img src="/assets/images/blue-eyed.jpg" width="70" height="105" class="img-rounded">
					<br><br>
				</div>
				<div class="span11">
					<br>
					<h1>Public FQA Database</h1>
					<button class="btn btn-info" onclick="javascript:window.location = '/customize_database/<?php echo $id; ?>';return false;">Customize This Database</button>
					<button class="btn btn-info" onClick="javascript:download_database(<?php echo $id; ?>);">Download</button> 
					<button class="btn btn-info" onclick="javascript:window.location = '/view_databases';return false;">Done</button>
					<br>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span12">
					<h2><?php echo $region; ?>, <?php echo $year; ?></h2>
				</div>
			</div>
			<br>
			<div class="row-fluid">
				<div class="span6">
					<h4>&#187; Details:</h4>
					Region: <?php echo $region; ?><br>
					Year Published: <?php echo $year; ?><br>
					Description: <?php echo $description; ?>
				</div>	
				<div class="span6">
					<h4>&#187; Database Metrics:</h4>
					Total Species: <strong><?php echo $total_taxa; ?></strong><br>
					Native Species: <strong><?php echo $native_taxa; ?> (<?php echo $percent_native; ?>%)</strong><br>
					Non-native Species: <strong><?php echo $total_taxa - $native_taxa; ?> (<?php echo $percent_nonnative; ?>%)</strong><br>
					Total Mean C: <strong><?php echo $mean_total_c; ?></strong><br>
					Native Mean C: <strong><?php echo $mean_native_c; ?></strong><br>
				</div>	
			</div>
			<br>
			<div class="row-fluid">
				<div class="span12">	
					<h4>&#187; Species:</h4>
					<table class="table table-hover">
						<tr>
							<td><strong>Scientific Name</strong></td>
							<td><strong>Family</strong></td>
							<td><strong>Acronym</strong></td>
							<td><strong>Nativity</strong></td>
							<td><strong>C</strong></td>
							<td><strong>W</strong></td>
							<td><strong>Wetland Status</strong></td>
							<td><strong>Physiognomy</strong></td>
							<td><strong>Duration</strong></td>
							<td><strong>Common Name</strong></td>
						</tr>  
						
<?php
while ($fqa_taxon = mysqli_fetch_assoc($fqa_taxa)) {
	echo "<tr>";
	echo "<td>".$fqa_taxon['scientific_name']."</td>";
	if ($fqa_taxon['family'] == null)
		$family = "n/a";
	else
		$family = $fqa_taxon['family'];
	echo "<td>".$family."</td>";
	if ($fqa_taxon['acronym'] == null)
		$acronym = "n/a";
	else
		$acronym = $fqa_taxon['acronym'];
	echo "<td>".$acronym."</td>";
	if ($fqa_taxon['native'] == 1)
		echo "<td>native</td>";
	else
		echo "<td>non-native</td>";
	echo "<td>".$fqa_taxon['c_o_c']."</td>";
	if ($fqa_taxon['c_o_w'] == null) {
		$c_o_w = "n/a";
		$wet = "n/a";
	} else {
		$c_o_w = $fqa_taxon['c_o_w'];
		if ($c_o_w == -5)	
			$wet = "OBL";
		else if ($c_o_w == -4)
			$wet = "FACW+";
		else if ($c_o_w == -3)
			$wet = "FACW";
		else if ($c_o_w == -2)
			$wet = "FACW-";
		else if ($c_o_w == -1)
			$wet = "FAC+";
		else if ($c_o_w == 0)
			$wet = "FAC";
		else if ($c_o_w == 1)
			$wet = "FAC-";
		else if ($c_o_w == 2)
			$wet = "FACU+";
		else if ($c_o_w == 3)
			$wet = "FACU";
		else if ($c_o_w == 4)
			$wet = "FACU-";
		else if ($c_o_w == 5)
			$wet = "UPL";
	}	
	echo "<td>".$c_o_w."</td>";
	echo "<td>".$wet."</td>";
	if ($fqa_taxon['physiognomy'] == null)
		$physiognomy = "n/a";
	else
		$physiognomy = $fqa_taxon['physiognomy'];
	echo "<td>".$physiognomy."</td>";
	if ($fqa_taxon['duration'] == null)
		$duration = "n/a";
	else
		$duration = $fqa_taxon['duration'];
	echo "<td>".$duration."</td>";
	if ($fqa_taxon['common_name'] == null)
		$common_name = "n/a";
	else
		$common_name = $fqa_taxon['common_name'];
	echo "<td>".$common_name."</td>";
	echo "</tr>";
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