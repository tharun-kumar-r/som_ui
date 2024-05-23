<?php 
$myfile = fopen("./clgname.txt", "r") or die("error");
$clgname = "Copyrights &copy; " . fread($myfile,filesize("./clgname.txt")) ." ".date('yy') . "<br>Developed by <a class='links' href='https://www.rajsoft.org.in' target='_blank'>Rajsoft Software Pvt</a>";
fclose($myfile);

?>

<font color="#696969" size="2"><?php echo $clgname ?></font><br><br>











