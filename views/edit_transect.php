    <div class="container padding-top">
		<div class="nice_margins">
			<div class="row-fluid">
				<div class="span1">
					<img src="/assets/images/blue-eyed.jpg" width="70" height="105" class="img-rounded">
					<br><br>
				</div>
				<div class="span11">
					<br>
					<h1>Edit Transect Assessment</h1>
					<button class="btn btn-info" onclick="javascript:window.location = '/view_transect';return false;">Save Changes and View Results</button> 
					<button class="btn btn-info" onclick="javascript:window.location = '/view_assessments';return false;">Cancel</button><br>
				</div>
			</div>
			<br>
			<div class="row-fluid">
				<div class="span6">
					<p>
					<label class="small-text">Month: </label>
					<select>
  						<option>1</option>
  						<option>2</option>
  						<option>3</option>
  						<option>4</option>
  						<option>5</option>
  						<option>6</option>
  						<option selected>7</option>
  						<option>8</option>
  						<option>9</option>
  						<option>10</option>
  						<option>11</option>
  						<option>12</option>
					</select>
					<label class="small-text">Day: </label>
					<select>
  						<option selected>23</option>
					</select>
					<label class="small-text">Year: </label>
					<select>
  						<option selected>2010</option>
					</select>
				</div>	
				<div class="span6">
					<label class="small-text">Site: </label>
					<select>
  						<option>Somme Prairie Grove</option>
  						<option>Harms Woods</option>
  						<option>Deer Grove</option>
					</select>			
					<br>	
					<button class="btn btn-info" onclick="javascript:window.location = '/edit_site';return false;">Edit Selected Site</button>
					<button class="btn btn-info" onclick="javascript:window.location = '/edit_site';return false;">Create New Site</button>
				</div>		
			</div>
			<br>
			<div class="row-fluid">
				<div class="span6">
					<label class="small-text">Practitioner:</label>
					<input class="field" type="text" id="change_first_name" value="Stephen and crew" maxlength="256" /><br>
 					<label class="small-text">Latitude:</label>
					<input class="field" type="text" id="change_first_name" value="" maxlength="256" /><br>
 					<label class="small-text">Longitude:</label>
					<input class="field" type="text" id="change_first_name" value="" maxlength="256" /><br>
					<br>
					<label class="radio">
  						<input type="radio" name="publicOrPrivate" id="public_inventory" value="public">
  						Public (viewable by any users of this site)
					</label>
					<label class="radio">
  						<input type="radio" name="publicOrPrivate" id="private_inventory" value="private" checked>
  						Private (viewable only by you)
					</label>
 				</div>
 				<div class="span6">
 					<label class="small-text">Weather Notes:</label>
					<textarea rows="3" id="site_location3">Perfect breezy summer day, with storms on the horizon.</textarea><br>
 					<label class="small-text">Duration Notes:</label>
					<textarea rows="3" id="site_location3"></textarea><br>
 					<label class="small-text">Community Type Notes:</label>
					<textarea rows="3" id="site_location4"></textarea><br>
 					<label class="small-text">Other Notes:</label>
					<textarea rows="3" id="site_location5"></textarea><br>
 				</div>
 			</div>
			<br>
			<div class="row-fluid">
				<div class="span12">
					<br>
					<h3>FQA Database: Chicago, 1994</h3>
					<form class="form-inline">
						<select>
							<option selected>Chicago, 1994</option>
						</select>
						<button class="btn btn-info" onclick="javascript:window.location = 'change.php';return false;">Change FQA Database</button>
					</form>
					<br>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span12">	
					<h4>Active Quadrats:</h4>
					Select which quadrats you want actively included in the FQA calculations. The unselected quadrats will remain saved here if you wish to include them in the future.<br>
					<br>
					<table class="table table-hover">

<tr>
<td>Active?</td>
<td><strong>Quadrat</strong></td>
<td><strong>Species Richness</strong></td>
<td><strong>Latitude</strong></td>
<td><strong>Longitude</strong></td>
<td></td>
</tr>
<!-- 
<tr><td colspan=6>You have not added any quadrats yet.</td></tr>
 -->                  
<tr>
<td><input type="checkbox" id="checkbox1" value="option1" checked></td>
<td>1</td>
<td>4</td>
<td>n/a</td>
<td>n/a</td>
<td><a href="/edit_quadrat">Edit</a> | <a href="/delete_quadrat">Delete</a></td>
</tr>
<tr>
<td><input type="checkbox" id="checkbox1" value="option1" checked></td>
<td>2</td>
<td>7</td>
<td>n/a</td>
<td>n/a</td>
<td><a href="/edit_quadrat">Edit</a> | <a href="/delete_quadrat">Delete</a></td></tr>
<tr>
<td><input type="checkbox" id="checkbox1" value="option1" checked></td>
<td>3</td>
<td>2</td>
<td>n/a</td>
<td>n/a</td>
<td><a href="/edit_quadrat">Edit</a> | <a href="/delete_quadrat">Delete</a></td></tr>
<tr>
<td><input type="checkbox" id="checkbox1" value="option1" checked></td>
<td>4</td>
<td>13</td>
<td>n/a</td>
<td>n/a</td>
<td><a href="/edit_quadrat">Edit</a> | <a href="/delete_quadrat">Delete</a></td></tr>	

</table>
			<button class="btn btn-info" onclick="javascript:window.location = '/new_quadrat';return false;">Create New Quadrat</button>
	
			<br><br><br>
			<div class="row-fluid">
				<div class="span12">				
					<h4>Finished making changes?</h4>
					<button class="btn btn-info" onclick="javascript:window.location = '/view_transect';return false;">Save Changes and View Results</button> 
					<button class="btn btn-info" onclick="javascript:window.history.back(-1);return false;">Cancel</button><br>
				</div>
			</div>
		</div>
    </div> 
    <br><br>