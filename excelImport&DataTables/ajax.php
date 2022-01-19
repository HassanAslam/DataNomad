<?php 
error_reporting(E_ERROR);
//error_reporting(E_ALL);
function importExcelFile()
{
    $mysqli = new mysqli("localhost","root","","excel");

    if ($mysqli->connect_errno)  return ['status'=>'error','message'=>"Failed to connect to MySQL: " . $mysqli->connect_error];
    $allowedExts = array("xlsx","xls","csv");
    $temp = explode(".", $_FILES["excelFile"]["name"]);
    $extension = end($temp);
    //$file = $_FILES["excelFile"]["name"];

    if(!in_array($extension, $allowedExts)) return ['status'=>'error','message'=>'File Type '.$extension.' not allowd'];
    if ($_FILES["excelFile"]["error"] > 0) return ['status'=>'error','message'=>"Return Code: " . $_FILES["excelFile"]["error"]];
    $directory = "uploads/";
    $filename = time().".".$extension;
    if(!move_uploaded_file($_FILES["excelFile"]["tmp_name"],$directory.$filename))
         return ['status'=>'error','message'=>'File Uploading failed in '.$directory.' directory'];

    include('excel_reader2.php');
    include('SpreadsheetReader.php');
    //Import any XLS, XLSX, CSV files by using these libraries.
    if(strtolower($extension) == 'csv') include('SpreadsheetReader_CSV.php');
    if(strtolower($extension) == 'xlsx') include('SpreadsheetReader_XLSX.php');

    $filePath = $directory.$filename;

    date_default_timezone_set('UTC');
    $htmlMessage = "Excel Sheets Started Initilized";
    $StartMem = memory_get_usage();

    $errors = [];
    try{
        $Reader = new SpreadsheetReader($filePath);
        $Sheets = $Reader->Sheets();
        $sheetCounts = count($Sheets);
        $htmlMessage .= 'Total Excel Sheets : '.$sheetCounts.'<br>';
        foreach ($Sheets as $Index => $Name)
        {
            $htmlMessage .= '*** Sheet '.$Name.' Started ***<br>';
            $Reader->ChangeSheet($Index);
            $i=0;
            foreach ($Reader as $Row)
            {
                $i++;
                if($i>1)
                {
                    $Date   = $Row[0];
                    $RoomNo = $Row[1];
                    $Annotator  = $Row[2];
                    $Labeling   = $Row[3];
                    $Labeling_ahts  = $Row[4];
                    $LabelingSpeech = $Row[5];
                    $LabelingSpeechDurations    = $Row[6];
                    $LabelingAccuracy   = $Row[7];            
                $isAdded = $mysqli->query("INSERT INTO excel_data (Date,RoomNo,Annotator,Labeling,Labeling_ahts,LabelingSpeech,LabelingSpeechDurations,LabelingAccuracy) VALUES ('$Date','$RoomNo','$Annotator','$Labeling','$Labeling_ahts','$LabelingSpeech','$LabelingSpeechDurations','$LabelingAccuracy')");
                if(!$isAdded) $errors[] = "Error During Insertion at Row No: ".$i." and Error is : " . $mysqli->error;  
                }      
            }
            $htmlMessage .= '*** Sheet '.$Name.' Ended ***<br>';
        }
        $mysqli -> close();
            $htmlMessage .= '*** Sheet Imported Successfully ***<br>';
            if(!empty($errors)){
                $errorsText = implode(' <br> ',$errors);
                $htmlMessage .=$errorsText;
             return ['status'=>'waring','message'=>$htmlMessage];
            }
            return ['status'=>'success','message'=>$htmlMessage];
    }catch (Exception $e)
    {
        return ['status'=>'error','message'=>$e->getMessage()];
    }
}

$isImported = importExcelFile();
echo json_encode($isImported);