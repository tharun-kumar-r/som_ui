 
<?php include "header.php" ?>
<?php 

$rt = mysqli_query($con,"SELECT subject,des,data,data1 FROM staff  UNION ALL
SELECT subject,des,data,data1 FROM student UNION ALL
SELECT subject,des,data,data1 FROM publi_c ORDER BY data1 DESC limit 1");  
$getRowAssoc = mysqli_fetch_assoc($rt);
$see = $getRowAssoc['subject'];
if ($see !== null)
{
$sub = $see;
$des = $getRowAssoc['des'];
$date = $getRowAssoc['data'];
}else
{
$sub = "Weclome";
$des = "Welcome Admin there is no grievances yet!, any new grievances found it will bee displayed here!.";
$date = date('d-m-yy');
}
$r = mysqli_query($con,"SELECT status,subject,des,data,data1 FROM staff WHERE status='inprogress' UNION ALL
SELECT status,subject,des,data,data1 FROM student WHERE status='inprogress'  UNION ALL
SELECT status,subject,des,data,data1 FROM publi_c WHERE status='inprogress'  ORDER BY data1 ASC limit 1");  
$getRowAsso = mysqli_fetch_assoc($r);
$s = $getRowAsso['subject'];

if ($s !== null)
{
$su = $s;
$de = $getRowAsso['des'];
$dat = $getRowAsso['data'];
}
else{
  $su = "Hello";
  $de = "I am new inprogress grievance displayer, right now no inprogress grievances found!.";
  $dat = date('d-m-yy');
}

?>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

      <div class="adminx-content">
        <!-- <div class="adminx-aside">

        </div> -->

        <div class="adminx-main-content">
          <div class="container-fluid">
            <!-- BreadCrumb -->
            <nav aria-label="breadcrumb" role="navigation">
              <ol class="breadcrumb adminx-page-breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
              </ol>
            </nav>

            <div class="pb-3">
              <h1>Dashboard</h1>
            </div>

            <div class="row">
              
            <div class="col-md-6 col-lg-3 d-flex">
                <div class="card border-0 bg-primary text-white text-center mb-grid w-100">
                  <div class="d-flex flex-row align-items-center h-100">
                    <div class="card-icon d-flex align-items-center h-100 justify-content-center">
                      <i class="fas fa-tasks"></i>
                    </div>
                    <div class="card-body">
                      <div class="card-info-title">Total Grievances</div>
                      <h3 class="card-title mb-0">
                        <?php echo $all ?>
                      </h3>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-lg-3 d-flex">
                <div class="card border-0 bg-danger text-white text-center mb-grid w-100">
                  <div class="d-flex flex-row align-items-center h-100">
                    <div class="card-icon d-flex align-items-center h-100 justify-content-center">
                     <i class="fas fa-eye-slash"></i>
                    </div>
                    <div class="card-body">
                      <div class="card-info-title">Pending Grievances</div>
                      <h3 class="card-title mb-0">
                        <?php echo $pending; ?>
                      </h3>
                    </div>
                  </div>
                </div>
              </div>


              <div class="col-md-6 col-lg-3 d-flex">
                <div class="card border-0 bg-warning text-white text-center mb-grid w-100">
                  <div class="d-flex flex-row align-items-center h-100">
                    <div class="card-icon d-flex align-items-center h-100 justify-content-center">
                      <i class="fas fa-spinner"></i>
                    </div>
                    <div class="card-body">
                      <div class="card-info-title">In progress Grievances</div>
                      <h3 class="card-title mb-0">
                        <?php echo $inprogress ?>
                      </h3>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-md-6 col-lg-3 d-flex">
                <div class="card border-0 bg-success text-white text-center mb-grid w-100">
                  <div class="d-flex flex-row align-items-center h-100">
                    <div class="card-icon d-flex align-items-center h-100 justify-content-center">
                      <i class="far fa-check-circle"></i>
                    </div>
                    <div class="card-body">
                      <div class="card-info-title">Completed Grievances</div>
                      <h3 class="card-title mb-0">
                      <?php echo $completed ?>
                      </h3>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-lg-8">
                <div class="card">
 <div class="card-header">
                    Overview 
                  </div>
                   <div class="card-header d-flex justify-content-between align-items-center" id="piechart"></div>

                </div>
              </div>
              <div class="col-lg-4">
                <div class="card">
                  <div class="card-header">
                    New Grievances
                  </div>
                  <div class="card-body">
                  <h4 class="card-title"><?php echo strtoupper($sub) ?></h4>
                    <b> <p class="card-title"><?php echo $date ?></b><br>
                     <?php echo substr($des, 0, 120).".."; ?></p>
                    <a href="grie_all" class="btn btn-sm btn-outline-primary">See More..</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
		  <center><br>
<?php include "../include/down.php"; ?>



</center>
<br>
        </div>
      </div>


<script type="text/javascript">
// Load google charts
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

// Draw the chart and set the chart values
function drawChart() {
  var data = google.visualization.arrayToDataTable([
  ['Task', 'overviewe'],
  ['PENDING GRIEVANCES', <?php echo $pending; ?> ],
  ['IN PROGRESS GRIEVANCES',  <?php echo $inprogress ?>],
  ['COMPLETED GRIEVANCES', <?php echo $completed ?>]
  
]);

  // Optional; add a title and set the width and height of the chart
  var options = {'height':219, colors: ['#dc3545', '#ffc107', '#28a745'] };

  // Display the chart inside the <div> element with id="piechart"
  var chart = new google.visualization.PieChart(document.getElementById('piechart'));
  chart.draw(data, options);
}
</script>
      