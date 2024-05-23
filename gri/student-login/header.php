<?php

if(isset($_POST['vb']))
{
    session_destroy();
    echo '<script>window.location="../";</script>';
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta id="viewport" name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover">
    <title>Grievance - General Session</title>
    <link rel="icon" type="image/png" href="../img/123.png" />
<link rel="stylesheet" href="../font/font.css">
<link rel="stylesheet" href="../css/style.css">
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
<form method="POST">
<div class="head">
<font size="5"><b><font color="#4285f4">G</font><font color="#ea4335">r</font><font color="#fbbc05">i</font><font color="#4285f4">e</font><font color="#34a853">v</font><font color="#ea4335">a</font><font color="#4285f4">n</font><font color="#ea4335">c</font><font color="#fbbc05">e</font>
</b></font></font><font color="#b5b5b5" >| General Session </font>

<button name="vb">&nbsp;
 Logout</button>
</form>
</div>