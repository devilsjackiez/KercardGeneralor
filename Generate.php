<?php
require_once __DIR__ . '/vendor/autoload.php';
include('../../config.php');
include('../../custom/include/language/en_us.lang.php');
/*include "ConnectDB.php";*/

?>
<?php
$idLead = $_GET["id"];
global $sugar_config;
mysql_connect($sugar_config['dbconfig']['db_host_name'], $sugar_config['dbconfig']['db_user_name'], $sugar_config['dbconfig']['db_password']) or die(mysql_error());
mysql_select_db($sugar_config['dbconfig']['db_name']) or die(mysql_error());
mysql_query("set names 'utf8'");
$result = mysql_query("SELECT DISTINCT l.id,l.salutation,l.first_name,l.last_name,lc.keycardimg_c,l.lead_source,lc.brand_c,lc.department_dom_c
                       FROM sugarcrm_hr.leads l join leads_cstm lc ON l.id=lc.id_c WHERE l.id='" . $idLead . "'")
or die ("Oops! cannot query");
while ($row = mysql_fetch_assoc($result)) {
    $Fname = $row['first_name'];
    $Lname = $row['last_name'];
    $PicPath = $row['keycardimg_c'];
    $Position = $row['lead_source'];
    $Brand = $row['brand_c'];
    $Department = $row['department_dom_c'];
}

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
</head>


<body>
<div id="divCir" style="margin-left:39px; background-image: url(<?php echo $PicPath; ?>); background-repeat: no-repeat; background-position: center;"></div>
<p class="font" align="center" style="font-size:1.6em;margin-top: 1em;line-height:25px;"><?php echo $Fname; ?></p>
<p class="font" align="center" style="font-size:1.6em;"><?php echo $Lname; ?></p>
<p id="fontColor" align="center"
   style="font-size:1em;line-height: 130%;font-weight: bold;margin-top: 17px;"><?php echo ''; ?><br></p>
</body>
<?php

if ($Brand == "clbs") {
    $stylesheet = file_get_contents('CSS/KeyCardCLBS.css');
} else if ($Brand == "cando" || $Brand == "wasteneriffe") {
    $stylesheet = file_get_contents('CSS/KeyCardCandoWas.css');
} else if($Department == "Accounting" || $Department == "EmployeeAdministration"
    || $Department == "BoD" || $Department == "Administration"){          //Accounting, Employee Administration,>> BoD, Administration<<
    $stylesheet = file_get_contents('CSS/KeyCardCLBS.css');
} else if($Department == "sales" || $Department == "service" || $Department == "backoffice") {                      //Sale, Service, Backoffice
    $stylesheet = file_get_contents('CSS/KeyCardCandoWas.css');
} else if ($Department == "SysOps" || $Department == "Softwaredevelopment"){                                        //SysOps, Software Development
    $stylesheet = file_get_contents('CSS/KeyCardBLUE.css');
} else if ($Department == "Marketing" || $Department == "English"){
    $stylesheet = file_get_contents('CSS/KeyCardRed.css');
} else if ($Department == "Trainer" || $Department == "HumanResources" || $Department == "WorkforceManagement"){    //Trainer, Human Resources, Workforce Management
    $stylesheet = file_get_contents('CSS/KeyCardYellow.css');
} else {
    $stylesheet = file_get_contents('CSS/KeyCardGreen.css');
}
$stylesheet .= file_get_contents('vendor/twbs/bootstrap/dist/css/bootstrap.css');
$html = ob_get_contents();
$mpdf = new mPDF('utf-8', array(53.975, 85), 0, '', 0, 0, 8, -2, 0, 0);
// Write some HTML code:
$mpdf->WriteHTML($stylesheet, 1);
$mpdf->WriteHTML($html, 2);
// Output a PDF file directly to the browser
$mpdf->Output();

?>
