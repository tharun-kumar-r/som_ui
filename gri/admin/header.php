<?php
include "../include/@config-domain.php";
//require "../include/resmail/PHPMailerAutoload.php";
session_start();
if(empty($_SESSION['admin_lock']))
{
  echo"<script>window.location='./';</script>";
}

$adminemail = $_SESSION['admin_lock'];

$dim =  basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']);

if($dim == "dashboard")
{
  $active = " active";
}
if($dim == "grie_all")
{
  $active1 = " active";
}
if($dim == "pending")
{
  $active2 = " active";
}
if($dim == "progress")
{
  $active3 = " active";
}
if($dim == "completed")
{
  $active4 = " active";
}
if($dim == "profile")
{
  $active8 = " active";
}
if($dim == "stdreport")
{
  $active5 = " active";
}
if($dim == "publicreport")
{
  $active7 = " active";
}
if($dim == "stfreport")
{
  $active6 = " active";
}





$email = $_SESSION['admin_lock'];

$rt = mysqli_query($con,"SELECT email FROM staff  UNION ALL
SELECT email FROM student UNION ALL
SELECT email FROM publi_c ");  
$all = mysqli_num_rows($rt);




$rt = mysqli_query($con,"SELECT status FROM staff where status='pending' UNION ALL
SELECT status FROM student where status='pending' UNION ALL
SELECT status FROM publi_c where status='pending'
");  
$pending = mysqli_num_rows($rt);


$rt1 = mysqli_query($con,"SELECT status FROM staff where status='inprogress' UNION ALL
SELECT status FROM student where status='inprogress' UNION ALL
SELECT status FROM publi_c where status='inprogress'
");  
$inprogress = mysqli_num_rows($rt1);

$rt1 = mysqli_query($con,"SELECT status FROM staff where status='completed' UNION ALL
SELECT status FROM student where status='completed' UNION ALL
SELECT status FROM publi_c where status='completed'
");  
$completed = mysqli_num_rows($rt1);


$qrs = "select * from user WHERE email='$adminemail' limit 1";
$ru = mysqli_query($con,$qrs);
$getRowAssocms = mysqli_fetch_assoc($ru);
$adname = $getRowAssocms['name'];



?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Grievance Redressal Cell | Dashboard</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <link rel="stylesheet" type="text/css" href="./dist/css/adminx.css" />
    <link rel="stylesheet" type="text/css" href="./dist/css/css.css" />
    <link rel="icon" type="image/png" href="../img/123.png" />
    <!--
      # Optional Resources
      Feel free to delete these if you don't need them in your project
    -->
  </head>
  
  <body>
    <div class="adminx-container">
      <nav class="navbar navbar-expand justify-content-between fixed-top">
        <a class="navbar-brand mb-0 h1 d-none d-md-block" href="./">
        <b> <font size="5"><font color="#4285f4">G</font><font color="#ea4335">r</font><font color="#fbbc05">i</font><font color="#4285f4">e</font><font color="#34a853">v</font><font color="#ea4335">a</font><font color="#4285f4">n</font><font color="#ea4335">c</font><font color="#fbbc05">e</font>
</b></font><font size="3"color="#494952">| <?php echo $email ?></font> 
        </a>

    

        <div class="d-flex flex-1 d-block d-md-none">
          <a href="#" class="sidebar-toggle ml-3">
            <i data-feather="menu"></i>
          </a>
        </div>

        <ul class="navbar-nav d-flex justify-content-end mr-2">
          
         
          <!-- Notifications -->
          <li class="nav-item dropdown">
            <a class="nav-link avatar-with-name" id="navbarDropdownMenuLink" data-toggle="dropdown" href="#">
             <font color="#38383f">Welcome <?php echo substr($adname, 0, 6).".."; ?> </font><i class="fas fa-user-circle"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="profile">  <i class="fas fa-users-cog"></i> Profile</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item text-danger" href="logout"><i class="fas fa-sign-out-alt"></i> Sign out</a>
            </div>
          </li>
        </ul>
      </nav>

      <!-- expand-hover push -->
      <!-- Sidebar -->
      <div class="adminx-sidebar expand-hover push">
        <ul class="sidebar-nav">
          <li class="sidebar-nav-item">
            <a href="dashboard" class="sidebar-nav-link<?php echo $active ?>">
              <span class="sidebar-nav-icon">
                <i data-feather="home"></i>
              </span>
              <span class="sidebar-nav-name">
                Dashboard
              </span>
              <span class="sidebar-nav-end">

              </span>
            </a>
          </li>

          <li class="sidebar-nav-item">
            <a href="grie_all" class="sidebar-nav-link<?php echo $active1 ?>">
              <span class="sidebar-nav-icon">
                <i data-feather="layout"></i>
              </span>
              <span class="sidebar-nav-name">
                All Grievances 
              </span>
              <span class="sidebar-nav-end">
                <span class="badge badge-info"><?php echo $all ?></span>
              </span>
            </a>
          </li>
		  
  <li class="sidebar-nav-item">
            <a href="pending" class="sidebar-nav-link<?php echo $active2 ?>">
              <span class="sidebar-nav-icon">
               <i class="far fa-eye-slash"></i>
              </span>
              <span class="sidebar-nav-name">
                Pending 
              </span>
              <span class="sidebar-nav-end">
                <span class="badge badge-danger"><?php echo $pending ?></span>
              </span>
            </a>
          </li>
		  
		  
		   <li class="sidebar-nav-item">
            <a href="progress" class="sidebar-nav-link<?php echo $active3 ?>">
              <span class="sidebar-nav-icon">
               <i class="fas fa-spinner"></i>
              </span>
              <span class="sidebar-nav-name">
                In Progress 
              </span>
              <span class="sidebar-nav-end">
                <span class="badge badge-warning"><?php echo $inprogress ?></span>
              </span>
            </a>
          </li>
		  
		  	   <li class="sidebar-nav-item">
            <a href="completed" class="sidebar-nav-link<?php echo $active4 ?>">
              <span class="sidebar-nav-icon">
               <i class="far fa-check-circle"></i>
              </span>
              <span class="sidebar-nav-name">
              Completed  
              </span>
              <span class="sidebar-nav-end">
                <span class="badge badge-success"><?php echo $completed ?></span>
              </span>
            </a>
          </li>
		  
         
           

          <li class="sidebar-nav-item">
            <a class="sidebar-nav-link collapsed" data-toggle="collapse" href="#navExtra" aria-expanded="false" aria-controls="navExtra">
              <span class="sidebar-nav-icon">
                <i data-feather="layers"></i>
              </span>
              <span class="sidebar-nav-name">
                Grievance Report 
              </span>
              <span class="sidebar-nav-end">
                <i data-feather="chevron-right" class="nav-collapse-icon"></i>
              </span>
            </a>

            <ul class="sidebar-sub-nav collapse" id="navExtra">
              <li class="sidebar-nav-item">
                <a href="stdreport" class="sidebar-nav-link<?php echo $active5 ?>">
                  <span class="sidebar-nav-abbr">
                    SR
                  </span>
                  <span class="sidebar-nav-name">
                    Student Report 
                  </span>
                </a>
              </li>

              <li class="sidebar-nav-item">
                <a href="stfreport" class="sidebar-nav-link<?php echo $active6 ?>">
                  <span class="sidebar-nav-abbr">
                    SF
                  </span>
                  <span class="sidebar-nav-name">
                    Staff Report
                  </span>
                </a>
              </li>

              <li class="sidebar-nav-item">
                <a href="publicreport" class="sidebar-nav-link<?php echo $active7 ?>">
                  <span class="sidebar-nav-abbr">
                    PR
                  </span>
                  <span class="sidebar-nav-name">
                    Public Report
                  </span>
                </a>
              </li>
            </ul>
          </li>
		  <li class="sidebar-nav-item">
            <a href="profile" class="sidebar-nav-link<?php echo $active8 ?>">
              <span class="sidebar-nav-icon">
               <i class="far fa-user-circle"></i>
              </span>
              <span class="sidebar-nav-name">
                Profile Setting
              </span>
              
            </a>
          </li>
		  
		  	   <li class="sidebar-nav-item">
            <a href="logout" class="sidebar-nav-link<?php echo $active9 ?>">
              <span class="sidebar-nav-icon">
               <i class="fas fa-sign-out-alt"></i>
              </span>
              <span class="sidebar-nav-name">
                Logout   
              </span>
             
            </a>
          </li>
		  
		  
		  
        </ul>
      </div><!-- Sidebar End -->

      <!-- adminx-content-aside -->
<!-- The Modal -->


	  
	  
	  
	
    <!-- If you prefer jQuery these are the required scripts -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
    <script src="./dist/js/vendor.js"></script>
    <script src="./dist/js/adminx.js"></script>

    <!-- If you prefer vanilla JS these are the only required scripts -->
    <!-- script src="./dist/js/vendor.js"></script>
    <script src="./dist/js/adminx.vanilla.js"></script-->
  </body>
</html>
