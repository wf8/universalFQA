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
			<div class="row-fluid">
				<div class="span4">
					<h4>&#187; Conservatism-Based Metrics:</h4>
					Total Mean C: <strong>4.5</strong><br>
					Native Mean C: <strong>5.5</strong><br>
					Native Tree Mean C: <strong>5.5</strong><br>
					Native Shrub Mean C: <strong>5.5</strong><br>
					Native Herbaceous Mean C: <strong>5.5</strong><br>
					Total FQI: <strong>30.5</strong><br>
					Native FQI: <strong>45.5</strong><br>
					Cover-weighted FQI: <strong>30.5</strong><br>
					Cover-weighted Native FQI: <strong>45.5</strong><br>
					Adjusted FQI: <strong>45.5</strong><br>
					% C value 0:  <strong>0%</strong><br>
					% C value 1-3:  <strong>0%</strong><br>
					% C value 4-6:  <strong>0%</strong><br>
					% C value 7-10:  <strong>0%</strong><br>
				</div>
				<div class="span4">	
					<h4>&#187; Species Richness and Wetness:</h4>
					Total Species: <strong>44</strong><br>
					Native Species: <strong>37 (84.1%)</strong><br>
					Non-native Species: <strong>7 (15.9%)</strong><br>
					Mean Wetness: <strong>-2</strong><br>
					Native Mean Wetness: <strong>-2</strong><br>
				</div>
				<!--
				<div class="span3">
					<h4>&#187; Physiognomy Metrics:</h4>
					Tree: <strong>0 (0.0%)   </strong><br>
					Shrub: <strong>1     (2.3%) </strong><br>    
					Vine: <strong>1     (2.3%)  </strong><br>
					Forb: <strong>22    (50.0%)      </strong><br>
					Grass: <strong>6    (13.6%) </strong><br>
					Sedge: <strong>7    (15.9%) </strong><br>
					Rush: <strong>0     (0.0%) </strong><br>
					Fern: <strong>0     (0.0%) </strong><br>
					Bryophyte: <strong>0     (0.0%)      </strong><br>  
				</div>
				-->
				<div class="span4">
					<h4>&#187; Duration Metrics:</h4>
					Annual: <strong>22 (50.0%)</strong><br>
					Perennial: <strong>22 (50.0%)</strong><br>
					Biennial: <strong>0 (0.0%)</strong><br>
					<br>	
					Native Annual: <strong>22 (50.0%)</strong><br>
					Native Perennial: <strong>22 (50.0%)</strong><br>
					Native Biennial: <strong>0 (0.0%)</strong><br>
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
							<td>120</td>
							<td>105</td>
							<td>15</td>
							<td>13</td>
							<td>14</td>
						</tr>
						<tr>
							<td>Shrub</td>
							<td>120</td>
							<td>105</td>
							<td>15</td>
							<td>13</td>
							<td>14</td>
						</tr>
						<tr>
							<td>Vine</td>
							<td>120</td>
							<td>105</td>
							<td>15</td>
							<td>13</td>
							<td>14</td>
						</tr>
						<tr>
							<td>Forb</td>
							<td>120</td>
							<td>105</td>
							<td>15</td>
							<td>13</td>
							<td>14</td>
						</tr>
						<tr>
							<td>Grass</td>
							<td>120</td>
							<td>105</td>
							<td>15</td>
							<td>13</td>
							<td>14</td>
						</tr>
						<tr>
							<td>Sedge</td>
							<td>120</td>
							<td>105</td>
							<td>15</td>
							<td>13</td>
							<td>14</td>
						</tr>
						<tr>
							<td>Rush</td>
							<td>120</td>
							<td>105</td>
							<td>15</td>
							<td>13</td>
							<td>14</td>
						</tr>
						<tr>
							<td>Fern</td>
							<td>120</td>
							<td>105</td>
							<td>15</td>
							<td>13</td>
							<td>14</td>
						</tr>
						<tr>
							<td>Bryophyte</td>
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
<tr>
<td>1</td>
<td>5</td>
<td>4</td>
<td>6</td>
<td>7</td>
<td>56</td>
<td>67</td>
<td>56</td>
<td>67</td>
<td>67</td>
<td>-2</td>
<td>-2</td>
<td>n/a</td>
<td>n/a</td>
</tr>
<tr>
<td>2</td>
<td>5</td>
<td>4</td>
<td>6</td>
<td>7</td>
<td>56</td>
<td>67</td>
<td>56</td>
<td>67</td>
<td>67</td>
<td>-2</td>
<td>-2</td>
<td>n/a</td>
<td>n/a</td>
</tr>
<tr>
<td>3</td>
<td>5</td>
<td>4</td>
<td>6</td>
<td>7</td>
<td>56</td>
<td>67</td>
<td>56</td>
<td>67</td>
<td>67</td>
<td>-2</td>
<td>-2</td>
<td>n/a</td>
<td>n/a</td>
</tr>
<tr>
<td>4</td>
<td>5</td>
<td>4</td>
<td>6</td>
<td>7</td>
<td>56</td>
<td>67</td>
<td>56</td>
<td>67</td>
<td>67</td>
<td>-2</td>
<td>-2</td>
<td>n/a</td>
<td>n/a</td>
</tr>
</table>

				</div>
			</div>
			<br>
			<div class="row-fluid">
				<div class="span12">	
					<h4>&#187; Quadrat 1 Species:</h4>
					<table class="table table-hover">
<tr>
<td><strong>Scientific Name</strong></td>
<td><strong>Family</strong></td>
<td><strong>Acronym</strong></td>
<td><strong>% Cover</strong></td>
<td><strong>Nativity</strong></td>
<td><strong>C</strong></td>
<td><strong>W</strong></td>
<td><strong>Wetland Status</strong></td>
<td><strong>Physiognomy</strong></td>
<td><strong>Duration</strong></td>
<td><strong>Common Name</strong></td>
</tr>                    
<tr>
<td>Acorus calamus</td>
<td>n/a</td>
<td>ACOCAL</td>
<td>15</td>
<td>Native</td>
<td>7</td>
<td>-5</td>
<td>OBL</td>
<td>Forb</td>
<td>Perennial</td>
<td>SWEET FLAG</td>
</tr>
<tr>
<td>Alisma subcordatum</td>
<td>n/a</td>
<td>ALISUB</td>
<td>15</td>
<td>Native</td>
<td>4</td>
<td>-5</td>
<td>OBL</td>
<td>Forb</td>
<td>Perennial</td>
<td>COMMON WATER PLANTAIN </td>
</tr>
<tr>
<td>Acorus calamus</td>
<td>n/a</td>
<td>ACOCAL</td>
<td>15</td>
<td>Native</td>
<td>7</td>
<td>-5</td>
<td>OBL</td>
<td>Forb</td>
<td>Perennial</td>
<td>SWEET FLAG</td>
</tr>
</table>
				</div>
			</div>
			<br>
			<div class="row-fluid">
				<div class="span12">	
					<h4>&#187; Quadrat 2 Species:</h4>
					<table class="table table-hover">
<tr>
<td><strong>Scientific Name</strong></td>
<td><strong>Family</strong></td>
<td><strong>Acronym</strong></td>
<td><strong>% Cover</strong></td>
<td><strong>Nativity</strong></td>
<td><strong>C</strong></td>
<td><strong>W</strong></td>
<td><strong>Wetland Status</strong></td>
<td><strong>Physiognomy</strong></td>
<td><strong>Duration</strong></td>
<td><strong>Common Name</strong></td>
</tr>                    
<tr>
<td>Acorus calamus</td>
<td>n/a</td>
<td>ACOCAL</td>
<td>15</td>
<td>Native</td>
<td>7</td>
<td>-5</td>
<td>OBL</td>
<td>Forb</td>
<td>Perennial</td>
<td>SWEET FLAG</td>
</tr>
<tr>
<td>Alisma subcordatum</td>
<td>n/a</td>
<td>ALISUB</td>
<td>15</td>
<td>Native</td>
<td>4</td>
<td>-5</td>
<td>OBL</td>
<td>Forb</td>
<td>Perennial</td>
<td>COMMON WATER PLANTAIN </td>
</tr>
<tr>
<td>Acorus calamus</td>
<td>n/a</td>
<td>ACOCAL</td>
<td>15</td>
<td>Native</td>
<td>7</td>
<td>-5</td>
<td>OBL</td>
<td>Forb</td>
<td>Perennial</td>
<td>SWEET FLAG</td>
</tr>
<tr>
<td>Alisma subcordatum</td>
<td>n/a</td>
<td>ALISUB</td>
<td>15</td>
<td>Native</td>
<td>4</td>
<td>-5</td>
<td>OBL</td>
<td>Forb</td>
<td>Perennial</td>
<td>COMMON WATER PLANTAIN </td>
</tr>
<tr>
<td>Acorus calamus</td>
<td>n/a</td>
<td>ACOCAL</td>
<td>15</td>
<td>Native</td>
<td>7</td>
<td>-5</td>
<td>OBL</td>
<td>Forb</td>
<td>Perennial</td>
<td>SWEET FLAG</td>
</tr>
</table>
				</div>
			</div>
			<br>
			<div class="row-fluid">
				<div class="span12">	
					<h4>&#187; Quadrat 3 Species:</h4>
					<table class="table table-hover">
<tr>
<td><strong>Scientific Name</strong></td>
<td><strong>Family</strong></td>
<td><strong>Acronym</strong></td>
<td><strong>% Cover</strong></td>
<td><strong>Nativity</strong></td>
<td><strong>C</strong></td>
<td><strong>W</strong></td>
<td><strong>Wetland Status</strong></td>
<td><strong>Physiognomy</strong></td>
<td><strong>Duration</strong></td>
<td><strong>Common Name</strong></td>
</tr>                    
<tr>
<td>Acorus calamus</td>
<td>n/a</td>
<td>ACOCAL</td>
<td>15</td>
<td>Native</td>
<td>7</td>
<td>-5</td>
<td>OBL</td>
<td>Forb</td>
<td>Perennial</td>
<td>SWEET FLAG</td>
</tr>
<tr>
<td>Alisma subcordatum</td>
<td>n/a</td>
<td>ALISUB</td>
<td>15</td>
<td>Native</td>
<td>4</td>
<td>-5</td>
<td>OBL</td>
<td>Forb</td>
<td>Perennial</td>
<td>COMMON WATER PLANTAIN </td>
</tr>
<tr>
<td>Acorus calamus</td>
<td>n/a</td>
<td>ACOCAL</td>
<td>15</td>
<td>Native</td>
<td>7</td>
<td>-5</td>
<td>OBL</td>
<td>Forb</td>
<td>Perennial</td>
<td>SWEET FLAG</td>
</tr>
</table>
				</div>
			</div>
			<br>
			<div class="row-fluid">
				<div class="span12">	
					<h4>&#187; Quadrat 4 Species:</h4>
					<table class="table table-hover">
<tr>
<td><strong>Scientific Name</strong></td>
<td><strong>Family</strong></td>
<td><strong>Acronym</strong></td>
<td><strong>% Cover</strong></td>
<td><strong>Nativity</strong></td>
<td><strong>C</strong></td>
<td><strong>W</strong></td>
<td><strong>Wetland Status</strong></td>
<td><strong>Physiognomy</strong></td>
<td><strong>Duration</strong></td>
<td><strong>Common Name</strong></td>
</tr>                    
<tr>
<td>Acorus calamus</td>
<td>n/a</td>
<td>ACOCAL</td>
<td>15</td>
<td>Native</td>
<td>7</td>
<td>-5</td>
<td>OBL</td>
<td>Forb</td>
<td>Perennial</td>
<td>SWEET FLAG</td>
</tr>
<tr>
<td>Alisma subcordatum</td>
<td>n/a</td>
<td>ALISUB</td>
<td>15</td>
<td>Native</td>
<td>4</td>
<td>-5</td>
<td>OBL</td>
<td>Forb</td>
<td>Perennial</td>
<td>COMMON WATER PLANTAIN </td>
</tr>
</table>
			
				</div>
			</div>
		</div>
    </div> 
    <br><br>