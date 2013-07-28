    <div class="container padding-top">
		<div class="nice_margins">
			<div class="row-fluid">
				<div class="span1">
					<img src="/assets/images/blue-eyed.jpg" width="70" height="105" class="img-rounded">
					<br><br>
				</div>
				<div class="span11">
					<br>
					<h1>Inventory Assessment</h1>
					<button class="btn btn-info" onclick="javascript:window.location = '/edit_inventory/<?php echo $assessment->id; ?>';return false;">Edit This Inventory</button>
					<button class="btn btn-info" onClick="download_inventory(<?php echo $assessment->id; ?>);">Download Report</button> 
					<button class="btn btn-info" onclick="javascript:window.location = '/view_assessments';return false;">Done</button>
					<br>
				</div>
			</div>
			<br>
			<div class="row-fluid">
				<div class="span6">
					<h4>&#187; Date & Location:</h4>
					<strong><?php echo $assessment->date; ?><br>
					<?php echo $assessment->site->name; ?></strong><br>
					<?php echo $assessment->site->city; ?><br>
					<?php 
						echo $assessment->site->county;
						if ($assessment->site->county !== '' && $assessment->site->state !== '')
							echo ', ';
						echo $assessment->site->state; 
						if (($assessment->site->state !== '' && $assessment->site->country !== '') || ($assessment->site->county !== '' && $assessment->site->country !== ''))
							echo ', '; 
						echo $assessment->site->country; 
					?><br>		
				</div>	
				<div class="span6">
					<?php if ($assessment->custom_fqa) { ?>
						<h4>&#187; Custom FQA Database:</h4>
						Name: <strong><?php echo $assessment->fqa->customized_name; ?></strong><br>
						Description: <br><?php echo $assessment->fqa->customized_description; ?><br>
						<h4>&#187; Original FQA Database:</h4>
						Region: <strong><?php echo $assessment->fqa->region_name; ?></strong><br>
						Year Published: <strong><?php echo $assessment->fqa->publication_year; ?></strong><br>
						Description: <br><?php echo $assessment->fqa->description; ?>
					<?php } else { ?>
						<h4>&#187; FQA Database:</h4>
						Region: <strong><?php echo $assessment->fqa->region_name; ?></strong><br>
						Year Published: <strong><?php echo $assessment->fqa->publication_year; ?></strong><br>
						Description: <br><?php echo $assessment->fqa->description; ?>
					<?php } ?>
				</div>		
			</div>
			<br>
			<div class="row-fluid">
				<div class="span12">
					<h4>&#187; Details:</h4>			
					Practitioner: <strong><?php echo $assessment->practitioner; ?></strong><br>
 					Latitude: <?php echo $assessment->latitude; ?><br>
 					Longitude: <?php echo $assessment->longitude; ?><br>
					Weather Notes: <?php echo $assessment->weather_notes; ?><br>
 					Duration Notes: <?php echo $assessment->duration_notes; ?><br>
 					Community Type Notes: <?php echo $assessment->community_type_notes; ?><br>
 					Other Notes: <?php echo $assessment->other_notes; ?><br>
 					<?php if ($assessment->private == 'private') { ?>
 					This assessment is <strong>private</strong> (viewable only by you).<br>
 					<?php } else { ?>
 					This assessment is <strong>public</strong> (viewable by all users of this website).<br>
 					<?php } ?>
 				</div>
 			</div>
			<br>
			<div class="row-fluid">
				<div class="span3">
					<h4>&#187; Conservatism-Based Metrics:</h4>
					Total Mean C: <strong><?php echo $assessment->metrics->total_mean_c; ?></strong><br>
					Native Mean C: <strong><?php echo $assessment->metrics->native_mean_c; ?></strong><br>
					Native Tree Mean C: <strong><?php echo $assessment->metrics->native_tree_mean_c; ?></strong><br>
					Native Shrub Mean C: <strong><?php echo $assessment->metrics->native_shrub_mean_c; ?></strong><br>
					Native Herbaceous Mean C: <strong><?php echo $assessment->metrics->native_herbaceous_mean_c; ?></strong><br>
					Total FQI: <strong><?php echo $assessment->metrics->total_fqi; ?></strong><br>
					Native FQI: <strong><?php echo $assessment->metrics->native_fqi; ?></strong><br>
					Adjusted FQI: <strong><?php echo $assessment->metrics->adjusted_fqi; ?></strong><br>
					% C value 0:  <strong><?php echo $assessment->metrics->percent_c_0; ?>%</strong><br>
					% C value 1-3:  <strong><?php echo $assessment->metrics->percent_c_1_3; ?>%</strong><br>
					% C value 4-6:  <strong><?php echo $assessment->metrics->percent_c_4_6; ?>%</strong><br>
					% C value 7-10:  <strong><?php echo $assessment->metrics->percent_c_7_10; ?>%</strong><br>
				</div>
				<div class="span3">	
					<h4>&#187; Species Richness and Wetness:</h4>
					Total Species: <strong><?php echo $assessment->metrics->total_species; ?></strong><br>
					Native Species: <strong><?php echo $assessment->metrics->native_species; ?> (<?php echo $assessment->metrics->percent_native_species; ?>%)</strong><br>
					Non-native Species: <strong><?php echo $assessment->metrics->non_native_species; ?> (<?php echo $assessment->metrics->percent_non_native_species; ?>%)</strong><br>
					Mean Wetness: <strong><?php echo $assessment->metrics->mean_wetness; ?></strong><br>
					Native Mean Wetness: <strong><?php echo $assessment->metrics->native_mean_wetness; ?></strong><br>
				</div>
				<div class="span3">
					<h4>&#187; Physiognomy Metrics:</h4>
					Tree: <strong><?php echo $assessment->metrics->tree; ?> <?php echo $assessment->metrics->percent_tree; ?>   </strong><br>
					Shrub: <strong><?php echo $assessment->metrics->shrub; ?>     <?php echo $assessment->metrics->percent_shrub; ?> </strong><br>    
					Vine: <strong><?php echo $assessment->metrics->vine; ?>     <?php echo $assessment->metrics->percent_vine; ?>  </strong><br>
					Forb: <strong><?php echo $assessment->metrics->forb; ?>    <?php echo $assessment->metrics->percent_forb; ?>      </strong><br>
					Grass: <strong><?php echo $assessment->metrics->grass; ?>    <?php echo $assessment->metrics->percent_grass; ?> </strong><br>
					Sedge: <strong><?php echo $assessment->metrics->sedge; ?>    <?php echo $assessment->metrics->percent_sedge; ?> </strong><br>
					Rush: <strong><?php echo $assessment->metrics->rush; ?>     <?php echo $assessment->metrics->percent_rush; ?> </strong><br>
					Fern: <strong><?php echo $assessment->metrics->fern; ?>     <?php echo $assessment->metrics->percent_fern; ?> </strong><br>
					Bryophyte: <strong><?php echo $assessment->metrics->bryophyte; ?>     <?php echo $assessment->metrics->percent_bryophyte; ?>      </strong><br>  
				</div>
				<div class="span3">
					<h4>&#187; Duration Metrics:</h4>
					Annual: <strong><?php echo $assessment->metrics->annual; ?> <?php echo $assessment->metrics->percent_annual; ?></strong><br>
					Perennial: <strong><?php echo $assessment->metrics->perennial; ?> <?php echo $assessment->metrics->percent_perennial; ?></strong><br>
					Biennial: <strong><?php echo $assessment->metrics->biennial; ?> <?php echo $assessment->metrics->percent_biennial; ?></strong><br>
					<br>	
					Native Annual: <strong><?php echo $assessment->metrics->native_annual; ?> <?php echo $assessment->metrics->percent_native_annual; ?></strong><br>
					Native Perennial: <strong><?php echo $assessment->metrics->native_perennial; ?> <?php echo $assessment->metrics->percent_native_annual; ?></strong><br>
					Native Biennial: <strong><?php echo $assessment->metrics->native_biennial; ?> <?php echo $assessment->metrics->percent_native_annual; ?></strong><br>
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
<td><strong>Native?</strong></td>
<td><strong>C</strong></td>
<td><strong>W</strong></td>
<td><strong>Physiognomy</strong></td>
<td><strong>Duration</strong></td>
<td><strong>Common Name</strong></td>
</tr>   
<?php   

	function prettify_value( $value ) {
		if (trim($value) == '') 
			return 'n/a';
		else
			return $value;
	}
	
	function sort_array_of_objects($arr, $var) { 
	   $tarr = array(); 
	   $rarr = array(); 
	   for($i = 0; $i < count($arr); $i++) { 
		  $element = $arr[$i]; 
		  $tarr[] = strtolower($element->{$var}); 
	   } 
	   reset($tarr); 
	   asort($tarr); 
	   $karr = array_keys($tarr); 
	   for($i = 0; $i < count($tarr); $i++) { 
		  $rarr[] = $arr[intval($karr[$i])]; 
	   } 
	   return $rarr; 
	} 
	
	$html = '';
	if (count($assessment->taxa) == 0) {
		$html = $html . '<tr><td colspan=9>There are no species in this inventory.</td></tr>';
	} else {
		$sorted_taxa = sort_array_of_objects($assessment->taxa, 'scientific_name');
		foreach ($sorted_taxa as $taxon) {
			$html = $html . '<tr><td>' . $taxon->scientific_name . '</td>';
			$html = $html . '<td>' . prettify_value($taxon->family) . '</td>';
			$html = $html . '<td>' . prettify_value($taxon->acronym) . '</td>';
			$html = $html . '<td>' . $taxon->native . '</td>';
			$html = $html . '<td>' . $taxon->c_o_c . '</td>';
			$html = $html . '<td>' . prettify_value($taxon->c_o_w) . '</td>';
			$html = $html . '<td>' . prettify_value($taxon->physiognomy) . '</td>';
			$html = $html . '<td>' . prettify_value($taxon->duration) . '</td>';
			$html = $html . '<td>' . prettify_value($taxon->common_name) . '</td></tr>';
		}
	}
	echo $html . '</table>';
	
?>              						
				</div>
			</div>
		</div>
    </div> 
    <br><br>