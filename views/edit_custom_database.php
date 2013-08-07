	<script> block_screen() </script>
    <div class="container padding-top">
		<div class="nice_margins">
			<div class="row-fluid">
				<div class="span1">
					<img src="/assets/images/blue-eyed.jpg" width="70" height="105" class="img-rounded">
					<br><br>
				</div>
				<div class="span11">
					<br>
					<h1>Edit Custom FQA Database</h1>
					<button class="btn btn-info" onclick="javascript:done_creating_custom_db();">Done Making Changes</button>
					<button class="btn btn-info" onclick="javascript:delete_custom_database(<?php echo $customized_fqa_id; ?>);">Delete This Custom FQA Database</button>
					<br>
				</div>
			</div>
			<br>
			<div class="row-fluid">
				<div class="span6">
					<h4>&#187; Customized Database Details:</h4>
					<label class="small-text">Customized Database Name: <font class="red">*</font></label>
					<input class="field" type="text" id="customized_fqa_name" value="<?php echo $customized_name; ?>" maxlength="256" required onChange="custom_fqa_update(<?php echo $customized_fqa_id; ?>)" />
					<label class="small-text">Customized Database Description: <font class="red">*</font></label>
					<input class="field" type="text" id="customized_fqa_description" value="<?php echo $customized_description; ?>" maxlength="256" required onChange="custom_fqa_update(<?php echo $customized_fqa_id; ?>)" />
				</div>
				<div class="span6">
					<h4>&#187; Original Database Details:</h4>
					Region: <?php echo $region; ?><br>
					Year Published: <?php echo $year; ?><br>
					Description: <?php echo $description; ?>
				</div>	
			</div>
			<br>
			<div class="row-fluid">
				<div class="span12">	
					<h4>&#187; Species:</h4>
					<table class="table">
						<tr>
							<td><strong>Scientific Name</strong></td>
							<td><strong>Family</strong></td>
							<td><strong>Acronym</strong></td>
							<td><strong>Nativity</strong></td>
							<td><strong>C</strong></td>
							<td><strong>W</strong></td>
							<td><strong>Physiognomy</strong></td>
							<td><strong>Duration</strong></td>
							<td><strong>Common Name</strong></td>
							<td><strong>Options</strong></td>
						</tr> 
						<tr>
							<td><input class="input-medium" id="new_scientific_name" type="text" value=""></td>
							<td><input class="input-small" id="new_family" type="text" value=""></td>
							<td><input class="input-mini" id="new_acronym" type="text" value=""></td>
							<td><input class="input-mini" id="new_native" type="text" value=""></td>
							<td><input class="input-mini" id="new_c" type="text" value=""></td>
							<td><input class="input-mini" id="new_w" type="text" value=""></td>
							<td><input class="input-mini" id="new_physiognomy" type="text" value=""></td>
							<td><input class="input-small" id="new_duration" type="text" value=""></td>
							<td><input class="input-medium" id="new_common_name" type="text" value=""></td>
							<td><a href="javascript:new_custom_taxa( <?php echo $original_fqa_id; ?>, <?php echo $customized_fqa_id; ?> );">Add</a></td>
						</tr>   
<?php
if (mysqli_num_rows($taxa) == 0) {
?>
						<tr>
							<td colspan="4">There are no taxa in this customized FQA database.</td>
						</tr>
<?php
} else {
	$i = 0;
	while ($taxon = mysqli_fetch_assoc($taxa)) {
		$i++;
		$taxon_id = $taxon['id'];
		$scientific_name = $taxon['scientific_name'];
		$family = $taxon['family'];
		$acronym = $taxon['acronym'];
		$native = $taxon['native'];
		if ($native == '1')
			$native = 'native';
		if ($native == '0')
			$native = 'non-native';
		$c_o_c = $taxon['c_o_c'];
		$c_o_w = $taxon['c_o_w'];
		$physiognomy = $taxon['physiognomy'];
		$duration = $taxon['duration'];
		$common_name = $taxon['common_name'];
?>
						<tr>
							<td><input class="input-medium" id="scientific_name<?php echo $i; ?>" type="text" onChange="custom_taxa_update( 'scientific_name<?php echo $i; ?>', 'scientific_name', <?php echo $taxon_id; ?> );" value="<?php echo $scientific_name; ?>"></td>
							<td><input class="input-small" id="family<?php echo $i; ?>" type="text" onChange="custom_taxa_update( 'family<?php echo $i; ?>', 'family', <?php echo $taxon_id; ?> );" value="<?php echo $family; ?>"></td>
							<td><input class="input-mini" id="acronym<?php echo $i; ?>" type="text" onChange="custom_taxa_update( 'acronym<?php echo $i; ?>', 'acronym', <?php echo $taxon_id; ?> );" value="<?php echo $acronym; ?>"></td>
							<td><input class="input-mini" id="native<?php echo $i; ?>" type="text" onChange="custom_taxa_update( 'native<?php echo $i; ?>', 'native', <?php echo $taxon_id; ?> );" value="<?php echo $native; ?>"></td>
							<td><input class="input-mini" id="c_o_c<?php echo $i; ?>" type="text" onChange="custom_taxa_update( 'c_o_c<?php echo $i; ?>', 'c_o_c', <?php echo $taxon_id; ?> );" value="<?php echo $c_o_c; ?>"></td>
							<td><input class="input-mini" id="c_o_w<?php echo $i; ?>" type="text" onChange="custom_taxa_update( 'c_o_w<?php echo $i; ?>', 'c_o_w', <?php echo $taxon_id; ?> );" value="<?php echo $c_o_w; ?>"></td>
							<td><input class="input-mini" id="physiognomy<?php echo $i; ?>" type="text" onChange="custom_taxa_update( 'physiognomy<?php echo $i; ?>', 'physiognomy', <?php echo $taxon_id; ?> );" value="<?php echo $physiognomy; ?>"></td>
							<td><input class="input-small" id="duration<?php echo $i; ?>" type="text" onChange="custom_taxa_update( 'duration<?php echo $i; ?>', 'duration', <?php echo $taxon_id; ?> );" value="<?php echo $duration; ?>"></td>
							<td><input class="input-medium" id="common_name<?php echo $i; ?>" type="text" onChange="custom_taxa_update( 'common_name<?php echo $i; ?>', 'common_name', <?php echo $taxon_id; ?> );" value="<?php echo $common_name; ?>"></td>
							<td><a onclick="javascript:delete_custom_taxa(<?php echo $taxon_id; ?>, <?php echo $customized_fqa_id; ?>);" href="#">Delete</a></td>
						</tr>
<?php
	}
}
?>
					</table>						
				</div>
			</div>
			<br><br>
			<div class="row-fluid">
				<div class="span12">				
					<h4>Finished?</h4>
					<button class="btn btn-info" onclick="javascript:done_creating_custom_db();">Done Making Changes</button>
					<button class="btn btn-info" onclick="javascript:delete_custom_database(<?php echo $customized_fqa_id; ?>);">Delete This Custom FQA Database</button>
					<br>
				</div>
			</div>
		</div>
    </div> 
    <br><br>