<?php
include "include/@config-domain.php";
//include "include/resmail/PHPMailerAutoload.php";
session_start();
$email =   $_SESSION['temp1'];
$sname =   $_SESSION['temp'];
$myfile = fopen("clgname.txt", "r") or die("error");
$clgname = "Grievance @" . fread($myfile,filesize("clgname.txt"));
fclose($myfile);
$m = fopen("admin.txt", "r") or die("error");
$admin = fread($m,filesize("admin.txt"));
fclose($myfile);


if(empty($_SESSION['suc']))
{
    echo '<script>window.location="./";</script>';
}

date_default_timezone_set('Asia/Kolkata');
$currentDateTime=date('m/d/Y H:i:s');
$now = date('d-m-yy h:i A', strtotime($currentDateTime));
$datec = date('yy-m-d');



if(isset($_POST['ok']))
{
    $tel = $_POST['tel'];
    $regno = $_POST['regno'];
    $dept = $_POST['dept'];
    $sub = $_POST['sub'];
    $sem = $_POST['sem'];
    $dec = $_POST['dec'];
    $fl = '<font color="#006ad5">Copyrights © '.date('yy').' all rights reserved<br>Design And Developed By Rajsoft Technologies, KGF<br><br>';
    $file = $_FILES['file']['name'];
    $ext = pathinfo($file, PATHINFO_EXTENSION);
    $name = rand(1000,100000).$_FILES['file'][''];
    $tmp_name= $_FILES['file']['tmp_name'];
    $size= $_FILES['file']['size'];
    $path= "files/";
    $filename = $path . $name.'.'.$ext;

   

//dump data and sent mail

    function uplad($dat,$emai,$nam,$regn,$dep,$su,$de,$no,$date,$co,$mai,$clgnam,$f,$admi,$te,$sm)
    {
      
        $query =  mysqli_query($co,"insert into student (email, name, mobile, regno, dept, subject, des, filename, data, data1, sem) 
        values('$emai','$nam','$te','$regn','$dep','$su','$de','$dat','$no','$date','$sm')");       
        if($query == true)
        {
           
$to = $emai .",". $admi;
$message = '<body bgcolor="silver" style="font-family:arial"><center><br>
            <font size="7" style="font-weight: bolder;"><b><font color="#4285f4">G</font><font color="#ea4335">r</font><font color="#fbbc05">i</font><font color="#4285f4">e</font><font color="#34a853">v</font><font color="#ea4335">a</font><font color="#4285f4">n</font><font color="#ea4335">c</font><font color="#fbbc05">e</font>
            </font><br><font color="#333333" size="4">'.$clgnam.'</font><br>        
            <br><font style="font-family: rajsoft;
            font-size: 19px;
            font-weight: bold;
            color: white;
            border-radius: 30px;
            border: solid royalblue 1px;
            padding: 3px 11px;
            background-color: rgb(38, 89, 240);
            cursor: pointer;">Student Grievance</font><br>
            <br><div style="background:white;"><p style="padding:11px" align="left"><font size="4" color="#333333">
            <br><BR><br><b>Name : </b><i>'.$nam.'</i><br>
            <b>Reg No : </b><i>'.$regn.'</i><br>
            <b>Semester  : </b><i>'.$sm.'</i><br>
            <b>Phone No : </b><i>'.$te.'</i><br>
            <b>Department : </b><i>'.$dep.'</i><br>
            <b>Subject : </b><i>'.$su.'</i><br>
            <b>Grievance Description : </b><i>'.$de.'</i><br>
            <b>Submitted On : </b><i>'.$no.'</i><br></p>
           </font> <br><br>'.$f.'<br><br></div></body>';

           $headers = "MIME-Version: 1.0" . "\r\n";
           $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
           $headers .= 'From: <Online_Grievance@rajsoft.org.com>' . "\r\n";

           if (mail($to,$clgname,$message,$headers)) {
           
    echo '<script>window.location="success"</script>';


 }
 
else {

    $error = '<br><font color="red" size="2">Email Error please Conatact admin.</font>';	
   


}





        }
        else
        {

        $error = '<br><font color="red" size="2">Critical Error Database is not responding Please contact Rajsoft tech!.</font>';	
          
        }



    }

//end of function

    if (isset($name)) {
    if (empty($file))
    {
        //file check
        uplad($file,$email,$sname,$regno,$dept,$sub,$dec,$now,$datec,$con,$mail,$clgname,$fl,$admin,$tel,$sem);


    }
    else
    {
        $error = '<br><font color="green" size="2">Uploading The file....</font>';	
      
    if ((!empty($name)) && ($size < 2000000))
    {
    if(move_uploaded_file($tmp_name, $path . $name.'.'.$ext))
    {
         uplad($filename,$email,$sname,$regno,$dept,$sub,$dec,$now,$datec,$con,$mail,$clgname,$fl,$admin,$tel,$sem);

    }
    else{

        $error = '<br><font color="red" size="2">Could Not Upload File. Poor Network!.</font>';	
   
    }

    }
    else
    {
    $error = '<br><font color="red" size="2">The size of the file must be less than 2MB in order to be uploaded.</font>';	
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
    height:98%;
	place-items:center;
   	display:grid;
	
}
</style>
<link rel="icon" type="image/png" href="./img/123.png" />

    </head>
    <link rel="stylesheet" href="./css/style.css" >
<body background="img//bg.png"><center><br><br>
<div class="connection">
<?php include "include/brand_name.php"; ?>

<div style="margin:10px;">
<font class="sign">Student Grievance Form</font>
</div>
<div style="margin:10px;">
<font color="#606060" size="2">Please fill out all the details and click on submit!.</font>
<?php echo $error ?></div>
<div class="row">
    <div class="clmn">
<form Method="POST" enctype="multipart/form-data">
<div style="margin:10px;">
<div class="fx">Email<Font color="red"> *</font></div>
<input type="email" value="<?php  echo $email ?>" class="ginput" disabled>
</div>
<div style="margin:10px;">
<div class="fx">Name<Font color="red"> *</font></div>
<input type="text" value="<?php  echo $sname ?>" class="ginput" disabled>
</div>
<div style="margin:10px;">
<div class="fx">Phone<Font color="red"> *</font></div>
<input  type="tel"  name="tel" pattern="[0-9]{10}" placeholder="Phone Number" class="ginput" required>
</div>
<div style="margin:10px;">
<div class="fx">Register Number<Font color="red"> *</font></div>
<input  type="text" name="regno" pattern="[A-Za-z\d]{10}" placeholder="Register Number" class="ginput" required>
</div>
<div style="margin:10px;">
<div class="fx">Select Semester<Font color="red"> *</font></div>
<select name="sem" class="ginput" required>
<option value="">Select Semester</option>
<option Value="1">Semester 1</option>
<option value="2">Semester 2</option>
<option value="3">Semester 3</option>
<option Value="4">Semester 4</option>
<option value="5">Semester 5</option>
<option value="6">Semester 6</option>
<select>
</div>
</div>

<div class="clmn">
<div style="margin:10px;">
<div class="fx">Select Department<Font color="red"> *</font></div>
<select name="dept" class="ginput" required>
<option value="">Select Department</option>
<option Value="Computer Science & Engg">Computer Science & Engg</option>
<option value="Mechanical & Engg">Mechanical & Engg</option>
<option value="Mining & Engg">Mining & Engg</option>
<select>
</div>


<div style="margin:10px;">
<div class="fx">Subject<Font color="red"> *</font></div>
<input  type="text" name="sub" placeholder="Subject like Any complaints , requirements etc" class="ginput" required>
</div>
<div style="margin:10px;">
<div class="fx">Grievance Description<Font color="red"> *</font></div>
<textarea style="resize:none;height:97px;" placeholder="Grievance Description  Ex : Any complaints Details , requirements details etc" class="ginput" rows="5" type="text" name="dec" required></textarea>
</div>
<div style="margin:10px;">
<div class="fx">Custom Grievance Document<Font color="red"> </font></div>
<input  type="file" name="file" class="ginput" accept="application/pdf,application/text,application/msword,image/gif,image/png,image/bmp,image/jpg"> <br><br>
</div>


</div>


</div>
<input type="submit" name="ok" value="Submit Grivance" class="submit">
</form>
</div>
<br><BR>
<?php include "include/down.php"; ?>

