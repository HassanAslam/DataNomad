<?php
//Using Server side processing of datatables
$table = 'excel_data';
$primaryKey = 'id';
$columns = array(
    array( 'db' => 'Date', 'dt' => 0 ),
    array( 'db' => 'RoomNo', 'dt' => 1 ),
    array( 'db' => 'Annotator','dt' => 2 ),
    array( 'db' => 'Labeling',  'dt' => 3 ),
    array( 'db' => 'Labeling_ahts','dt' => 4 ),
    array( 'db' => 'LabelingSpeech', 'dt' => 5 ),
    array( 'db' => 'LabelingSpeechDurations', 'dt' => 6 ),
    array( 'db' => 'LabelingAccuracy', 'dt' => 7 )
);
// SQL server connection information
$sql_details = array(
    'user' => 'root',
    'pass' => '',
    'db'   => 'excel',
    'host' => 'localhost'
);
 
require( 'ssp.class.php' );
 
echo json_encode(
    SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
);