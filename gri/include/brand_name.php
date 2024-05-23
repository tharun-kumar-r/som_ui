<?php
include "@config-domain.php";
session_start();
$file = basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']);
if($file == "")
{

}
else{
    $fil = " / " . basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']);
}

?>
 
 
<meta id="viewport" name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover">
<link rel="stylesheet" href="./font/font.css">
<link rel="stylesheet" href="./css/style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
<title>Grievance Redressal Cell <?php echo ucwords($fil) . "..." ?></title>


<font size="7" style="font-weight: bolder;"><b><font color="#4285f4">G</font><font color="#ea4335">r</font><font color="#fbbc05">i</font><font color="#4285f4">e</font><font color="#34a853">v</font><font color="#ea4335">a</font><font color="#4285f4">n</font><font color="#ea4335">c</font><font color="#fbbc05">e</font>
</b></font><br><font size="5"><b>SCHOOL OF MINES<br><font size="3">Grievance Redressal Cell</font></b>