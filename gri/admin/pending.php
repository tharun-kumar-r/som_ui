
<?php include "header.php" ?>
<?php 

$useremail= $_GET['usr'];
$subset = $_GET['subject'];
$check = $_GET['checked'];
$tkn = $_GET['token'];
$gettype = $_GET['type'];
$getsts = $_GET['sts'];
$myfile = fopen("../clgname.txt", "r") or die("error");
$clgname = fread($myfile,filesize("../clgname.txt"));
fclose($myfile);


function sendmail($mai,$gripro,$umail,$subjct,$clgnam)
{

 $message = '<body bgcolor="silver" style="font-family:arial"><center><br>
            <font size="7" style="font-weight: bolder;"><b><font color="#4285f4">G</font><font color="#ea4335">r</font><font color="#fbbc05">i</font><font color="#4285f4">e</font><font color="#34a853">v</font><font color="#ea4335">a</font><font color="#4285f4">n</font><font color="#ea4335">c</font><font color="#fbbc05">e</font>
            </font><br><font color="#333333" size="4">'.$clgnam.'</font><br><b>Admin Approved Your grievance & taken Action as</b><br>        
            <br><font style="font-family: rajsoft;
            font-size: 11px;
            font-weight: bold;
            color: white;
            border-radius: 30px;
            border: solid royalblue 1px;
            padding: 3px 11px;
            background-color: rgb(38, 89, 240);
            cursor: pointer;">'.$gripro.'</font><br>
           <br><b><center><font size="2">Where Subject : '.$subjct.'</i><br>
           </div></body>';
           $headers = "MIME-Version: 1.0" . "\r\n";
           $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
          $headers .= 'From: <Online_Grievance@rajsoft.org.com>' . "\r\n";

           if (mail($umail,$clgname,$message,$headers)) {
        
 
  echo "<script>window.location='pending';</script>";

 }
 
else {

   echo "<script>alert('somthing went wrong!.');</script>"; 


}


}

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
  $sql = "UPDATE $posttype SET status='inprogress' WHERE id=$tkn";

if ($con->query($sql) === TRUE)
{

if($check == "false")
{
   
  echo "<script>window.location='pending';</script>";

}else{
 sendmail($mail,$pr="Inprogress",$useremail,$subset,$clgname);
}

} else {
  echo "<script>alert('Somthing Went wrong!');</script>";
}
}
if(isset($_POST['mov1']))
{
  $sql = "UPDATE $posttype SET status='completed' WHERE id=$tkn";

if ($con->query($sql) === TRUE)
{

  if($check == "false")
{
   
  echo "<script>window.location='pending';</script>";

}else{
  sendmail($mail,$pr="Completed",$useremail,$subset,$clgname);
}
  

} else {
  echo "<script>alert('Somthing Went wrong!');</script>";
}
}



$fil = $_GET['filter'];

if($fil == "pending") 
{
  //echo "<script>window.location='pending';</script>";

 }
if($fil == "inprogress") 
{
  echo "<script>window.location='progress';</script>";

  }
if($fil == "completed") 
{
  echo "<script>window.location='completed';</script>";

 }

if($fil !== "old") 
{
$sql = "SELECT id,dept,status,subject,des,data,data1,name,type,email,mobile,regno,filename,sem FROM staff WHERE status='pending' UNION ALL
SELECT id,dept,status,subject,des,data,data1,name,type,email,mobile,regno,filename,sem FROM student WHERE status='pending' UNION ALL
SELECT id,dept,status,subject,des,data,data1,name,type,email,mobile,regno,filename,sem FROM publi_c WHERE status='pending' ORDER BY data1 DESC"; 
}
else
{
  $sql = "SELECT id,dept,status,subject,des,data,data1,name,type,email,mobile,regno,filename,sem FROM staff  WHERE status='pending' UNION ALL
  SELECT id,dept,status,subject,des,data,data1,name,type,email,mobile,regno,filename,sem FROM student WHERE status='pending' UNION ALL
  SELECT id,dept,status,subject,des,data,data1,name,type,email,mobile,regno,filename,sem FROM publi_c WHERE status='pending' ORDER BY data1 ASC"; 
  
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
      $regno = "<b>Address :</b> $regn ";
    }
    if($type == "STUDENT")
    {
      $regno = "<b>Register No :</b> $regn ";
    }
    if($type == "STAFF")
    {
      $regno = "<b>Employee Register No :</b> $regn ";
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
      $sem = "<b>Semester :</b> $se SEM <br>";
    }
    if($type == "STAFF")
    {
      $dept = "<b>Department :</b> $dep <br>";
    }
    if($type == "PUBLIC")
    {
      $dept = "";
    }
    if($type == "STUDENT")
    {
      $dept = "<b>Department :</b> $dep<br>";
    }
    $source =  1 . "," . "'get'" . ",". "'?type=".$type."&sts=".$statu ."&token=". $idx . "&usr=".$email."&checked=true&subject=$subject'" ;
    
    $screen .= '<tr><td>'. 
    
    

    '<br><div style="padding:5px;border:1px solid #dddfe0"><div id='. $id .'><div style="padding:6px;background:whitesmoke;width:100%;">
    User Type : <b>'.$type.'</b>  <br>
    Placed on : <b>'.$date.'</b> <br>
   <label style="display:none">'.$date1.'</label>
    Status : '.$status.'<br></div>
    <div style="font-size:13px;padding:6px;background:white;width:100%;">
<b>Name : </b>'.$name.' <br>
'.$regno.'<br>
'.$sem.'
'.$dept.'
<b>Phone No : </b>'.$mobile.' <br>
<b>Mail : </b>'.$email.' <br>
<b>Subject : </b>'.$subject.' <br>
<b>Description : </b>'.$des.' <br>
'.$file.'<br>
</div></div><p align="right"><br>
<a  id="myBtn" class="myBtn" style="background:#3f9bff;border:0px;outline:0px;padding:3px 21px;border-radius:3px;margin-right:12px;color:white;cursor:pointer" onclick="window.history.replaceState('.$source.');"><i class="fas fa-check"></i> Take action</a>
<a style="background:#333333;border:0px;outline:0px;padding:3px 21px;border-radius:3px;margin-right:12px;color:white;cursor:pointer"
onclick=PrintDiv(this.name) name="'.$id.'" ><i class="fas fa-print"></i> Print</a></p>
</div>
    '
   
    . '</td></tr>';

  }
$screen .= '<center><span id="disp"></span></center>';

}
else
{
  $screen .= '<tr><td>'. '<br><center><font color="#dc3545">No Pending Grievances Found!.</font></center><br>' . '</td></tr>';
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
                <li class="breadcrumb-item active" aria-current="page">Pending Grievances</li>
              </ol>
            </nav>

            <div class="pb-3">
              <h1>Pending Grievances</h1>
            </div>



<div class="color">
      <div class="search" style="overflow-y:auto">
<center>
<table class="tb" border="0" height="49">
<tr><td>
<select class="inputtxt" onchange="get(this.value)" id="btnApply">
	<option value="5">5</option>
    <option value="10">10</option>
    <option value="20">20</option>
    <option value="30">30</option>
    <option value="50">50</option>
    <option value="100">100</option>
    </select>
    </td><td>

<input type="text" name="key" class="inputtxt" id="myInput" placeholder="Search Grievance" required> 
<input type="button" id="btn" class="inputbtn" value="Search">
</td><td>
<form>
<select name="filter" class="inputtxt" onchange="this.form.submit()">
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

<table id="table1" width="100%">
<tbody id="myTable">
<?php echo $screen; ?>
</tbody>
</table>



</div><div>
<center><br>
<?php include "../include/down.php"; ?>



</center>
<br>
<!-- Trigger/Open The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <h6>Take Action</h6>
    </div>
    <div class="modal-body">
   <label><input type="checkbox" onclick="

   if(this.checked){
  var url = new window.URL(document.location); 
url.searchParams.set('checked','true');
window.history.replaceState('1','th',url.toString());
   }
   else
   {
    var url = new window.URL(document.location); 
url.searchParams.set('checked','false');
window.history.replaceState('1','th',url.toString());
   }  
   " checked> Send mail about this action</label>
     <form method="POST">
     <button class="xbtn1" name="mov">Move to inprogress</button>
     </form>
     <form method="POST">
     <button class="xbtn" name="mov1">Move to completed</button>
     </form>
     <form method="POST">
     <a class="close" name="mov">Close</a>
     </form>
    </div>
 
  </div>

</div>


<script>
// Get the modal
var modal = document.getElementById("myModal");
// et the button that opens the modal
// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];
// When the user clicks the button, open the modal 
$(document).ready(function ()
{
    $(".myBtn").click(function ()
    {
     
      modal.style.display = "block";
       
    });
});

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

</script>
<script type="text/javascript">
        function PrintDiv(d) {
          var divContents = document.getElementById(d).innerHTML;
            var printWindow = window.open('', '', 'height=700,width=500');
            printWindow.document.write('<html><head><title>Grievance Redressal Cell</title>');
            printWindow.document.write('</head><body style="font-family:arial;margin:14px;margin-top:35px;"> <b> <font size="5"><font color="#4285f4">G</font><font color="#ea4335">r</font><font color="#fbbc05">i</font><font color="#4285f4">e</font><font color="#34a853">v</font><font color="#ea4335">a</font><font color="#4285f4">n</font><font color="#ea4335">c</font><font color="#fbbc05">e</font><br><font size="3">Redressal Cell</font><br><br></b></font>');
            printWindow.document.write(divContents);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        }
    </script>
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

</script>

