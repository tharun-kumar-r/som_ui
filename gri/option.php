<?php
include "include/@config-domain.php";
include "include/resmail/PHPMailerAutoload.php";
session_start();
$email =   $_SESSION['temp1'];
$name =   $_SESSION['temp'];


if(empty($_SESSION['suc']))
{
    echo '<script>window.location="./";</script>';
}


?>


<!-- begain code -->


<html>
	<head>

	<style>
*{
	padding:0px;
	margin:0px;
}
html,body{
	height:98%;
	place-items:center;
	align-items:center;
	display:grid;
}
</style>
<link rel="icon" type="image/png" href="./img/123.png" />

    </head>
    <link rel="stylesheet" href="./css/style.css" >
<body><center>
<div class="contain">
<?php include "include/brand_name.php"; ?>

<div style="margin:10px;">
<font class="sign">Signed As : <?php echo substr($email, 0, 20).".."; ?></font>
</div>
<div style="margin:10px;"><br>
<input type="button" onclick="window.location='student';" class="btnwhite" value="GRIEVANCE AS STUDENT">
</div>
<div style="margin:10px;">
<input type="button" onclick="window.location='public';" class="btnwhite" value="GRIEVANCE AS PUBLIC">
</div>

<div style="margin:10px;">
<input type="button" onclick="window.location='staff';" class="btnwhite" value="GRIEVANCE AS STAFF">
</div>



</div>
<br>
<?php include "include/down.php"; ?>




