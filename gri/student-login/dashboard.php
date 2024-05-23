<?php
include "../include/@config-domain.php";
//require "../include/resmail/PHPMailerAutoload.php";

session_start();
$myfile = fopen("../clgname.txt", "r") or die("error");
$clgname = "OTP For Grievance @" . fread($myfile,filesize("../clgname.txt"));
fclose($myfile);
$email =   $_SESSION['gemailauth'];

if(empty($_SESSION['dash-std']))
{
	echo '<script>window.location="../student-login";</script>';

}



$rtr = mysqli_query($con,"SELECT id,name,email,type,mobile,regno,dept,sem,status,subject,des,filename,data,data1 FROM staff where email='$email'  UNION ALL
SELECT id,name,email,type,mobile,regno,dept,sem,status,subject,des,filename,data,data1 FROM student where email='$email' UNION ALL
SELECT id,name,email,type,mobile,regno,dept,sem,status,subject,des,filename,data,data1 FROM publi_c where email='$email' ORDER BY id ASC");  
if ($rtr->num_rows > 0) {

	while($row = $rtr->fetch_assoc()) {
		
		$id = $row['id'];
		$type = $row['type'];
		$email = $row['email'];
		$name = $row['name'];
		$st = $row['status'];
		$mobile = $row['mobile'];
		$depe = $row['dept'];
		$sem = $row['sem'];
		$sub = $row['subject'];
		$desc = $row['des'];
		$cdate = $row['data'];
		$fdate = $row['data1'];
		$filename = $row['filename'];
		if($st == "pending")
		{
	$status = '<font size="2" style="background:#dd5246;padding:0px 14px;border-radius:0px" color="white">Pending</font>';
		}
		if($st == "inprogress")
		{
	$status = '<font size="2" style="background:#ffce45;padding:0px 14px;border-radius:0px" color="white">In Progress</font>';
		}
		if($st == "completed")
		{
	$status = '<font size="2" style="background:#18a05e;padding:0px 14px;border-radius:0px" color="white">Completed</font>';
		}
		if($filename == "")
		{
		$file="No File Chosen!";
		}else
		{
		$file = $filename;
		}


		$rno = $row['regno'];


		if($type == "STUDENT")
		{


			$io .= '<div class="ioout"><div id="'.$id.'"><table width="100%" style="text-align:left;" border="0"><tr><td><br>
			<h4>Placed On : '.$cdate.'</h4></td></tr><tr><th>
			<h5>Grievance Type : '.$type.'</h5></th></tr><tr><th>
			<h5>Grievance Status : '.$status.'<br><br></h5></th></tr><tr><td style="padding:11px;background:white">
			<font size="2">
			<b>Student Name : </b>'.$name.' <br>
			<b>Register Number : </b>'.$rno.' <br>
			<b>Department : </b>'.$depe.' <br>
			<b>Semester : </b>'. $sem .' <sup>st </sup> SEM <br>
			<b>Mobile Number : </b>'.$mobile.' <br>
			<b>Email : </b>'.$email.' <br>
			<b>Subject : </b>'.$sub.' <br>
			<b>Grievance Description : </b>'.$desc.' <br>
			<b>External File : </b>'.$file.' <br>
			</font></td></tr></table></div>
			<p align="right" style="margin-right:11px;"><br><input type="button" style="background:#0083d0;border:0px;outline:0px;padding:5px 11px;border-radius:3px;color:white;cursor:pointer"
			onclick=PrintDiv(this.name) name="'.$row['id'].'" value="Print"/></p>
			</div>';

		}
		if($type == "STAFF")
		{

			
			$io .= '<div class="ioout"><div id="'.$id.'"><table width="100%" style="text-align:left;" border="0"><tr><th><br>
			Placed On : '.$cdate.'</th></tr><tr><th>
			Grievance Type : '.$type.'</th></tr><tr><th>
			Grievance Status : '.$status.'<br><br></th></tr><tr><td style="padding:11px;background:white">
			<font size="2">
			<b>Employee Name : </b>'.$name.' <br>
			<b>Employee Register Number : </b>'.$rno.' <br>
			<b>Department : </b>'.$depe.' <br>
			<b>Mobile Number : </b>'.$mobile.' <br>
			<b>Email : </b>'.$email.' <br>
			<b>Subject : </b>'.$sub.' <br>
			<b>Grievance Description : </b>'.$desc.' <br>
			<b>External File : </b>'.$file.' <br>
			</font></td></tr></table></div>
			<p align="right" style="margin-right:11px;"><br><input type="button" style="background:#0083d0;border:0px;outline:0px;padding:5px 11px;border-radius:3px;color:white;cursor:pointer"
			onclick=PrintDiv(this.name) name="'.$row['id'].'" value="Print"/></p>
			</div>';

		}
		if($type == "PUBLIC")
		{
			
			$io .= '<div class="ioout"><div id="'.$id.'"><table width="100%" style="text-align:left;" border="0"><tr><th><br>
			Placed On : '.$cdate.'</th></tr><tr><th>
			Grievance Type : '.$type.'</th></tr><tr><th>
			Grievance Status : '.$status.'<br><br></th></tr><tr><td style="padding:11px;background:white">
			<font size="2">
			<b>Name : </b>'.$name.' <br>
			<b>Address : </b>'.$rno.' <br>
			<b>Mobile Number : </b>'.$mobile.' <br>
			<b>Email : </b>'.$email.' <br>
			<b>Subject : </b>'.$sub.' <br>
			<b>Grievance Description : </b>'.$desc.' <br>
			<b>External File : </b>'.$file.' <br>
			</font></td></tr></table></div>
			<p align="right" style="margin-right:11px;"><br><input type="button" style="background:#0083d0;border:0px;outline:0px;padding:5px 11px;border-radius:3px;color:white;cursor:pointer"
			onclick=PrintDiv(this.name) name="'.$row['id'].'" value="Print"/></p>
			</div>';
		}

	}
}
else
{
	$io= "<center><h2 style='color:#ea4335;'>0</h2> <h4>Completed Grievances Found</h4></center>";
}

//when normal condetion

//start data base query//
if(isset($_GET['filter']))
{
	$io = null;
	$get = $_GET['filter'];
	if($get == "old")
	{
		
$rt = mysqli_query($con,"SELECT id,name,email,type,mobile,regno,dept,sem,status,subject,des,filename,data,data1 FROM staff where email='$email'  UNION ALL
SELECT id,name,email,type,mobile,regno,dept,sem,status,subject,des,filename,data,data1 FROM student where email='$email' UNION ALL
SELECT id,name,email,type,mobile,regno,dept,sem,status,subject,des,filename,data,data1 FROM publi_c where email='$email' ORDER BY id DESC");  

	}elseif($get == "new")
	{

		$rt = mysqli_query($con,"SELECT id,name,email,type,mobile,regno,dept,sem,status,subject,des,filename,data,data1 FROM staff where email='$email'  UNION ALL
		SELECT id,name,email,type,mobile,regno,dept,sem,status,subject,des,filename,data,data1 FROM student where email='$email' UNION ALL
		SELECT id,name,email,type,mobile,regno,dept,sem,status,subject,des,filename,data,data1 FROM publi_c where email='$email' ORDER BY id ASC");  
		
	}elseif($get == "pending")
	{

		$rt = mysqli_query($con,"SELECT id,name,email,type,mobile,regno,dept,sem,status,subject,des,filename,data,data1 FROM staff where email='$email' AND status='pending'  UNION ALL
SELECT id,name,email,type,mobile,regno,dept,sem,status,subject,des,filename,data,data1 FROM student where email='$email' AND status='pending' UNION ALL
SELECT id,name,email,type,mobile,regno,dept,sem,status,subject,des,filename,data,data1 FROM publi_c where email='$email' AND status='pending' ");  


	}elseif($get == "inprogress")
	{
		$rt = mysqli_query($con,"SELECT id,name,email,type,mobile,regno,dept,sem,status,subject,des,filename,data,data1 FROM staff where email='$email' AND status='inprogress'  UNION ALL
SELECT id,name,email,type,mobile,regno,dept,sem,status,subject,des,filename,data,data1 FROM student where email='$email' AND status='inprogress' UNION ALL
SELECT id,name,email,type,mobile,regno,dept,sem,status,subject,des,filename,data,data1 FROM publi_c where email='$email' AND status='inprogress' ");  

		
	}elseif($get == "completed")
	{
	
		$rt = mysqli_query($con,"SELECT id,name,email,type,mobile,regno,dept,sem,status,subject,des,filename,data,data1 FROM staff where email='$email' AND status='completed'  UNION ALL
		SELECT id,name,email,type,mobile,regno,dept,sem,status,subject,des,filename,data,data1 FROM student where email='$email' AND status='completed' UNION ALL
		SELECT id,name,email,type,mobile,regno,dept,sem,status,subject,des,filename,data,data1 FROM publi_c where email='$email' AND status='completed' ");  
		
	}

	if ($rt->num_rows > 0) {

		while($row = $rt->fetch_assoc()) {
			
			$id = $row['id'];
			$type = $row['type'];
			$email = $row['email'];
			$name = $row['name'];
			$st = $row['status'];
			$mobile = $row['mobile'];
			$depe = $row['dept'];
			$sem = $row['sem'];
			$sub = $row['subject'];
			$desc = $row['des'];
			$cdate = $row['data'];
			$fdate = $row['data1'];
			$filename = $row['filename'];
			if($st == "pending")
			{
		$status = '<font size="2" style="background:#dd5246;padding:0px 14px;border-radius:0px" color="white">Pending</font>';
			}
			if($st == "inprogress")
			{
		$status = '<font size="2" style="background:#ffce45;padding:0px 14px;border-radius:0px" color="white">In Progress</font>';
			}
			if($st == "completed")
			{
		$status = '<font size="2" style="background:#18a05e;padding:0px 14px;border-radius:0px" color="white">Completed</font>';
			}
			if($filename == "")
			{
			$file="No File Chosen!";
			}else
			{
			$file = $filename;
			}
	
	
			$rno = $row['regno'];
	
	
			if($type == "STUDENT")
			{
	
	
				$io .= '<div class="ioout"><div id="'.$id.'"><table width="100%" style="text-align:left;" border="0"><tr><td><br>
				<h4>Placed On : '.$cdate.'</h4></td></tr><tr><th>
				<h5>Grievance Type : '.$type.'</h5></th></tr><tr><th>
				<h5>Grievance Status : '.$status.'<br><br></h5></th></tr><tr><td style="padding:11px;background:white">
				<font size="2">
				<b>Student Name : </b>'.$name.' <br>
				<b>Register Number : </b>'.$rno.' <br>
				<b>Department : </b>'.$depe.' <br>
				<b>Semester : </b>'. $sem .' <sup>st </sup> SEM <br>
				<b>Mobile Number : </b>'.$mobile.' <br>
				<b>Email : </b>'.$email.' <br>
				<b>Subject : </b>'.$sub.' <br>
				<b>Grievance Description : </b>'.$desc.' <br>
				<b>External File : </b>'.$file.' <br>
				</font></td></tr></table></div>
				<p align="right" style="margin-right:11px;"><br><input type="button" style="background:#0083d0;border:0px;outline:0px;padding:5px 11px;border-radius:3px;color:white;cursor:pointer"
				onclick=PrintDiv(this.name) name="'.$row['id'].'" value="Print"/></p>
				</div>';
	
			}
			if($type == "STAFF")
			{
	
				
				$io .= '<div class="ioout"><div id="'.$id.'"><table width="100%" style="text-align:left;" border="0"><tr><th><br>
				Placed On : '.$cdate.'</th></tr><tr><th>
				Grievance Type : '.$type.'</th></tr><tr><th>
				Grievance Status : '.$status.'<br><br></th></tr><tr><td style="padding:11px;background:white">
				<font size="2">
				<b>Employee Name : </b>'.$name.' <br>
				<b>Employee Register Number : </b>'.$rno.' <br>
				<b>Department : </b>'.$depe.' <br>
				<b>Mobile Number : </b>'.$mobile.' <br>
				<b>Email : </b>'.$email.' <br>
				<b>Subject : </b>'.$sub.' <br>
				<b>Grievance Description : </b>'.$desc.' <br>
				<b>External File : </b>'.$file.' <br>
				</font></td></tr></table></div>
				<p align="right" style="margin-right:11px;"><br><input type="button" style="background:#0083d0;border:0px;outline:0px;padding:5px 11px;border-radius:3px;color:white;cursor:pointer"
				onclick=PrintDiv(this.name) name="'.$row['id'].'" value="Print"/></p>
				</div>';
	
			}
			if($type == "PUBLIC")
			{
				
				$io .= '<div class="ioout"><div id="'.$id.'"><table width="100%" style="text-align:left;" border="0"><tr><th><br>
				Placed On : '.$cdate.'</th></tr><tr><th>
				Grievance Type : '.$type.'</th></tr><tr><th>
				Grievance Status : '.$status.'<br><br></th></tr><tr><td style="padding:11px;background:white">
				<font size="2">
				<b>Name : </b>'.$name.' <br>
				<b>Address : </b>'.$rno.' <br>
				<b>Mobile Number : </b>'.$mobile.' <br>
				<b>Email : </b>'.$email.' <br>
				<b>Subject : </b>'.$sub.' <br>
				<b>Grievance Description : </b>'.$desc.' <br>
				<b>External File : </b>'.$file.' <br>
				</font></td></tr></table></div>
				<p align="right" style="margin-right:11px;"><br><input type="button" style="background:#0083d0;border:0px;outline:0px;padding:5px 11px;border-radius:3px;color:white;cursor:pointer"
				onclick=PrintDiv(this.name) name="'.$row['id'].'" value="Print"/></p>
				</div>';
			}
	
		}
	}
	else
	{
		$io= "<center><h2 style='color:#ea4335;'>0</h2> <h4>Search Result's found!.</h4></center>";
	}
	


}

if(isset($_GET['date']))
{
	$io = null;
	$get = '%' . $_GET['date'];
	
	
	
	$rt = mysqli_query($con,"SELECT id,name,email,type,mobile,regno,dept,sem,status,subject,des,filename,data,data1 FROM staff where email='$email' AND data1 LIKE '$get'  UNION ALL
	SELECT id,name,email,type,mobile,regno,dept,sem,status,subject,des,filename,data,data1 FROM student where email='$email' AND data1 LIKE '$get'  UNION ALL
	SELECT id,name,email,type,mobile,regno,dept,sem,status,subject,des,filename,data,data1 FROM publi_c where email='$email' AND data1 LIKE '$get' ");  
		
	if ($rt->num_rows > 0) {

		while($row = $rt->fetch_assoc()) {
			
			$id = $row['id'];
			$type = $row['type'];
			$email = $row['email'];
			$name = $row['name'];
			$st = $row['status'];
			$mobile = $row['mobile'];
			$depe = $row['dept'];
			$sem = $row['sem'];
			$sub = $row['subject'];
			$desc = $row['des'];
			$cdate = $row['data'];
			$fdate = $row['data1'];
			$filename = $row['filename'];
			if($st == "pending")
			{
		$status = '<font size="2" style="background:#dd5246;padding:0px 14px;border-radius:0px" color="white">Pending</font>';
			}
			if($st == "inprogress")
			{
		$status = '<font size="2" style="background:#ffce45;padding:0px 14px;border-radius:0px" color="white">In Progress</font>';
			}
			if($st == "completed")
			{
		$status = '<font size="2" style="background:#18a05e;padding:0px 14px;border-radius:0px" color="white">Completed</font>';
			}
			if($filename == "")
			{
			$file="No File Chosen!";
			}else
			{
			$file = $filename;
			}
	
	
			$rno = $row['regno'];
	
	
			if($type == "STUDENT")
			{
	
	
				$io .= '<div class="ioout"><div id="'.$id.'"><table width="100%" style="text-align:left;" border="0"><tr><td><br>
				<h4>Placed On : '.$cdate.'</h4></td></tr><tr><th>
				<h5>Grievance Type : '.$type.'</h5></th></tr><tr><th>
				<h5>Grievance Status : '.$status.'<br><br></h5></th></tr><tr><td style="padding:11px;background:white">
				<font size="2">
				<b>Student Name : </b>'.$name.' <br>
				<b>Register Number : </b>'.$rno.' <br>
				<b>Department : </b>'.$depe.' <br>
				<b>Semester : </b>'. $sem .' <sup>st </sup> SEM <br>
				<b>Mobile Number : </b>'.$mobile.' <br>
				<b>Email : </b>'.$email.' <br>
				<b>Subject : </b>'.$sub.' <br>
				<b>Grievance Description : </b>'.$desc.' <br>
				<b>External File : </b>'.$file.' <br>
				</font></td></tr></table></div>
				<p align="right" style="margin-right:11px;"><br><input type="button" style="background:#0083d0;border:0px;outline:0px;padding:5px 11px;border-radius:3px;color:white;cursor:pointer"
				onclick=PrintDiv(this.name) name="'.$row['id'].'" value="Print"/></p>
				</div>';
	
			}
			if($type == "STAFF")
			{
	
				
				$io .= '<div class="ioout"><div id="'.$id.'"><table width="100%" style="text-align:left;" border="0"><tr><th><br>
				Placed On : '.$cdate.'</th></tr><tr><th>
				Grievance Type : '.$type.'</th></tr><tr><th>
				Grievance Status : '.$status.'<br><br></th></tr><tr><td style="padding:11px;background:white">
				<font size="2">
				<b>Employee Name : </b>'.$name.' <br>
				<b>Employee Register Number : </b>'.$rno.' <br>
				<b>Department : </b>'.$depe.' <br>
				<b>Mobile Number : </b>'.$mobile.' <br>
				<b>Email : </b>'.$email.' <br>
				<b>Subject : </b>'.$sub.' <br>
				<b>Grievance Description : </b>'.$desc.' <br>
				<b>External File : </b>'.$file.' <br>
				</font></td></tr></table></div>
				<p align="right" style="margin-right:11px;"><br><input type="button" style="background:#0083d0;border:0px;outline:0px;padding:5px 11px;border-radius:3px;color:white;cursor:pointer"
				onclick=PrintDiv(this.name) name="'.$row['id'].'" value="Print"/></p>
				</div>';
	
			}
			if($type == "PUBLIC")
			{
				
				$io .= '<div class="ioout"><div id="'.$id.'"><table width="100%" style="text-align:left;" border="0"><tr><th><br>
				Placed On : '.$cdate.'</th></tr><tr><th>
				Grievance Type : '.$type.'</th></tr><tr><th>
				Grievance Status : '.$status.'<br><br></th></tr><tr><td style="padding:11px;background:white">
				<font size="2">
				<b>Name : </b>'.$name.' <br>
				<b>Address : </b>'.$rno.' <br>
				<b>Mobile Number : </b>'.$mobile.' <br>
				<b>Email : </b>'.$email.' <br>
				<b>Subject : </b>'.$sub.' <br>
				<b>Grievance Description : </b>'.$desc.' <br>
				<b>External File : </b>'.$file.' <br>
				</font></td></tr></table></div>
				<p align="right" style="margin-right:11px;"><br><input type="button" style="background:#0083d0;border:0px;outline:0px;padding:5px 11px;border-radius:3px;color:white;cursor:pointer"
				onclick=PrintDiv(this.name) name="'.$row['id'].'" value="Print"/></p>
				</div>';
			}
	
		}
	}
	else
	{
		$io= "<center><h2 style='color:#ea4335;'>0</h2> <h4>Result's found on this filter!. </h4></center>";
	}
	


}

//new


if(isset($_GET['key']))
{
	$io = null;
	$get = '%' . $_GET['key'];
	
$rt = mysqli_query($con,"SELECT id,name,email,type,mobile,regno,dept,sem,status,subject,des,filename,data,data1 FROM staff where email='$email' AND name LIKE '$get' or des LIKE '$get' or subject LIKE '$get' or regno LIKE '$get'   UNION ALL
	SELECT id,name,email,type,mobile,regno,dept,sem,status,subject,des,filename,data,data1 FROM student where email='$email' AND name LIKE '$get' or des LIKE '$get' or subject LIKE '$get' or regno LIKE '$get'   UNION ALL
	SELECT id,name,email,type,mobile,regno,dept,sem,status,subject,des,filename,data,data1 FROM publi_c where email='$email' AND name LIKE '$get' or des LIKE '$get' or subject LIKE '$get' or regno LIKE '$get'  ");   
		
	if ($rt->num_rows > 0) {

		while($row = $rt->fetch_assoc()) {
			
			$id = $row['id'];
			$type = $row['type'];
			$email = $row['email'];
			$name = $row['name'];
			$st = $row['status'];
			$mobile = $row['mobile'];
			$depe = $row['dept'];
			$sem = $row['sem'];
			$sub = $row['subject'];
			$desc = $row['des'];
			$cdate = $row['data'];
			$fdate = $row['data1'];
			$filename = $row['filename'];
			if($st == "pending")
			{
		$status = '<font size="2" style="background:#dd5246;padding:0px 14px;border-radius:0px" color="white">Pending</font>';
			}
			if($st == "inprogress")
			{
		$status = '<font size="2" style="background:#ffce45;padding:0px 14px;border-radius:0px" color="white">In Progress</font>';
			}
			if($st == "completed")
			{
		$status = '<font size="2" style="background:#18a05e;padding:0px 14px;border-radius:0px" color="white">Completed</font>';
			}
			if($filename == "")
			{
			$file="No File Chosen!";
			}else
			{
			$file = $filename;
			}
	
	
			$rno = $row['regno'];
	
	
			if($type == "STUDENT")
			{
	
	
				$io .= '<div class="ioout"><div id="'.$id.'"><table width="100%" style="text-align:left;" border="0"><tr><td><br>
				<h4>Placed On : '.$cdate.'</h4></td></tr><tr><th>
				<h5>Grievance Type : '.$type.'</h5></th></tr><tr><th>
				<h5>Grievance Status : '.$status.'<br><br></h5></th></tr><tr><td style="padding:11px;background:white">
				<font size="2">
				<b>Student Name : </b>'.$name.' <br>
				<b>Register Number : </b>'.$rno.' <br>
				<b>Department : </b>'.$depe.' <br>
				<b>Semester : </b>'. $sem .' <sup>st </sup> SEM <br>
				<b>Mobile Number : </b>'.$mobile.' <br>
				<b>Email : </b>'.$email.' <br>
				<b>Subject : </b>'.$sub.' <br>
				<b>Grievance Description : </b>'.$desc.' <br>
				<b>External File : </b>'.$file.' <br>
				</font></td></tr></table></div>
				<p align="right" style="margin-right:11px;"><br><input type="button" style="background:#0083d0;border:0px;outline:0px;padding:5px 11px;border-radius:3px;color:white;cursor:pointer"
				onclick=PrintDiv(this.name) name="'.$row['id'].'" value="Print"/></p>
				</div>';
	
			}
			if($type == "STAFF")
			{
	
				
				$io .= '<div class="ioout"><div id="'.$id.'"><table width="100%" style="text-align:left;" border="0"><tr><th><br>
				Placed On : '.$cdate.'</th></tr><tr><th>
				Grievance Type : '.$type.'</th></tr><tr><th>
				Grievance Status : '.$status.'<br><br></th></tr><tr><td style="padding:11px;background:white">
				<font size="2">
				<b>Employee Name : </b>'.$name.' <br>
				<b>Employee Register Number : </b>'.$rno.' <br>
				<b>Department : </b>'.$depe.' <br>
				<b>Mobile Number : </b>'.$mobile.' <br>
				<b>Email : </b>'.$email.' <br>
				<b>Subject : </b>'.$sub.' <br>
				<b>Grievance Description : </b>'.$desc.' <br>
				<b>External File : </b>'.$file.' <br>
				</font></td></tr></table></div>
				<p align="right" style="margin-right:11px;"><br><input type="button" style="background:#0083d0;border:0px;outline:0px;padding:5px 11px;border-radius:3px;color:white;cursor:pointer"
				onclick=PrintDiv(this.name) name="'.$row['id'].'" value="Print"/></p>
				</div>';
	
			}
			if($type == "PUBLIC")
			{
				
				$io .= '<div class="ioout"><div id="'.$id.'"><table width="100%" style="text-align:left;" border="0"><tr><th><br>
				Placed On : '.$cdate.'</th></tr><tr><th>
				Grievance Type : '.$type.'</th></tr><tr><th>
				Grievance Status : '.$status.'<br><br></th></tr><tr><td style="padding:11px;background:white">
				<font size="2">
				<b>Name : </b>'.$name.' <br>
				<b>Address : </b>'.$rno.' <br>
				<b>Mobile Number : </b>'.$mobile.' <br>
				<b>Email : </b>'.$email.' <br>
				<b>Subject : </b>'.$sub.' <br>
				<b>Grievance Description : </b>'.$desc.' <br>
				<b>External File : </b>'.$file.' <br>
				</font></td></tr></table></div>
				<p align="right" style="margin-right:11px;"><br><input type="button" style="background:#0083d0;border:0px;outline:0px;padding:5px 11px;border-radius:3px;color:white;cursor:pointer"
				onclick=PrintDiv(this.name) name="'.$row['id'].'" value="Print"/></p>
				</div>';
			}
	
		}
	}
	else
	{
		$io= "<center><h2 style='color:#ea4335;'>0</h2> <h4>Result's found on this filter!. </h4></center>";
	}
	


}













$rt = mysqli_query($con,"SELECT email FROM staff where email='$email' and status='pending' UNION ALL
SELECT email FROM student where email='$email' and status='pending' UNION ALL
SELECT email FROM publi_c where email='$email' and status='pending'
");  
$pending = mysqli_num_rows($rt);


$rt1 = mysqli_query($con,"SELECT email FROM staff where email='$email' and status='inprogress' UNION ALL
SELECT email FROM student where email='$email' and status='inprogress' UNION ALL
SELECT email FROM publi_c where email='$email' and status='inprogress'
");  
$inprogress = mysqli_num_rows($rt1);

$rt1 = mysqli_query($con,"SELECT email FROM staff where email='$email' and status='completed' UNION ALL
SELECT email FROM student where email='$email' and status='completed' UNION ALL
SELECT email FROM publi_c where email='$email' and status='completed'
");  
$completed = mysqli_num_rows($rt1);





?>
<?php include "header.php"; ?>
<div class="frame">
<font size="6" style="color:#333333;font-weight:bold">WELCOME BACK</font>
<center><font color="#3e3e3e" size="2">Now check your grievance status live. Find what action taken about your grievance!. </font></center>
<font size="2" class="sign"><?php echo $email ?></font> 
<br>
<div class="row">
<div class="clm" onclick="window.location='?filter=pending'">
  
<font size="4" style="font-weight:bold" color=""><?php echo $pending ?></font><br>
<font size="2" style="background:#dd5246;padding:1px 6px;border-radius:4px" color="white">Pending</font>
<br>
</div>
<div class="clm" onclick="window.location='?filter=inprogress'">
<font size="4" style="font-weight:bold"><?php echo $inprogress ?></font><br>
<font size="2" style="background:#ffce45;padding:1px 6px;border-radius:4px" color="white" >In Progress
</font>
<br>
</div>
<div class="clm" onclick="window.location='?filter=completed'">
<font size="4" style="font-weight:bold" color=""><?php echo $completed ?></font><br>
<font size="2" style="background:#18a05e;padding:1px 6px;border-radius:4px" color="white">Completed</font>
<br>
</div>
</div>
</div>
<div class="search" style="overflow-y:scroll">
<center>
<table class="tb" border="0" height="49">
<tr><td>
<form>
<input type="text" name="key"  class="inputtxt" placeholder="Search Grievance" required> 
<input type="Submit" class="inputbtn" value="Search">
</form></td><td>
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
<form>
<input type="date" class="inputtxt" name="date" required>
<input type="Submit" class="inputbtn" value="Filter">
</form></td></tr></table>
</div><center><br>
<div class="output">
<?php echo $io ?>
<div></center>


<center><br>
<?php include "../include/down.php"; ?>



</center>
<br>




<script type="text/javascript">
        function PrintDiv(d) {
            var divContents = document.getElementById(d).innerHTML;
            var printWindow = window.open('', '', 'height=700,width=500');
            printWindow.document.write('<html><head><title>Grievance Redressal Cell</title>');
            printWindow.document.write('<h1>Grievance Redressal Cell</h1><hr></head><body style="font-family:arial;margin:14px;margin-top:35px;">');
            printWindow.document.write(divContents);
            printWindow.document.write('<hr><font size="2"><center>Copyrights &copy; Grievance all rights reserved</center></body></html>');
            printWindow.document.close();
            printWindow.print();
        }
    </script>
     


