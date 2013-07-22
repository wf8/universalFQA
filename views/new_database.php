    <div class="container padding-top">
		<div class="nice_margins">
			<div class="row-fluid">
				<div class="span1">
					<img src="../assets/images/blue-eyed.jpg" width="70" height="105" class="img-rounded">
					<br><br>
				</div>
				<div class="span11">
					<br>
					<h1>Upload New Public FQA Database</h1>
					<button class="btn btn-info" onclick="javascript:window.location = 'view_databases';return false;">Cancel</button>
					<br>
				</div>
			</div>
			<br>
			<div class="row-fluid">
				<div class="span12">
					<h4>&#187; 1. Enter the FQA Database Details:</h4>
					<form action="ajax/database_import" method="post" enctype="multipart/form-data" target="upload_target" onsubmit="start_database_upload();">
					<label class="small-text">Region Name: (What region does this database cover?)<font class="red">*</font></label>
					<input class="medium" type="text" name="region" value="" maxlength="256" required />
					<label class="small-text">Year Published: (When was this database originally developed?)<font class="red">*</font></label>
					<input class="medium" type="text" name="year" value="" maxlength="4" required />
					<label class="small-text">Description: (Who or what organization developed this database? Provide a citation of the published source if possible.)<font class="red">*</font></label>
					<input class="medium" type="text" name="description" value="" maxlength="256" required />
				</div>
			</div>
			<br>
			<div class="row-fluid">
				<div class="span12">	
				
				
		
					<h4>&#187; 2. Format the spreadsheet to upload:</h4>
					
					<p>
					Format the database into a comma-separated file (CSV) spreadsheet file.
					</p>
					<p>
					The columns should be organized as follows:
					</p>
					<pre>scientific name, family, acronym, nativity, coefficient of conservatism, coefficient of wetness, physiognomy, duration, common name</pre>
					<p>
					Only the scientific name, nativity, and coefficient of conservatism columns are required. The other columns may be left blank, though the more the better. 
					</p>
					<p><strong>Formatting rules for each column:</strong></p>
					<p>
					<ul>
					<li>Scientific name must be standard binomial nomenclature (<em>Quercus alba</em>).</li>
					<li>Family should be the formal scientific name (Liliaceae, not lily).</li>
					<li>Acronym can be a 3-8 letter acronym that is commonly used in field work to abbreviate the scientific name.</li>
					<li>Nativity must be either "native" or "non-native". Other terms such as "introduced", "alien", "adventive" will not be recognized.</li>
					<li>Coefficient of conservatism must be an integer from 0-10. Non-native = 0.</li>
					<li>Coefficient of wetness can be an integer from -5 to 5. These correspond with the USFWS Wetland Indicator Status.
						<ul>
  							<li>-5 = Obligate Wetland = OBL</li>
  							<li>-4 = Facultative Wetland+ = FACW+</li>
  							<li>-3 = Facultative Wetland = FACW</li>
  							<li>-2 = Facultative Wetland- = FACW-</li>
  							<li>-1 = Facultative+ = FAC+</li>
  							<li>0 = Facultative = FAC</li>
  							<li>1 = Facultative- = FAC-</li>
  							<li>2 = Facultative Upland+ = FACU+</li>
  							<li>3 = Facultative Upland = FACU</li>
  							<li>4 = Facultative Upland- = FACU-</li>
  							<li>5 = Upland = UPL</li>
						</ul>
					</li>
					<li>Physiognomy can be any of the following terms: "fern", "forb", "grass", "rush", "sedge", "shrub", "tree", "vine", or "bryophyte". Other terms won't be recognized.</li>
					<li>Duration can be "annual", "biennial", or "perennial". Other terms won't be recognized.</li>
					</ul>
					</p>
					<p>Here is an example with all the columns filled out:</p>
<pre>Adiantum pedatum, Pteridaceae, ADIPED, native, 6, 1, fern, perennial, maidenhair fern
Alliaria petiolata, Brassicaceae, ALLPET, non-native, 0, 0, forb, biennial, garlic mustard
</pre>
					<p>Here is an example with only the bare minimum columns filled out:</p>
<pre>Adiantum pedatum,,, native, 6,,,,
Alliaria petiolata,,, non-native, 0,,,,
</pre>									
				</div>
			</div>
			<br><br>
			<div class="row-fluid">
				<div class="span12">				
					<h4>&#187; 3. Upload the spreadsheet:</h4>
					<input type="file" id="upload_file" name="upload_file"><br>
					<button type="submit" class="btn btn-info">Upload</button>
					<button class="btn btn-info" onclick="javascript:window.location = 'view_databases';return false;">Cancel</button>
					</form>
					<br><br>
					<div id="upload_error"></div>
					<br><br>
				</div>
			</div>
		</div>
    </div> 