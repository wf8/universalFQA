    <div class="container padding-top">
		<div class="nice_margins">
			<div class="row-fluid">
				<div class="span1">
					<img src="/assets/images/blue-eyed.jpg" width="70" height="105" class="img-rounded">
					<br><br>
				</div>
				<div class="span11">
					<br>
					<h1>Documentation</h1>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span12">
				
					<ul class="nav nav-tabs">
						<li><a href="/help">Introduction</a></li>
						<li class="active"><a href="/help/faq">FAQ</a></li>
						<li><a href="/help/terminology">Terminology</a></li>
					</ul>
					<br>
					<p class="nice-text">
						Frequently asked questions:
					</p>
					<div class="accordion nice-text" id="accordion2">
						<div class="accordion-group">
							<div class="accordion-heading">
								<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse00">
									How do I use the FQA Calculator out in the field?
								</a>
							</div>
							<div id="collapse00" class="accordion-body collapse">
								<div class="accordion-inner">
									This site has been designed using components that are responsive to different devices and screen resolutions, including tablets and smartphones. As long as you have a network connection, you can use the FQA Calculator in the field or in the office.
								</div>
							</div>
						</div>
						<div class="accordion-group">
							<div class="accordion-heading">
								<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
									Who can see my assessments?
								</a>
							</div>
							<div id="collapseOne" class="accordion-body collapse">
								<div class="accordion-inner">
									If you make your assessment <text class="text-warning">private</text> then your assessment will only be visible to you.
									If you make your assessment <text class="text-warning">public</text> then your assessment will be visible to anyone who uses this site.
								</div>
							</div>
						</div>
						<div class="accordion-group">
							<div class="accordion-heading">
								<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseAFQA">
									What is Adjusted FQI?
								</a>
							</div>
							<div id="collapseAFQA" class="accordion-body collapse">
								<div class="accordion-inner">
									This is a variation of FQI that reduces the effect of species richness on FQI and has been found useful to compare degraded sites. Please see:<br>Miller, S.J., and D.H. Wardrop. 2006. <em>Adapting the Floristic Quality Assessment Index to Indicate Anthropogenic Disturbance in Central Pennsylvania Wetlands.</em> Ecological Indicators 6 (2) (April): 313–326.
								</div>
							</div>
						</div>
						<div class="accordion-group">
							<div class="accordion-heading">
								<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse11">
									For transect quadrats, how are % bare ground and % water included in the calculations?
								</a>
							</div>
							<div id="collapse11" class="accordion-body collapse">
								<div class="accordion-inner">
									If % bare ground and/or % water are included in a transect's quadrat, they will be included in the species-level Relative Importance Value calculations for the entire transect. This is helpful to indicate the relative importance of bare ground or water compared to each species.
								</div>
							</div>
						</div>

						<div class="accordion-group">
							<div class="accordion-heading">
								<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse12">
									For transect quadrats, can I use the Braun-Blanquet cover abundance scale?
								</a>
							</div>
							<div id="collapse12" class="accordion-body collapse">
								<div class="accordion-inner">
									Yes, cover values can be either 1-5 using the Braun-Blanquet scale, or 1-100 representing % cover. The type of cover values used should be consistent throughout the transect assessment.
								</div>
							</div>
						</div>
						<div class="accordion-group">
							<div class="accordion-heading">
								<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">
									Why are some details about my assessment shown as n/a?
								</a>
							</div>
							<div id="collapseTwo" class="accordion-body collapse">
								<div class="accordion-inner">
									Some FQA databases do not contain species data for duration, acronym, physiognomy, etc. If your assessment uses an FQA database without these data, it will be shown as n/a.
								</div>
							</div>
						</div>
						<div class="accordion-group">
							<div class="accordion-heading">
								<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseThree">
									Who runs this site? How safe is my data?
								</a>
							</div>
							<div id="collapseThree" class="accordion-body collapse">
								<div class="accordion-inner">
									This site was developed for <a href="http://www.openlands.org/">Openlands</a>, a non-profit conservation organization based in Chicago, Illinois, USA. Use of the site is offered to the public free of charge, and all data will be kept secure. Your data will not be released or used for advertising, research, or any other purpose. Please <a href="/about">contact us</a> if you have more questions.
								</div>
							</div>
						</div>
						<div class="accordion-group">
							<div class="accordion-heading">
								<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseFour">
									What format are the downloaded reports in?
								</a>
							</div>
							<div id="collapseFour" class="accordion-body collapse">
								<div class="accordion-inner">
									Downloaded reports are CSV (comma-separated values) files that can be easily opened in any spreadsheet application such as Microsoft Excel.
								</div>
							</div>
						</div>
						<div class="accordion-group">
							<div class="accordion-heading">
								<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseFour0">
									What are Transect Strings and Inventory Strings?
								</a>
							</div>
							<div id="collapseFour0" class="accordion-body collapse">
								<div class="accordion-inner">
								Transect Strings and Inventory Strings are specially formatted files used to export data from the original FQA software developed by the Conservation Design Forum in 2000. If users have any of these files they can import them into the Universal FQA Calculator when creating an assessment.
								</div>
							</div>
						</div>
						<div class="accordion-group">
							<div class="accordion-heading">
								<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseAPI">
									How do I use the API to access public data?
								</a>
							</div>
							<div id="collapseAPI" class="accordion-body collapse">
								<div class="accordion-inner">
                                Data for all FQA databases and public assessments can be accessed through a RESTful web API that returns JSON.<br><br>
                                To list all FQA databases:<br>
                                <a href="http://universalfqa.org/get/database/">http://universalfqa.org/get/database/</a><br>
                                To download a specific FQA database:<br>
                                <a href="http://universalfqa.org/get/database/1">http://universalfqa.org/get/database/1</a><br>
                                To list all public inventory assessments using a certain FQA database:<br>
                                <a href="http://universalfqa.org/get/database/1/inventory">http://universalfqa.org/get/database/1/inventory</a><br>
                                To list all public transect assessments using a certain FQA database:<br>
                                <a href="http://universalfqa.org/get/database/1/transect">http://universalfqa.org/get/database/1/transect</a><br>
                                To download a specific public inventory assessment:<br>
                                <a href="http://universalfqa.org/get/inventory/2629">http://universalfqa.org/get/inventory/2629</a><br>
                                To download a specific public transect assessment:<br>
                                <a href="http://universalfqa.org/get/transect/1082">http://universalfqa.org/get/transect/1082</a><br>
								</div>
							</div>
						</div>
						<div class="accordion-group">
							<div class="accordion-heading">
								<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseCite">
									How do I cite the use of this computer program?
								</a>
							</div>
							<div id="collapseCite" class="accordion-body collapse">
								<div class="accordion-inner">
									Freyman, W.A. and L.A. Masters. 2013. <em>The Universal Floristic Quality Assessment (FQA) Calculator</em> [Computer program]. Available at http://universalFQA.org (Accessed date)
                                    <br><br>
                                    You should also cite the FQA database used to calculate your assessment.
								</div>
							</div>
						</div>
						<div class="accordion-group">
							<div class="accordion-heading">
								<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse5">
									Other questions?
								</a>
							</div>
							<div id="collapse5" class="accordion-body collapse">
								<div class="accordion-inner">
									Please <a href="/about">email</a> me!
								</div>
							</div>
						</div>
					</div>
					
					<br>
				</div>
			</div>
			<br><br>
		</div>
