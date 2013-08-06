    <div class="container padding-top">
		<div class="nice_margins">
			<div class="row-fluid">
				<div class="span1">
					<img src="/assets/images/blue-eyed.jpg" width="70" height="105" class="img-rounded">
					<br><br>
				</div>
				<div class="span11">
					<br>
					<h1>Transect Assessment</h1>
					<button class="btn btn-info" onclick="javascript:window.location = '/edit_transect/<?php echo $assessment->id; ?>';return false;">Edit This Transect</button>
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
			<?php
				function prettify_percent( $value ) {
					if (trim($value) == '') 
						return '';
					else
						return '(' . $value . '%)';
				}
				function prettify_value( $value ) {
					if (trim($value) == '') 
						return 'n/a';
					else
						return $value;
				}
			?>
			<div class="row-fluid">
				<div class="span4">
					<h4>&#187; Conservatism-Based Metrics:</h4>
					Total Mean C: <strong><?php echo $assessment->metrics->total_mean_c; ?></strong><br>
					Native Mean C: <strong><?php echo $assessment->metrics->native_mean_c; ?></strong><br>
					Native Tree Mean C: <strong><?php echo $assessment->metrics->native_tree_mean_c; ?></strong><br>
					Native Shrub Mean C: <strong><?php echo $assessment->metrics->native_shrub_mean_c; ?></strong><br>
					Native Herbaceous Mean C: <strong><?php echo $assessment->metrics->native_herbaceous_mean_c; ?></strong><br>
					Total FQI: <strong><?php echo $assessment->metrics->total_fqi; ?></strong><br>
					Native FQI: <strong><?php echo $assessment->metrics->native_fqi; ?></strong><br>
					Cover-weighted FQI: <strong><?php echo $assessment->metrics->cover_weighted_total_fqi; ?></strong><br>
					Cover-weighted Native FQI: <strong><?php echo $assessment->metrics->cover_weighted_native_fqi; ?></strong><br>
					Adjusted FQI: <strong><?php echo $assessment->metrics->adjusted_fqi; ?></strong><br>
					% C value 0:  <strong><?php echo $assessment->metrics->percent_c_0; ?>%</strong><br>
					% C value 1-3:  <strong><?php echo $assessment->metrics->percent_c_1_3; ?>%</strong><br>
					% C value 4-6:  <strong><?php echo $assessment->metrics->percent_c_4_6; ?>%</strong><br>
					% C value 7-10:  <strong><?php echo $assessment->metrics->percent_c_7_10; ?>%</strong><br>
				</div>
				<div class="span4">	
					<h4>&#187; Species Richness and Wetness:</h4>
					Total Species: <strong><?php echo $assessment->metrics->total_species; ?></strong><br>
					Native Species: <strong><?php echo $assessment->metrics->native_species; ?> <?php echo prettify_percent($assessment->metrics->percent_native_species); ?></strong><br>
					Non-native Species: <strong><?php echo $assessment->metrics->non_native_species; ?> <?php echo prettify_percent($assessment->metrics->percent_non_native_species); ?></strong><br>
					Mean Wetness: <strong><?php echo $assessment->metrics->mean_wetness; ?></strong><br>
					Native Mean Wetness: <strong><?php echo $assessment->metrics->native_mean_wetness; ?></strong><br>
				</div>
				<!--
				<div class="span3">
					<h4>&#187; Physiognomy Metrics:</h4>
					Tree: <strong><?php echo $assessment->metrics->tree; ?> <?php echo prettify_percent($assessment->metrics->percent_tree); ?>   </strong><br>
					Shrub: <strong><?php echo $assessment->metrics->shrub; ?>     <?php echo prettify_percent($assessment->metrics->percent_shrub); ?> </strong><br>    
					Vine: <strong><?php echo $assessment->metrics->vine; ?>     <?php echo prettify_percent($assessment->metrics->percent_vine); ?>  </strong><br>
					Forb: <strong><?php echo $assessment->metrics->forb; ?>    <?php echo prettify_percent($assessment->metrics->percent_forb); ?>      </strong><br>
					Grass: <strong><?php echo $assessment->metrics->grass; ?>    <?php echo prettify_percent($assessment->metrics->percent_grass); ?> </strong><br>
					Sedge: <strong><?php echo $assessment->metrics->sedge; ?>    <?php echo prettify_percent($assessment->metrics->percent_sedge); ?> </strong><br>
					Rush: <strong><?php echo $assessment->metrics->rush; ?>     <?php echo prettify_percent($assessment->metrics->percent_rush); ?> </strong><br>
					Fern: <strong><?php echo $assessment->metrics->fern; ?>     <?php echo prettify_percent($assessment->metrics->percent_fern); ?> </strong><br>
					Bryophyte: <strong><?php echo $assessment->metrics->bryophyte; ?>     <?php echo prettify_percent($assessment->metrics->percent_bryophyte); ?>      </strong><br>  
				</div>
				-->
				<div class="span4">
					<h4>&#187; Duration Metrics:</h4>
					Annual: <strong><?php echo $assessment->metrics->annual; ?> <?php echo prettify_percent($assessment->metrics->percent_annual); ?></strong><br>
					Perennial: <strong><?php echo $assessment->metrics->perennial; ?> <?php echo prettify_percent($assessment->metrics->percent_perennial); ?></strong><br>
					Biennial: <strong><?php echo $assessment->metrics->biennial; ?> <?php echo prettify_percent($assessment->metrics->percent_biennial); ?></strong><br>
					<br>	
					Native Annual: <strong><?php echo $assessment->metrics->native_annual; ?> <?php echo prettify_percent($assessment->metrics->percent_native_annual); ?></strong><br>
					Native Perennial: <strong><?php echo $assessment->metrics->native_perennial; ?> <?php echo prettify_percent($assessment->metrics->percent_native_perennial); ?></strong><br>
					Native Biennial: <strong><?php echo $assessment->metrics->native_biennial; ?> <?php echo prettify_percent($assessment->metrics->percent_native_biennial); ?></strong><br>
				</div>	
			</div>
			<br>
			<div class="row-fluid">
				<div class="span12">
					<h4>&#187; Physiognomic Relative Importance Values:</h4>
					<table class="table table-hover">
						<tr>
							<td><strong>Physiognomy</strong></td>
							<td><strong>Frequency</strong></td>
							<td><strong>Coverage</strong></td>
							<td><strong>Relative Frequency (%)</strong></td>
							<td><strong>Relative Coverage (%)</strong></td>
							<td><strong>Relative Importance Value</strong></td>
						</tr>
						<!-- show descending in order of RIV -->
						<tr>
							<td>Tree</td>
							<td><?php echo $assessment->metrics->tree; ?></td>
							<td><?php echo $assessment->metrics->tree_coverage; ?></td>
							<td><?php echo prettify_value($assessment->metrics->percent_tree); ?></td>
							<td><?php echo prettify_value($assessment->metrics->percent_tree_coverage); ?></td>
							<td><?php echo $assessment->metrics->tree_riv; ?></td>
						</tr>
						<tr>
							<td>Shrub</td>
							<td><?php echo $assessment->metrics->shrub; ?></td>
							<td><?php echo $assessment->metrics->shrub_coverage; ?></td>
							<td><?php echo prettify_value($assessment->metrics->percent_shrub); ?></td>
							<td><?php echo prettify_value($assessment->metrics->percent_shrub_coverage); ?></td>
							<td><?php echo $assessment->metrics->shrub_riv; ?></td>
						</tr>
						<tr>
							<td>Vine</td>
							<td><?php echo $assessment->metrics->vine; ?></td>
							<td><?php echo $assessment->metrics->vine_coverage; ?></td>
							<td><?php echo prettify_value($assessment->metrics->percent_vine); ?></td>
							<td><?php echo prettify_value($assessment->metrics->percent_vine_coverage); ?></td>
							<td><?php echo $assessment->metrics->vine_riv; ?></td>
						</tr>
						<tr>
							<td>Forb</td>
							<td><?php echo $assessment->metrics->forb; ?></td>
							<td><?php echo $assessment->metrics->forb_coverage; ?></td>
							<td><?php echo prettify_value($assessment->metrics->percent_forb); ?></td>
							<td><?php echo prettify_value($assessment->metrics->percent_forb_coverage); ?></td>
							<td><?php echo $assessment->metrics->forb_riv; ?></td>
						</tr>
						<tr>
							<td>Grass</td>
							<td><?php echo $assessment->metrics->grass; ?></td>
							<td><?php echo $assessment->metrics->grass_coverage; ?></td>
							<td><?php echo prettify_value($assessment->metrics->percent_grass); ?></td>
							<td><?php echo prettify_value($assessment->metrics->percent_grass_coverage); ?></td>
							<td><?php echo $assessment->metrics->grass_riv; ?></td>
						</tr>
						<tr>
							<td>Sedge</td>
							<td><?php echo $assessment->metrics->sedge; ?></td>
							<td><?php echo $assessment->metrics->sedge_coverage; ?></td>
							<td><?php echo prettify_value($assessment->metrics->percent_sedge); ?></td>
							<td><?php echo prettify_value($assessment->metrics->percent_sedge_coverage); ?></td>
							<td><?php echo $assessment->metrics->sedge_riv; ?></td>
						</tr>
						<tr>
							<td>Rush</td>
							<td><?php echo $assessment->metrics->rush; ?></td>
							<td><?php echo $assessment->metrics->rush_coverage; ?></td>
							<td><?php echo prettify_value($assessment->metrics->percent_rush); ?></td>
							<td><?php echo prettify_value($assessment->metrics->percent_rush_coverage); ?></td>
							<td><?php echo $assessment->metrics->rush_riv; ?></td>
						</tr>
						<tr>
							<td>Fern</td>
							<td><?php echo $assessment->metrics->fern; ?></td>
							<td><?php echo $assessment->metrics->fern_coverage; ?></td>
							<td><?php echo prettify_value($assessment->metrics->percent_fern); ?></td>
							<td><?php echo prettify_value($assessment->metrics->percent_fern_coverage); ?></td>
							<td><?php echo $assessment->metrics->fern_riv; ?></td>
						</tr>
						<tr>
							<td>Bryophyte</td>
							<td><?php echo $assessment->metrics->bryophyte; ?></td>
							<td><?php echo $assessment->metrics->bryophyte_coverage; ?></td>
							<td><?php echo prettify_value($assessment->metrics->percent_bryophyte); ?></td>
							<td><?php echo prettify_value($assessment->metrics->percent_bryophyte_coverage); ?></td>
							<td><?php echo $assessment->metrics->bryophyte_riv; ?></td>
						</tr>
					</table>
				</div>
			</div>
			<br>
			<div class="row-fluid">
				<div class="span12">
					<h4>&#187; Species Relative Importance Values:</h4>
					<table class="table table-hover">
						<tr>
							<td><strong>Species</strong></td>
							<td><strong>Frequency</strong></td>
							<td><strong>Coverage</strong></td>
							<td><strong>Relative Frequency (%)</strong></td>
							<td><strong>Relative Coverage (%)</strong></td>
							<td><strong>Relative Importance Value</strong></td>
						</tr>
						<!-- show descending in order of RIV -->
						<tr>
							<td>Acorus calamus</td>
							<td>120</td>
							<td>105</td>
							<td>15</td>
							<td>13</td>
							<td>14</td>
						</tr>
						<tr>
							<td>Alisma subcordatum</td>
							<td>120</td>
							<td>105</td>
							<td>15</td>
							<td>13</td>
							<td>14</td>
						</tr>
					</table>
				</div>
			</div>
			<br>
			<div class="row-fluid">
				<div class="span12">
					<h4>&#187; Quadrat Level Metrics:</h4>

					<table class="table table-hover">
						<tr>
							<td><strong>Quadrat</strong></td>
							<td><strong>Species Richness</strong></td>
							<td><strong>Native Species Richness</strong></td>
							<td><strong>Total Mean C</strong></td>
							<td><strong>Native Mean C</strong></td>
							<td><strong>Total FQI</strong></td>
							<td><strong>Native FQI</strong></td>
							<td><strong>Cover-weighted FQI</strong></td>
							<td><strong>Cover-weighted Native FQI</strong></td>
							<td><strong>Adjusted FQI</strong></td>
							<td><strong>Mean Wetness</strong></td>
							<td><strong>Mean Native Wetness</strong></td>
							<td><strong>Latitude</strong></td>
							<td><strong>Longitude</strong></td>
						</tr>    
						<?php 	
							foreach ($assessment->quadrats as $quadrat) { 
								if ($quadrat->active) { 
						?>           
							<tr>
								<td><?php echo $quadrat->name; ?></td>
								<td><?php echo $quadrat->metrics->total_species; ?></td>
								<td><?php echo $quadrat->metrics->native_species; ?></td>
								<td><?php echo $quadrat->metrics->total_mean_c; ?></td>
								<td><?php echo $quadrat->metrics->native_mean_c; ?></td>
								<td><?php echo $quadrat->metrics->total_fqi; ?></td>
								<td><?php echo $quadrat->metrics->native_fqi; ?></td>
								<td><?php echo $quadrat->metrics->cover_weighted_total_fqi; ?></td>
								<td><?php echo $quadrat->metrics->cover_weighted_native_fqi; ?></td>
								<td><?php echo $quadrat->metrics->adjusted_fqi; ?></td>
								<td><?php echo $quadrat->metrics->mean_wetness; ?></td>
								<td><?php echo $quadrat->metrics->native_mean_wetness; ?></td>
								<td><?php echo prettify_value($quadrat->latitude); ?></td>
								<td><?php echo prettify_value($quadrat->longitude); ?></td>
							</tr>
						<?php
							 	}
							} 
						?>
					</table>
				</div>
			</div>
			<br>
			
<?php



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
$num_active_quads = 0;
$quadrats = sort_array_of_objects($assessment->quadrats, 'name');
foreach ($quadrats as $quadrat) {
	if (!$quadrat->active) {
	} else {
		$num_active_quads++; 			
?>			
			<div class="row-fluid">
				<div class="span12">	
					<h4>&#187; Quadrat <?php echo $quadrat->name; ?> Species:</h4>
					<table class="table table-hover">
<tr>
<td><strong>Scientific Name</strong></td>
<td><strong>Family</strong></td>
<td><strong>Acronym</strong></td>
<td><strong>% Cover</strong></td>
<td><strong>Nativity</strong></td>
<td><strong>C</strong></td>
<td><strong>W</strong></td>
<td><strong>Physiognomy</strong></td>
<td><strong>Duration</strong></td>
<td><strong>Common Name</strong></td>
</tr>      
<?php
		$html = '';
		if (count($quadrat->taxa) == 0) {
			$html = $html . '<tr><td colspan=9>There are no species in this quadrat.</td></tr>';
		} else {
			$sorted_taxa = sort_array_of_objects($quadrat->taxa, 'scientific_name');
			foreach ($sorted_taxa as $taxon) {
				$html = $html . '<tr><td>' . $taxon->scientific_name . '</td>';
				$html = $html . '<td>' . prettify_value($taxon->family) . '</td>';
				$html = $html . '<td>' . prettify_value($taxon->acronym) . '</td>';
				$html = $html . '<td>' . $taxon->percent_cover . '</td>';
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
			<br>
<?php
	}
}
if ($num_active_quads == 0) {
	echo '<div class="row-fluid"><div class="span12"><h4>&#187; There are no quadrats in this transect. </h4></div></div>';
}
?>
		</div>
    </div> 
    <br><br>