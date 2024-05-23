<?php
include "include/@config-domain.php";
session_start();
echo '<script>window.history.replaceState(100, 
"", "./"); </script>';



if(empty($_SESSION['suc']))
{
    echo '<script>window.location="./";</script>';
}
else{
session_destroy();
}
?>

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
<link rel="stylesheet" href="./css/style.css" >
    </head>
    
<body><center>
<div class="contain">
<?php include "include/brand_name.php"; ?>
<div style="margin:10px;"><br>
<font color="#008040" size="11"><i class="fas fa-check-circle"></i></font>
<br>
<font color="#252526" size="4"><b>Grievance Submitted Successfully!.</b></font>
<div style="margin:10px;">
<input type="button" onclick="window.location='/';" class="btnwhite" value="GRIEVANCE HOME">
</div>
<div style="margin:10px;">
<input type="button" onclick="window.location='student-login';" class="btnblue" value="CHECK GRIEVANCE STATUS">
</div>





</div>
</div>
<br><BR>
<?php include "include/down.php"; ?>






