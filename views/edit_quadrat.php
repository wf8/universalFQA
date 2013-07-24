    <div class="container padding-top">
		<div class="nice_margins">
			<div class="row-fluid">
				<div class="span1">
					<img src="/assets/images/blue-eyed.jpg" width="70" height="105" class="img-rounded">
					<br><br>
				</div>
				<div class="span11">
					<br>
					<h1>Edit Quadrat</h1>
					<button class="btn btn-info" onclick="javascript:window.location = '/edit_transect';return false;">Save Changes</button> 
					<button class="btn btn-info" onclick="javascript:window.history.back(-1);return false;">Cancel</button><br>
				</div>
			</div>
			<br>
			<div class="row-fluid">
				<div class="span12">
					<label class="small-text">Quadrat Number or Name: <font class="red">*</font></label>
					<input class="field" type="text" id="change_first_name" value="1" maxlength="256" required />
 					<label class="small-text">Latitude:</label>
					<input class="field" type="text" id="change_first_name" value="" maxlength="256" /><br>
 					<label class="small-text">Longitude:</label>
					<input class="field" type="text" id="change_first_name" value="" maxlength="256" /><br>		
					<label class="small-text">% Bare Ground:</label>
					<input class="field" type="text" id="change_first_name" value="" maxlength="256" /><br>
 					<label class="small-text">% Water:</label>
					<input class="field" type="text" id="change_first_name" value="" maxlength="256" /><br>				
				</div>
			</div>
			<br>
			<div class="row-fluid">
				<div class="span12">
				<h3>FQA Database: Chicago, 1994</h3>
				<br>
				<h4>To Add Species Individually:</h4>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span4">
					<form class="form-inline">
						<input class="input-medium" id="appendedInputButton" type="text" placeholder="Scientific Name">
						<div class="input-append">
							<input class="input-mini" id="appendedInputButton" type="text" placeholder="% Cover">
							<button class="btn btn-info" type="button">Add</button>
						</div>
					</form>
				</div>
				<div class="span4">
					<form class="form-inline">
						<input class="input-medium" id="appendedInputButton" type="text" placeholder="Acronym">
						<div class="input-append">
							<input class="input-mini" id="appendedInputButton" type="text" placeholder="% Cover">
							<button class="btn btn-info" type="button">Add</button>
						</div>
					</form>
				</div>
				<div class="span4">
					<form class="form-inline">
						<input class="input-medium" id="appendedInputButton" type="text" placeholder="Common Name">
						<div class="input-append">
							<input class="input-mini" id="appendedInputButton" type="text" placeholder="% Cover">
							<button class="btn btn-info" type="button">Add</button>
						</div>
					</form>
				</div>	
			</div>
			<div class="row-fluid">
				<div class="span12">
				<h4>To Add Species In Bulk:</h4>
				List each species separated by a comma. For example: "Acorus calamus, Alisma subcordatum, Anemone virginiana, etc."<br>
				<textarea class="input-xxlarge" rows="3" id="items_location7"></textarea><br>
				<button class="btn btn-info" type="button">Add Species</button><br>
				</div>
			</div>
			<br>
			<div class="row-fluid">
				<div class="span12">	
					<h4>To Remove Species:</h4>
					Select the species to remove and click remove at the bottom of the list.<br>
					<br>
					<table class="table table-hover">
<tr>
<td></td>
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
<td><input type="checkbox" id="checkbox1" value="option1"></td>
<td>Acorus calamus</td>
<td>n/a</td>
<td>ACOCAL</td>
<td><input class="input-mini" id="percentCover" type="text" value="23"></td>
<td>Native</td>
<td>7</td>
<td>-5</td>
<td>OBL</td>
<td>Forb</td>
<td>Perennial</td>
<td>SWEET FLAG</td>
</tr>
<tr>
<td><input type="checkbox" id="checkbox1" value="option1"></td>
<td>Alisma subcordatum</td>
<td>n/a</td>
<td>ALISUB</td>
<td><input class="input-mini" id="percentCover" type="text" value="75"></td>
<td>Native</td>
<td>4</td>
<td>-5</td>
<td>OBL</td>
<td>Forb</td>
<td>Perennial</td>
<td>COMMON WATER PLANTAIN </td>
</tr>
<tr>
<td><input type="checkbox" id="checkbox1" value="option1"></td>
<td>Acorus calamus</td>
<td>n/a</td>
<td>ACOCAL</td>
<td><input class="input-mini" id="percentCover" type="text" value="10"></td>
<td>Native</td>
<td>7</td>
<td>-5</td>
<td>OBL</td>
<td>Forb</td>
<td>Perennial</td>
<td>SWEET FLAG</td>
</tr>
<tr>
<td><input type="checkbox" id="checkbox1" value="option1"></td>
<td>Alisma subcordatum</td>
<td>n/a</td>
<td>ALISUB</td>
<td><input class="input-mini" id="percentCover" type="text" value="54"></td>
<td>Native</td>
<td>4</td>
<td>-5</td>
<td>OBL</td>
<td>Forb</td>
<td>Perennial</td>
<td>COMMON WATER PLANTAIN </td>
</tr>
<tr>
<td><input type="checkbox" id="checkbox1" value="option1"></td>
<td>Acorus calamus</td>
<td>n/a</td>
<td>ACOCAL</td>
<td><input class="input-mini" id="percentCover" type="text" value="6"></td>
<td>Native</td>
<td>7</td>
<td>-5</td>
<td>OBL</td>
<td>Forb</td>
<td>Perennial</td>
<td>SWEET FLAG</td>
</tr>
<tr>
<td><input type="checkbox" id="checkbox1" value="option1"></td>
<td>Alisma subcordatum</td>
<td>n/a</td>
<td>ALISUB</td>
<td><input class="input-mini" id="percentCover" type="text" value="23"></td>
<td>Native</td>
<td>4</td>
<td>-5</td>
<td>OBL</td>
<td>Forb</td>
<td>Perennial</td>
<td>COMMON WATER PLANTAIN </td>
</tr>
</table>
				<button class="btn btn-info" onclick="javascript:window.location = 'view_site.php';return false;">Remove Selected Species</button>
				</div>
			</div>
			<br><br>
			<div class="row-fluid">
				<div class="span12">				
					<h4>Finished making changes?</h4>
					<button class="btn btn-info" onclick="javascript:window.location = '/edit_transect';return false;">Save Changes</button> 
					<button class="btn btn-info" onclick="javascript:window.history.back(-1);return false;">Cancel</button><br>
				</div>
			</div>
		</div>
    </div> 
    <br><br>