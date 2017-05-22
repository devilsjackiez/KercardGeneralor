<?php
require_once __DIR__ . '/vendor/autoload.php';
include('../../config.php');
include('../../custom/include/language/en_us.lang.php');
/*include "ConnectDB.php";*/

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans"/>

    <link rel="stylesheet" media="print" href="vendor/twbs/bootstrap/dist/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>


    body {
        background-image: url("TemplateFile/Violet3.png");
        background-blend-mode:lighten;
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-position: top center;
        margin: 0;
        padding: 0;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;

    }

    p {
        align-content: center;
    }
    .img-circle {
        /*    display: block;
            margin: 0 auto;
            height: auto;
            width: 150%;
            margin: 0 0 0 -20%;*/
        /*    -webkit-border-radius: 50%;
            -moz-border-radius: 50%;
            -ms-border-radius: 50%;
            -o-border-radius: 50%;*/
        border-radius: 50%;
        color: white;
    }

    #divCir {
        border-radius: 50%;
        /*background-image: url("Jackie.jpg");*/
        background-repeat: no-repeat;
        height: 130px;
        width: 130px;
        max-width: 130px;
        max-height: 130px;
        background-size: 100%;
        margin-top: 10px;

    }
    body{
        /*          margin-top: 2.54cm;
                  margin-bottom: 2.54cm;
                  margin-left: 3.175cm;
                  margin-right: 3.175cm;*/
    }
    #DivContent {
        align-content: center;
    }
    .font{
        font-family: 'Open Sans', Arial, sans-serif;
        font-weight: normal;
        color: white;
        /*etter-spacing: 0.035cm;*/
    }

    footer{
        /*align-items: right;
        color: white;
        margin-left: 160px;
        !*margin-top: 20px;*!*/
        color: white;
        position: fixed;
        bottom: 0px;
        align-content: right;
    }
    #fontColor{
        color: white;
        white-space: normal;
    }
</style>
</head>


<body>
<?php
//$idLead = $_GET["id"];
global $sugar_config;
mysql_connect($sugar_config['dbconfig']['db_host_name'], $sugar_config['dbconfig']['db_user_name'], $sugar_config['dbconfig']['db_password']) or die(mysql_error());
mysql_select_db($sugar_config['dbconfig']['db_name']) or die(mysql_error());
mysql_query("set names 'utf8'");
$result = mysql_query("select id_c,first_name,last_name,keycardimg_c,brand_c from leads l JOIN leads_cstm lc ON l.id=lc.id_c WHERE status='Converted' AND deleted=0 AND length(keycardimg_c)>10 ORDER BY brand_c,l.date_entered DESC")
or die ("Oops! cannot query");
while ($row = mysql_fetch_assoc($result)) {
    $id = $row['id_c'];
    $fname = $row['first_name'];
    $lname = $row['last_name'];
    $picpath = $row['keycardimg_c'];
    $brand = $row['brand_c'];

    ?>
    <div id="divCir" style="margin-left:39px; background-image: url(<?php echo $picpath; ?>); background-repeat: no-repeat; background-position: center; "></div>
    <p style="color:#fff; font-weight: bold;"><?php echo "HRM ID: ".$id." , Brand: ".$brand;?></p>

<?php } ?>
</body>