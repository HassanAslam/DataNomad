<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Excel</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>
<form method="post" id="ExcelFileImport"  enctype="multipart/form-data" style="width: 60%;float: right;background: #f1f1f1;height: 45px;line-height: 45px;padding: 0px 10px;border: 1px solid #ccc;
    margin-top: -5px;">    
  <input type="file" name="excelFile"  id="ExcelFile" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" style="float: left;width: 70%;">
  <input type="submit" class="btn btn-default" value="Import Excel">
 </form>
<div class="errors errorhide"></div>
<style>
    .errorhide{
        display: none;
    }
</style>
           <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
           <script type="text/javascript" src="jquery.form.min.js"></script>
 <script>

$(document).on("submit", "#ExcelFileImport", function(event)
{   $('.errors').removeClass('errorhide');
    $('.errors').html('Excel File Importing Started....');
    event.preventDefault();        
    $.ajax({
        url: "ajax.php",
        type: "POST",
        data: new FormData(this),
        processData: false,
        contentType: false,
        success: function (data, status)
        {    var part = JSON.parse(data); 
            $('.errors').removeClass('errorhide');
            $('.errors').html(part.message);
        },
        error: function (xhr, desc, err)
        {
            alert();//error response here
        }
    });        
});
</script>
<a href="datatables.php">Display Records</a>
</body>
</html>

