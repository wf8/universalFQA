	<script type="text/javascript" src="/assets/js/MathJax/MathJax.js?config=TeX-AMS-MML_HTMLorMML"></script>
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
						<li><a href="/help/faq">FAQ</a></li>
						<li class="active"><a href="/help/terminology">Terminology</a></li>
					</ul>
					<br>
					<p class="nice-text">					
					Below are descriptions of the calculations used for Inventory and Transect assessments where species \(i\) has the conservatism coefficent \(C_i\) and the wetness coefficient \(W_i\). The wetness coefficients correspond with the USFWS Wetland Indicator Status.
					</p>
					<table class="table nice-text">
						<tr><td><strong>Term</strong></td><td><strong>Description</strong></td><td><strong>Calculation</strong></td><tr>
						<tr>
							<td>Total species richess</td>
							<td>Total number of native and non-native species.</td>
							<td>\( N_t \)</td>
						</tr>
						<tr>
							<td>Native species richess</td>
							<td>Number of native species.</td>
							<td>\( N_n \)</td>
						</tr>
						<tr>
							<td>Mean wetness</td>
							<td>Mean wetness coefficient for all species.</td>
							<td>\( \overline{W_t} = \sum\limits_{i=0}^{t} W_i \Big/ N_t \)</td>
						</tr>
						<tr>
							<td>Native mean wetness</td>
							<td>Mean wetness coefficient for native species.</td>
							<td>\( \overline{W_n} = \sum\limits_{i=0}^{n} W_i \Big/ N_n \)</td>
						</tr>
						<tr>
							<td>Total mean C</td>
							<td>Mean conservatism coefficient for all native and non-native species.</td>
							<td>\( \overline{C_t} = \sum\limits_{i=0}^{t} C_i \Big/ N_t \)</td>
						</tr>
						<tr>
							<td>Native mean C</td>
							<td>Mean conservatism coefficient for native species.</td>
							<td>\( \overline{C_n} = \sum\limits_{i=0}^{n} C_i \Big/ N_n \)</td>
						</tr>
						<tr>
							<td>Total FQI</td>
							<td>Floristic quality index: total mean C multiplied by the square root of the total species richness.</td>
							<td>\( FQI_t = \overline{C_t} \sqrt{N_t} \)</td>
						</tr>
						<tr>
							<td>Native FQI</td>
							<td>Floristic quality index: native mean C multiplied by the square root of the native species richness.</td>
							<td>\( FQI_n = \overline{C_n} \sqrt{N_n} \)</td>
						</tr>
						<tr>
							<td>Adjusted FQI</td>
							<td>Adjusted floristic quality index: 100 multiplied by the native mean C divided by 10 and multiplied by the square root of the native species richness divided by total species richess.</td>
							<td>\( AFQI_t = 100 \Big(\frac{\overline{C_n}}{10}\Big) \Big(\frac{\sqrt{N_n}}{\sqrt{N_t}}\Big) \)</td>
						</tr>
					</table>
					<br>
					<p class="nice-text">					
					This table describes additional calculations used for Transect assessments where species \(i\) has the percent cover \(\gamma_i\). 			
					</p>
					<table class="table nice-text">
						<tr><td><strong>Term</strong></td><td><strong>Description</strong></td><td><strong>Calculation</strong></td><tr>
						<tr>
							<td>Cover-weighted mean C</td>
							<td>The sum of each native and non-native species' conservatism coefficient multiplied by its cover divided by the total cover for all species.</td>
							<td>\( \overline{C_{t{\gamma}}} = \sum\limits_{i=0}^{t} C_i \gamma_i \Big/ \sum\limits_{i=0}^{t} \gamma_i \)</td>
						</tr>
						<tr>
							<td>Cover-weighted native mean C</td>
							<td>The sum of each native species' conservatism coefficient multiplied by its cover divided by the total cover for all native species.</td>
							<td>\( \overline{C_{n{\gamma}}} = \sum\limits_{i=0}^{n} C_i \gamma_i \Big/ \sum\limits_{i=0}^{n} \gamma_i \)</td>
						</tr>
						<tr>
							<td>Cover-weighted FQI</td>
							<td>Cover-weighted total mean C multiplied by the square root of the total species richness.</td>
							<td>\( FQI_{t{\gamma}} = \overline{C_{t{\gamma}}} \sqrt{N_t} \)</td>
						</tr>
						<tr>
							<td>Cover-weighted Native FQI</td>
							<td>Cover-weighted native mean C multiplied by the square root of the native species richness.</td>
							<td>\( FQI_{n{\gamma}} = \overline{C_{n{\gamma}}} \sqrt{N_n} \)</td>
						</tr>
						<tr>
							<td>Relative frequency (%)</td>
							<td>The frequency of this species or physiognomic group divided by the frequency of all species or physiognomic groups.</td>
							<td>\( \mu_r = 100 \Big(\mu_i \Big/ \sum\limits_{i=0}^{t} \mu_i\Big) \)</td>
						</tr>
						<tr>
							<td>Relative coverage (%)</td>
							<td>The total coverage of this species or physiognomic group divided by the total coverage of all species or physiognomic groups.</td>
							<td>\( \gamma_r = 100 \Big(\gamma_i \Big/ \sum\limits_{i=0}^{t} \gamma_i\Big) \)</td>
						</tr>
						<tr>
							<td>Relative importance value</td>
							<td>The average of relative frequency and relative coverage.</td>
							<td>\( RIV = \Big(\mu_r + \gamma_r\Big) \Big/ 2 \)</td>
						</tr>
					</table>
					<br>
				</div>
			</div>
			<br><br>
		</div>