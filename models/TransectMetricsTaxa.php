<?php
class TransectMetricsTaxa {

	public $taxa; // a Taxa or CustomTaxa object
	public $frequency; // number of times this taxa is found in the transect
	public $coverage; // total coverage for this taxa in transect
	public $percent_cover; // average percent cover for this taxa in the transect
	public $relative_frequency;
	public $relative_cover;
	public $relative_importance_value;
}
