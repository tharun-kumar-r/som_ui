<?php
include "../include/@config-domain.php";
// "../include/resmail/PHPMailerAutoload.php";
session_start();
if(empty($_SESSION['admin_lock']))
{
  echo"<script>window.location='./';</script>";
}
else
{

$myemail= $_SESSION['admin_lock'];
$id = $_GET['id'];
if($myemail !== $id)
{
$sql= "DELETE FROM user WHERE email='$id'";
if (mysqli_query($con, $sql))
{
   echo "<script>window.location='profile';</script>";
}
else
{
 echo "<script>alert('Data Error Please contact admin')";

}
}
else
{
 echo "<script>alert('You cant remove your own account because it is in use!.')</script>";
 echo "<script>window.location='profile';</script>";
}

}

?>