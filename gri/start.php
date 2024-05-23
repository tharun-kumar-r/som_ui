<?php
include "include/@config-domain.php";
//require "include/resmail/PHPMailerAutoload.php";
session_start();
$myfile = fopen("clgname.txt", "r") or die("error");
$clgname = "OTP For Grievance @" . fread($myfile,filesize("clgname.txt"));
fclose($myfile);
if(!empty($_SESSION['xpath']))
{
	echo '<script>window.location="verify";</script>';

}
if(!empty($_SESSION['suc']))
{
	echo '<script>window.location="option";</script>';

}




if(isset($_POST['val1']))
{
$name = $_POST['name'];
$email = $_POST['email'];
$opt = rand(9,99999);



$to = "somebody@example.com, somebodyelse@example.com";
$message = '<center><h1>OTP For Online Grievance is</h1><font size="6" color="white" style="padding:3px 20px;background:#0080ff;">'. $opt . "</font>";
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= 'From: <Online_Grievance@rajsoft.org.com>' . "\r\n";

if (mail($email,$clgname,$message,$headers)) {

	$_SESSION['xpath'] = $opt;
	$_SESSION['temp1'] = $email;
	$_SESSION['temp'] = $name;
	echo '<script>window.location="verify";</script>';




 }
 
else {

	echo "<script>alert('Poor Network! if not poor network it may Server Error please Conatact admin')</script>";



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
<link rel="icon" type="image/png" href="./img/123.png" />

	</head>
<body><center>
<div class="contain">
<?php include "include/brand_name.php"; ?>
<form method="POST">
<div class="fx1"><font color="#4b4b4b" size="2">Please enter your name and email address and click on continue!.</font></div>
<div style="margin:10px;"><input type="text" name="name" placeholder="Name" class="txt" required></div> 
<div style="margin:10px;"><input type="email" name="email" placeholder="Email" class="txt" required></div> 
<div style="margin:10px;"><input type="submit" name="val1" value="Continue" class="btn"></div> 
</form>
</div>
<br>
<?php include "include/down.php"; ?>






