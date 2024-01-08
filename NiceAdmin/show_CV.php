<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
        $pdffile = "CV/".$_GET['nameCV'];
        $pdffilename = $_GET['nameCV'];
        
        header('Content-type: application/pdf');
        header('Content-Disposition: inline; filename="' . $pdffilename . '"');
        header("Content-Transfer-Encoding: binary");
        header('Accept-Ranges: bytes');
        @readfile($pdffile);
    ?>
</body>
</html>