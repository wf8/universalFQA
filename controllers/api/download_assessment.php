<?php
if( session_status() != PHP_SESSION_NONE ) {

    $assessment_type = $_SESSION['assessment_type'];
    $id = intval($_SESSION['id']);

    if ($assessment_type == 'inventory')
        $assessment = new InventoryAssessment( $id );
    else
        $assessment = new TransectAssessment( $id );

    if ($assessment->private != 'private') {
        $data = $assessment->get_data_array();
        echo '{ "status" : "success", "data" : ' . json_encode($data) . '}';
    } else {
        echo '{ "status" : "error", "message" : "The requested assessment is not public" }';
    }
    session_destroy();
}
?>
