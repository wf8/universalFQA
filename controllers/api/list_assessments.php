<?php
if( session_status() != PHP_SESSION_NONE ) {

    $database_id = intval($_SESSION['database_id']);
    $assessment_type = $_SESSION['assessment_type'];

    if ($assessment_type == 'inventory') {
        $inventory = new InventoryAssessment;
        $assessments = $inventory->get_all_public_for_fqa($database_id);
    } else {
        $transect = new TransectAssessment;
        $assessments = $transect->get_all_public_for_fqa($database_id);
    }

    $data = array();
    foreach ($assessments as $assessment) {
        $assessment_data = array();
        $assessment_data[] = $assessment->id;
        $assessment_data[] = $assessment->name; 
        $assessment_data[] = $assessment->date;
        $assessment_data[] = $assessment->site->name;
        $assessment_data[] = $assessment->practitioner;
        $data[] = $assessment_data;
    }
    echo '{ "status" : "success", "data" : ' . json_encode($data) . '}';
}
session_destroy();
?>
