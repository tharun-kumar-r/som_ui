<?php
include "../include/@config-domain.php";
//require "../include/resmail/PHPMailerAutoload.php";
session_start();
$myfile = fopen("../clgname.txt", "r") or die("error");
$clgname = "OTP For Grievance @" . fread($myfile,filesize("../clgname.txt"));
fclose($myfile);
if(!empty($_SESSION['gemailauth']))
{
	echo '<script>window.location="verify";</script>';

}
if(!empty($_SESSION['dash-std']))
{
	echo '<script>window.location="../student-login/dashboard";</script>';

}



if(isset($_POST['val1']))
{
$email = $_POST['email'];
$opt = rand(9,99999);
$_SESSION['authstd'] = $opt;

function sendm($emai,$ot,$mail,$clgnam)
{



$message = '<center><h1>OTP For Online Grievance is</h1><font size="6" color="white" style="padding:3px 20px;background:#0080ff;">'. $ot . "</font>";
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= 'From: <Online_Grievance@rajsoft.org.com>' . "\r\n";

if (mail($emai,$clgname,$message,$headers)) {

	$_SESSION['gemailauth'] = $emai;
	echo '<script>window.location="verify";</script>';




 }
 
else {



	echo "<script>alert('Poor Network! if not poor network it may Server Error please Conatact admin')</script>";



	//edd
}
}





$sql_quer = "SELECT count(*) as ntUser FROM staff WHERE email='$email'";
$resul = mysqli_query($con,$sql_quer);
$ro = mysqli_fetch_array($resul);
$coun = $ro['ntUser'];
if($coun > 0)
{
	sendm($email,$opt,$mail,$clgname);
}else{

	$sql_quer = "SELECT count(*) as ntUser FROM publi_c WHERE email='$email'";
	$resul = mysqli_query($con,$sql_quer);
	$ro = mysqli_fetch_array($resul);
	$coun = $ro['ntUser'];
	if($coun > 0)
	{
		sendm($email,$opt,$mail,$clgname);

	}else{
	
		$sql_quer = "SELECT count(*) as ntUser FROM student WHERE email='$email'";
		$resul = mysqli_query($con,$sql_quer);
		$ro = mysqli_fetch_array($resul);
		$coun = $ro['ntUser'];
		if($coun > 0)
		{
			sendm($email,$opt,$mail,$clgname);
		}
		else
		{
		
		$error = '<font size="2" color="red">No grievances are submitted with this email, Please submit the grievance first to login!.</font>';
			
		}
		
	}

}


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
	height:100%;
	place-items:center;
	align-items:center;
	display:grid;
}
</style>
<link rel="icon" type="image/png" href="../img/123.png" />
<link rel="stylesheet" href="../font/font.css">
<link rel="stylesheet" href="../css/style.css">

	</head>
<body><center>
<div class="contain">
<?php include "../include/brand_name.php"; ?>
<form method="POST">
<div style="margin:10px;">
<font class="sign">General Login</font>
</div>
<div class="fx1"><font color="#4b4b4b" size="2">Student, Public, Staff Grievance Status Checking Protocol!.</font></div>
<div class="fx1" style="margin:6px;"><?php echo $error ?></font>
<div style="margin:10px;"><input type="email" name="email" placeholder="Email" class="txt" required></div> 
<div style="margin:10px;"><input type="submit" name="val1" value="Continue" class="btn"></div> 
</form>
</div></div>
<br>
<?php include "../include/down.php"; ?>






