    <div class="container padding-top">
		<div class="nice_margins">
			<div class="row-fluid">
				<div class="span1">
					<img src="../assets/images/blue-eyed.jpg" width="70" height="105" class="img-rounded">
					<br><br>
				</div>
				<div class="span11">
					<br>
					<h1>Your Assessments</h1>
					<button class="btn btn-info" onclick="javascript:window.location = 'new_inventory';return false;">New Inventory</button>
					<button class="btn btn-info" onclick="javascript:window.location = 'new_transect';return false;">New Transect</button>
					<button class="btn btn-info" onclick="javascript:window.location = 'new_transect';return false;">Download Summary</button>
					<button class="btn btn-info" onclick="javascript:window.location = 'view_public_assessments';return false;">View All Public Assessments</button>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span12">
					<h2>Your Inventory Assessments</h2>
					<table class="table table-hover">
						<!-- <tr>
							<td>You have not made any inventory assessments.</td> 
						</tr> -->
						<tr>
							<td><strong>Name</strong></td>
							<td><strong>Date</strong></td>
							<td><strong>Site</strong></td>
							<td><strong>Native FQI</strong></td>
							<td><strong>Public / Private</strong></td>
							<td><strong>Options</strong></td>							
						</tr>
						<tr>
							<td><a href="view_inventory.php?assessment=1">Coyote Hill 1</a></td>
							<td>7/23/2010</td>
							<td><a href="view_site.php?site=1">Somme Prairie Grove</a></td>
							<td>45.5</td>
							<td>Private</td>
							<td><a href="view_inventory.php">View</a> | <a href="edit_inventory.php">Edit</a> | <a href="download_inventory.php">Download</a> | <a href="delete_inventory.php">Delete</a></td>
						</tr>
						<tr>
							<td><a href="view_inventory.php?assessment=1">Coyote Hill 2</a></td>
							<td>6/9/2013</td>
							<td><a href="view_site.php?site=1">Somme Prairie Grove</a></td>
							<td>51.5</td>
							<td>Public</td>
							<td><a href="view_inventory.php">View</a> | <a href="edit_inventory.php">Edit</a> | <a href="download_inventory.php">Download</a> | <a href="delete_inventory.php">Delete</a></td>
						</tr>
					</table>
					<h2>Your Transect Assessments</h2>
					<table class="table table-hover">
						<!-- <tr>
							<td>You have not made any transect assessments.</td> 
						</tr> -->
						<tr>
							<td><strong>Name</strong></td>
							<td><strong>Date</strong></td>
							<td><strong>Site</strong></td>
							<td><strong>Native FQI</strong></td>
							<td><strong>Public / Private</strong></td>
							<td><strong>Options</strong></td>							
						</tr>
						<tr>
							<td><a href="view_transect.php?assessment=1">Pothole Pond</a></td>
							<td>6/8/2013</td>
							<td><a href="view_site.php?site=1">Somme Prairie Grove</a></td>
							<td>40.0</td>
							<td>Private</td>
							<td><a href="view_transect">View</a> | <a href="edit_transect">Edit</a> | <a href="download_transect">Download</a> | <a href="delete_transect">Delete</a></td>
						</tr>
					</table>
				</div>
			</div>
		</div>
    </div> 
    <br><br>