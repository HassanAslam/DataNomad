<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Data Tables</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script rel="stylesheet" src="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css"></script>
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css"/>
</head>
<body>
	<table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Date</th>
                <th>RoomNo</th>
                <th>Annotator</th>
                <th>Labeling</th>
                <th>Labeling_ahts</th>
                <th>LabelingSpeech</th>
                <th>LabelingSpeechDurations</th>
                <th>LabelingAccuracy</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Date</th>
                <th>RoomNo</th>
                <th>Annotator</th>
                <th>Labeling</th>
                <th>Labeling_ahts</th>
                <th>LabelingSpeech</th>
                <th>LabelingSpeechDurations</th>
                <th>LabelingAccuracy</th>
            </tr>
        </tfoot>
    </table>
<script type="text/javascript">
	$(document).ready(function() {
    $('#example').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": "script.php"
    } );
} );
</script>
</body>
</html>