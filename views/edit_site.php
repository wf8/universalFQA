    <div class="container padding-top">
		<div class="nice_margins">
			<div class="row-fluid">
				<div class="span1">
					<img src="/assets/images/blue-eyed.jpg" width="70" height="105" class="img-rounded">
					<br><br>
				</div>
				<div class="span11">
					<br>
					<h1>Edit Site</h1>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span4">
					<label class="small-text">Name: <font class="red">*</font></label>
					<input class="input-medium" type="text" id="change_first_name" value="Somme Prairie Grove" size="23" maxlength="23" required />
			<!--		<label class="small-text">Location: (short description)</label>
					<textarea rows="3" cols="23" id="site_location"></textarea>  -->
					<label class="small-text">Notes:</label>
					<textarea rows="3" cols="23" id="site_notes"></textarea>
				</div>	
				<div class="span8">	
					<label class="small-text">City:</label>
					<input class="input-medium" type="text" id="change_first_name" value="Northbrook" size="23" maxlength="256" />
					<label class="small-text">County:</label>
					<input class="input-medium" type="text" id="change_first_name" value="Cook" size="23" maxlength="256" />
					<label class="small-text">State:</label>
					<input class="input-medium" type="text" id="change_first_name" value="Illinois" size="23" maxlength="256" />
					<label class="small-text">Country:</label>
					<input class="input-medium" type="text" id="change_first_name" value="USA" size="23" maxlength="256" />
					<br><br>
					<button class="btn btn-info" onClick="save_site_changes();">Save Changes</button> 
					<button class="btn btn-info" onclick="javascript:window.history.back(-1);return false;">Done</button><br>
					<font class="red">* required</font>
				</div>
			</div>
		</div>
    </div> 
    <br><br>