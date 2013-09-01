    <div class="container padding-top">
		<div class="nice_margins">
			<div class="row-fluid">
				<div class="span1">
					<img src="/assets/images/blue-eyed.jpg" width="70" height="105" class="img-rounded">
					<br><br>
				</div>
				<div class="span11">
					<br>
					<h1>Compare Species Coefficients</h1>
					<br>
				</div>
			</div>
			<br>
			<div class="row-fluid">
				<div class="span12">
					<h4>Enter all or part of a species binomial:</h4>
					<input class="medium" type="text" id="species" value="" required /><br>
					<button class="btn btn-info" onclick="javascript:compare_coefficients();return false;">Search</button>
					<button class="btn btn-info" onclick="javascript:window.location='view_databases';return false;">Cancel</button>
				</div>
			</div>
			<div class="row-fluid">
				<div id="results" class="span12">
				</div>
			</div>
		</div>
		<br><br><br>
    </div> 
