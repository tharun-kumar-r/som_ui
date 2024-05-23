
<?php include "header.php" ?>
<?php 


$tkn = $_GET['token'];
$gettype = $_GET['type'];
$getsts = $_GET['sts'];
if($gettype == "STUDENT")
{
  $posttype= "student";
}
if($gettype == "STAFF")
{
  $posttype= "staff";
}
if($gettype == "PUBLIC")
{
  $posttype= "publi_c";
}

if(isset($_POST['mov']))
{
  $sql = "DELETE FROM $posttype WHERE id=$tkn";

if ($con->query($sql) === TRUE)
{
   header('pending');
} else {
  echo "<script>alert('Somthing Went wrong!');</script>";
}
}
$myfile = fopen("../clgname.txt", "r") or die("error");
$clgname = fread($myfile,filesize("../clgname.txt"));
fclose($myfile);


$fil = $_GET['filter'];
if($fil == "pending") 
{
$sql = "SELECT * FROM `staff` WHERE STATUS='pending' ORDER BY id ASC"; 
}
if($fil == "inprogress") 
{
$sql = "SELECT * FROM `staff` WHERE STATUS='inprogress' ORDER BY id ASC"; 
}
if($fil == "completed") 
{
$sql = "SELECT * FROM `staff` WHERE STATUS='completed' ORDER BY id ASC"; 
}

if($fil == "") 
{
$sql = "SELECT * FROM `staff` ORDER BY data1 DESC"; 
}

if($fil == "new") 
{
$sql = "SELECT * FROM `staff` ORDER BY data1 DESC"; 
}

if($fil == "old") 
{
  $sql = "SELECT * FROM `staff` ORDER BY data1 ASC"; 
}

$result = $con->query($sql);
if ($result->num_rows > 0) {	
 while($row = $result->fetch_assoc())
	{

    $statu = $row['status'];
    $dep = $row['dept'];

    $date1 = $row['data1'];

    if($statu == "pending")
         {
  
          $status = '<font size="1" style="border-radius:5px;background-color:#dc3545;color:white;padding:2px;"> PENDING </font>';

    }
    if($statu == "inprogress"){

      $status = '<font size="1" style="border-radius:5px;background-color:#ffc107;color:white;padding:2px;"> IN PROGRESS </font>';

    }
    if ($statu == "completed") {

      $status = '<font size="1" style="border-radius:5px;background-color:#28a745;color:white;padding:2px;"> COMPLETED </font>';

    }


    $idx = $row['id'];
     $subject = $row['subject'];
    $des = $row['des'];
    $date = $row['data'];
    $name = $row['name'];
    $type = $row['type'];
    $email = $row['email'];
    $mobile = $row['mobile'];
    $id= $row['id'] . $mobile;
    $regn = $row['regno'];

 
    if($type == "PUBLIC")
    {
      $regno = "$regn ";
    }
    if($type == "STUDENT")
    {
      $regno = "$regn ";
    }
    if($type == "STAFF")
    {
      $regno = "$regn ";
    }
    $filenm = $row['filename'];

    if($filenm == "")
    {
      $file = Null;
    }
    else
    {
      $file = '<b>User Selected File : </b><a href="../' . $filenm . '" target="_blank">'.$filenm.' </a>'; 
    }
    $se = $row['sem'];
    if($type == "STAFF")
    {
      $sem = NULL;
    }
    if($type == "PUBLIC")
    {
      $sem =  NULL;
    }
    if($type == "STUDENT")
    {
      $sem = "$se <sup>th</sup> Semester";
    }
    if($type == "STAFF")
    {
      $dept = "$dep";
    }
    if($type == "PUBLIC")
    {
      $dept = "";
    }
    if($type == "STUDENT")
    {
      $dept = "$dep";
    }
    $source =  1 . "," . "'get'" . ",". "'?type=".$type."&sts=".$statu ."&token=". $idx . "'" ;
 
    $screen .= '<tr><td>'. 
     '<center><div style="width:80%;text-align:left">
    <center><font size="6"><b><font color="#4285f4">G</font><font color="#ea4335">r</font><font color="#fbbc05">i</font><font color="#4285f4">e</font><font color="#34a853">v</font><font color="#ea4335">a</font><font color="#4285f4">n</font><font color="#ea4335">c</font><font color="#fbbc05">e</font>
    </b></font><br><font size="5"><b>'.$clgname.'</b></font><br><font size="3">Grievance Redressal Cell</font></h2></center>
    <p style="text-align:right;"><br><b>Date & Time : </b>'.$date.'</p>
    <p><b><font size="4">From,</font></b><br>
    '.$type.'<br>
    '.$name.'<br>
    '.$regno.'<br>
    '.$dept.'<br>
    '.$mobile.'<br>
    '.$email.'<br><br>
    
    <b><font size="4">To,</font></b><br>
    To Respective Collage<BR><br>
    
    <b><font size="4">Subject : </font></b>'.$subject.' </br><br>
    <b><font size="4">Sir/Madam</font></b><br><br>
    &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; '.$des.'
    
    <p style="text-align:right;"><b>Your Faithfully<br></b><u> '.$name.'</u></p>
    
    <b><font size="4">Grievance Status : </font></b>'.$status.'</br>
    
    
    </p>
    </div><br><br><hr><br>'
   
    . '</td></tr>';

  }
  $screen .= '<center><span id="disp"></span></center>';

}
else
{
  $screen .= '<tr><td>'. '<br><center><font color="#dc3545">No Grievances Found!.</font></center><br>' . '</td></tr>';
}


?>
 
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="jquery.table.hpaging.min.js"></script>
     <div class="adminx-content">
        <!-- <div class="adminx-aside">

        </div> -->

        <div class="adminx-main-content">
          <div class="container-fluid">
            <!-- BreadCrumb -->
            <nav aria-label="breadcrumb" role="navigation">
              <ol class="breadcrumb adminx-page-breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Grievances Report</li>
              </ol>
            </nav>

            <div class="pb-3">
              <h1>Staff Report</h1>
            </div>



<div class="color">
      <div class="search" style="overflow-y:auto">
<center>
<table class="tb" border="0" height="49">
<tr><td>
<select class="inputtxt" onchange="get(this.value)" id="btnApply">
   <option value="">PAGES</option>
    
    <option value="1">1</option>
    <option value="5">5</option>
    <option value="10">10</option>
    <option value="20">20</option>
    <option value="30">30</option>
    <option value="50">50</option>
    <option value="60">60</option>
    <option value="70">70</option>    
    <option value="80">80</option>
    <option value="90">90</option>
    <option value="100">100</option>
    </select>
    </td><td>

<input type="text" name="key" class="inputtxt" id="myInput" placeholder="Search Grievance" required> 
<input type="button" id="btn" class="inputbtn" value="Search">
</td><td>
<form>
<select name="filter" id="as" class="inputtxt" onchange="this.form.submit()">
<option value="">Filter Options</option>
<option value="new">New Grievances</option>
<option value="old">Old Grievances</option>
<option value="pending">Pending Grievances</option>
<option value="inprogress">In Progress Grievances</option>
<option value="completed">Completed Grievances</option>
</select>
</form></td><td>

<input type="date" class="inputtxt" id="myInpu" name="date" required>
<input type="Submit" class="inputbtn" id="btn1" value="Filter">
</td></tr></table>
</div>
<div class="search" style="padding-top:11px;overflow:auto">
<center><div class="exp">
<a href="#" class="exportpdf" onclick="PrintDiv()"><i class="fas fa-print"></i> Export Or Print</a> 
<a href="#" class="exportdoc" onclick="saveDoc();"><i class="fab fa-wordpress"></i> Export to WORD</a>
</div></center>
</div>
<div id="x1">
<table id="table1" width="100%">
<tbody id="myTable"><br><br>
<?php echo $screen; ?>
</tbody>
</table>
</div>


</div>
<div>
<style>
.exportpdf
{
background:#ed1d25;
color:white;
padding:5px 18px;
margin-top:12px;
text-decoration:none;
}
.exportpdf:hover
{
  background:#d1101a;
color:white;
text-decoration:none;
}
.exportdoc
{
  background:#024b9d;
color:white;
padding:5px 18px;
margin-top:12px;
text-decoration:none;
}
.exportdoc:hover
{
  background:#0259b9;
COLOR:white;
text-decoration:none;
}
@media(max-width: 800px)
{
   
 
  .exportpdf
{
  font-size:11px;
}
.exportdoc
{
  font-size:11px;
}
}
</style>

<script type="text/javascript">
      function get(y)
	  {
	   $("#table1").hpaging("newLimit", y);
     var nu =  $('#myTable tr:visible').length;
      if(nu == "0")
      {
        $("#disp").html("<br><font color='#dc3545' size='2'>Nothing Found!, Please check your filter query.</font>");
      }
else
{
  $("#disp").html("");
}
	  }

	  $(function () {
            $("#table1").hpaging({ "limit": 5 });

        });
	
    </script>

<script>

  $("#btn").click(function() {
    var value = $("#myInput").val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
   
      var nu =  $('#myTable tr:visible').length;
      if(nu == "0")
      {
        $("#disp").html("<br><font color='#dc3545' size='2'>Nothing Found!, Please check your filter query.</font>");
      }
else
{
  $("#disp").html("");
}


    });
  });

  $("#btn1").click(function() {
    var value = $("#myInpu").val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    
    
      var nu =  $('#myTable tr:visible').length;
      if(nu == "0")
      {
        $("#disp").html("<br><font color='#dc3545' size='2'>Nothing Found!, Please check your filter query.</font>");
      }
else
{
  $("#disp").html("");
}


    });
  });

  $("#as").onchange(function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    
    
      var nu =  $('#myTable tr:visible').length;
      if(nu == "0")
      {
        $("#disp").html("<br><font color='#dc3545' size='2'>Nothing Found!, Please check your filter query.</font>");
      }
else
{
  $("#disp").html("");
}


    });
  });

</script>

<script>
function saveDoc() {


    var x = Math.floor((Math.random() * 101223) + 1);

if (!window.Blob) {
  alert('Your legacy browser does not support this action.');
  return;
}

var html, link, blob, url, css;

// EU A4 use: size: 841.95pt 595.35pt;
// US Letter use: size:11.0in 8.5in;

css = ('\
 <style>\
 @page WordSection1{size: 41.95pt 95.35pt;mso-page-orientation: portrait;}\
 div.WordSection1 {page: WordSection1;}\
 h1 {font-family:arial; font-size: 16pt;}\
 p {font-family:arial; font-size: 14pt;}\
 </style>\
');

var rightAligned = document.getElementsByClassName("sm-align-right");
for (var i=0, max=rightAligned.length; i < max; i++) {
  rightAligned[i].style = "text-align: right;"
}

var centerAligned = document.getElementsByClassName("sm-align-center");
for (var i=0, max=centerAligned.length; i < max; i++) {
  centerAligned[i].style = "text-align: center;"
}

html = document.getElementById('table1').innerHTML;
html = '\
<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:w="urn:schemas-microsoft-com:office:word" xmlns="http://www.w3.org/TR/REC-html40">\
<head>\
  <title>Document Title</title>\
  <xml>\
    <w:worddocument xmlns:w="#unknown">\
      <w:view>Print</w:view>\
      <w:zoom>90</w:zoom>\
      <w:donotoptimizeforbrowser />\
    </w:worddocument>\
  </xml>\
</head>\
<body lang=RU-ru style="tab-interval:.5in">\
  <div class="Section1">' + html + '</div>\
</body>\
</html>'

blob = new Blob(['\ufeff', css + html], {
  type: 'application/msword'
});

url = URL.createObjectURL(blob);
link = document.createElement('A');
link.href = url;

filename = 'Report-' + x;

// Set default file name.
// Word will append file extension - do not add an extension here.
link.download = filename;   

document.body.appendChild(link);

if (navigator.msSaveOrOpenBlob) {
  navigator.msSaveOrOpenBlob( blob, filename + '.doc'); // IE10-11
} else {
  link.click(); // other browsers
}

document.body.removeChild(link);
};


</script>

<script type="text/javascript">
        function PrintDiv() {
        
          var divContents = document.getElementById('table1').innerHTML;
            var printWindow = window.open('', '', 'height=700,width=500');
            printWindow.document.write('<html><head><title>Grievance Redressal Cell</title>');
            printWindow.document.write('</head><body style="font-family:arial;margin:14px;margin-top:35px;">');
            printWindow.document.write(divContents);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        }
    </script>
<center><br>
<?php include "../include/down.php"; ?>



</center>
<br>