<?php
include "../include/@config-domain.php";
//include "../include/resmail/PHPMailerAutoload.php";
session_start();
$email =   $_SESSION['gemailauth'];
$otp = $_SESSION['authstd'];
$myfile = fopen("../clgname.txt", "r") or die("error");
$clgname = "OTP For Grievance @" . fread($myfile,filesize("../clgname.txt"));
fclose($myfile);




if(empty($_SESSION['gemailauth']))
{
    echo '<script>window.location="../student-login/";</script>';
}
else{

    $inr = $_GET['resend'];
    if($inr == "new")
{
        echo '<script>window.history.replaceState(100, 
        "", "../student-login/verify"); </script>';
        $opt = rand(9,99999);
        $_SESSION['authstd'] = $opt;


$message = '<center><h1>OTP For Online Grievance is</h1><font size="6" color="white" style="padding:3px 20px;background:#0080ff;">'. $opt . "</font>";
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= 'From: <Online_Grievance@rajsoft.org.com>' . "\r\n";

if (mail($email,$clgname,$message,$headers)) {

    $error = '<br><span style="color:#15ac15;font-size:12px;padding:3px">New OTP Sent Successfully!.</span>';

 }
 
else {

  
	echo "<script>alert('Poor Network! if not poor network it may Server Error please Conatact admin')</script>";


}



}




}



if(isset($_POST['btn']))
{
    $getopt =  $_POST['otp'];
 
    if($getopt == $otp)
    {

        unset($_SESSION['authstd']);
        $_SESSION['dash-std'] = "hash";
        echo"<script>window.location='dashboard';</script>";


    }else{

        $error = '<br><span style="color:#cd372c;font-size:12px;padding:3px">Entered OTP is not valid!.</span>';

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
	height:98%;
	place-items:center;
	align-items:center;
	display:grid;
}
</style>
    </head>
    <link rel="icon" type="image/png" href="../img/123.png" />
<link rel="stylesheet" href="../font/font.css">
<link rel="stylesheet" href="../css/style.css">

<body><center>
<div class="contain">
<?php include "../include/brand_name.php"; ?>
<form method="POST">
<div style="margin:10px;">
<font class="sign">General Login</font>
</div>
<div class="fx1"><font color="#4b4b4b" size="2" >Please enter your OTP, That we have sent to Your Email:<b> <?php echo $email ?></b></font></div>
<?php echo $error ;?>
<div style="margin:10px;"><input type="text" name="otp" placeholder="Enter Your OTP" class="txt" required></div> 
<div style="margin:px;">
<input type="button" class="resend" onclick="window.location='verify?resend=new'" value="Not Received? Request New OPT!."/></div> 
<div style="margin:10px;"><input type="submit" name="btn" value="Verify" class="btn"></div> 
</form>
</div>
<br>
<?php include "../include/down.php"; ?>




