
<?php include "header.php" ?>
<?php

if(isset($_POST['updatep']))
{
$name= $_POST['name'];
$oldpass = md5($_POST['oldpass']);
$newpass = md5($_POST['newpass']);
$qrs = "select * from user WHERE email='$email' limit 1";
$ru = mysqli_query($con,$qrs);
$getRowAssocms = mysqli_fetch_assoc($ru);
$pass = $getRowAssocms['pass'];

if($oldpass == $pass)
{
    $sql = "UPDATE user SET pass='$newpass',name='$name' WHERE email='$email'";

    if ($con->query($sql) === TRUE)
    {
        $uppass = '<font color="green" size="2">Details Updated Successfully!.</font>';
        $ip = $_SERVER['REMOTE_ADDR'];
        
$subject = "Security Alert Password changed!. Grievance redressal cell.";
$message = "
<html>
<head>
<title>Security Alert Password changed!. Grievance redressal cell.</title>
</head>
<body ='background-color:white;padding:23px 11px 23px 11px;font-family:arial'>
<center><p style='font-size:30px'>
<b><font color='#4285f4'>G</font><font color='#ea4335'>r</font><font color='#fbbc05'>i</font><font color='#4285f4'>e</font><font color='#34a853'>v</font><font color='#ea4335'>a</font><font color='#4285f4'>n</font><font color='#ea4335'>c</font><font color='#fbbc05'>e</font></p><hr style='border:1px solid whitesmoke;width:80%'/><p align='left'style='text-align:left'><br><font color='gray'>Security Alert Password changed!. Grievance redressal cell.</h5>
</p></font></font><p align='left'>
<br><b>IP :</b> $ip <br>
	
	<br<br><br><Br></p>
<p align='left'><font size='1'>From<br><b>Rajsoft Technologies</b></font><br>www.rajsoft.org.in<br>
<font color='silver' size='1'>&copy; Rajsoft PVT, Ltd.,Kolar Gold fields, KGF, Karnataka, India.<br>This is an Computer Generated email, Do not Replay!. </font><br><br>
</body>
</html>
";

// Always set content-type when sending HTML 
   $header = "From:Security_Alert@no-replay.rajsoft.org.in \r\n";
   $header .= "MIME-Version: 1.0\r\n";
   $header .= "Content-type: text/html\r\n";

if(mail($adminemail,$subject,$message,$header))
{

echo "emailo sent";

}

        
    } else {
      echo "<script>alert('Somthing Went wrong!');</script>";
    }
}
else
{
    $uppass = '<font color="red" size="2">Password not matched!</font>';
}
}

if(isset($_POST['adduser']))
{
$name= $_POST['name'];
$newpass = md5($_POST['pass']);
$addemail = $_POST['email'];
$sql_quer = "select count(*) as ntUser from user where email='$addemail'";
$resul = mysqli_query($con,$sql_quer);
$ro = mysqli_fetch_array($resul);
$coun = $ro['ntUser'];
if($coun > 0)
{
  $output = '<font color="red" size="2">Email already exist!.</font>';
}else
{
    $sql = "INSERT INTO user (name, email, pass) VALUES ('$name', '$addemail', '$newpass') ";

    if ($con->query($sql) === TRUE)
    {
        $output = '<font color="green" size="2">User Added Successfully!.</font>';
    } else {
      echo "<script>alert('Somthing Went wrong!');</script>";
    }
}




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
                <li class="breadcrumb-item active" aria-current="page">Profile Settings</li>
              </ol>
            </nav>

            <div class="pb-3">
              <h1>Profile Settings</h1>
            </div>


            <div class="row">
              <div class="col-lg-6">
                <div class="card mb-grid">
                  <div class="card-header">
                    <div class="card-header-title"><i class="fas fa-user-shield"></i> Update Username & Password</div>
                  </div>
                  <div class="card-body collapse show">
                  <form method="POST">
                  <center><?php echo $uppass ?></center>
                    <div class="">
                      <label class="form-label">User Name</label>
                      <input class="form-control mb-2 input-credit-card" name="name" type="text" value="<?php echo $adname ?>" placeholder="User Name" required>
                    </div>

                    <div class="">
                      <label class="form-label">Old Password</label>
                      <input class="form-control input-date mb-2" name="oldpass" type="Password" placeholder="Enter Your Old Password" required>
                    </div>

                    <div class="">
                      <label class="form-label">New Password</label>
                      <input pattern=".{6,}" class="form-control input-numeral mb-2" name="newpass" type="password" placeholder="Enter Your New Password" required>
                      <font size="2" style="color:red;size:px">Password must be at least 6 or more characters</font>
                    
                    </div>
                    <div class="">
                      <label for="customCheck1" class=""><input type="checkbox" required> I am sure that updating my Profile information</label>
                 </div>
                 <div class="">
                 <button type="submit" name="updatep" class="btn btn-primary">Update</button>
                    </div>
                  </div>
                  </form>
                </div>
               
              </div>

              <div class="col-lg-6">
                <div class="card mb-grid">
                  <div class="card-header">
                    <div class="card-header-title"><i class="fas fa-user-plus"></i> Add New User</div>
                  </div>
                  <div class="card-body"><form method="POST">
                  <center><?php echo $output ?></center>
                    <div class="form-group">
                      <label class="form-label">Email</label>
                      <input class="form-control mb-2 date-default" name="email" type="email" placeholder="Enter Your Email" required>
                    </div>

                   

                    <div class="form-group">
                      <label class="form-label">User Name</label>
                      <input class="form-control date-human" name="name" type="text" placeholder="Username" required>
                                        </div>

                    <div class="form-group">
                      <label class="form-label">Password</label>
                      <input pattern=".{6,}" class="form-control input-numeral mb-2" name="pass" type="password" placeholder="Enter Your New Password" required>
                      <font size="2" style="color:red;size:px">Password must be at least 6 or more characters</font>
                     </div>
                   
                      <label for="customCheck1" class=""><input type="checkbox" required> Adding a new user, Means you are giving a complete access to admin dashboard, Are you sure about this?.</label>
                      <div class="">
                 <button type="submit" name="adduser" class="btn btn-primary">Add User</button>
                    </div>
               
                  </div>
                  </from>
                </div>
          </div></div>
   
      <!-- // Main Content -->
      <div class="pb-3">
              <h3>Manage Users!.</h3></div>


                <div class="color">
                <div class="card-header">
                    <div class="card-header-title"><i class="far fa-trash-alt"></i> Remove Dashboard Users</div>
                  </div><br>
                <?php 

$sql = "SELECT * FROM `user` ORDER BY id ASC";
$result = $con->query($sql);                      
if ($result->num_rows > 0) {
// output data of each row
while($row = $result->fetch_assoc()) {
echo "<p class=cc style='background:#f9f9f9;width:100%;border-radius:4px;text-align:left;padding:11px;border:1px solid #dddfe0;'><b>{$row['email']}</b><br><font size=2><b>Name: </b>{$row['name']}<br><object align=right><input style='background:#d82537;color:white;padding:2px 17px;border:0px;outline:none;cursor:pointer;border-radius:3px;' type=button class=rm value=Remove onclick=window.location='remove?id={$row['email']}'></input></object><br></p>";

      }
} else {
   echo "<br><br><h3 style='color:#6c2464;'>0</h3>User's found.<br><br>";
}




?>   </div>
<center><br>
<?php include "../include/down.php"; ?></center>
<br>
                  
               
   </div></div></div>
 



