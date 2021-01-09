<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
$doctor_id=$_SESSION['id'];

if(isset($_POST["Symptoms"]))
  {
				      

    require 'config.php';

    $Patient_id=$_POST['Patient_id'];
    $Symptoms=$_POST['Symptoms'];
    $prescription=$_POST['Prescription'];



    echo("$id-$Symptoms-$prescription");



    $sql = "INSERT INTO `prescription`(`patient_id` , `symptoms`, `prescription`) VALUES ('$Patient_id','$Symptoms','$prescription')";
    if ($link->query($sql) === TRUE) {
	  echo '<script language="javascript">';
    echo 'alert("Added successfully ")';
    echo '</script><script type="text/javascript">
    $(document).ready(function(){
        $("#myModal").modal("show");
    });
	';

?>
	

	

  //   <div class="alert alert-success">
  // <strong><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span></strong><a href="#" class="alert-link">Booked Successfully</a>.
  //   </div>
    <?php
//echo("<h1 style='color:red'></h1>");
	}					
else {echo(" Not Successfully $sql" );	}						  
}		  
?>
							 
							 
							 
				

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Index</title>


  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

 
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top" onload=display_c();>

  <!-- Page Wrapper -->
        <!-- End of Topbar -->
	<?php include 'header.php';?>
        <!-- Begin Page Content -->
		
		
		 <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <!--<a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
          </div>

          <!-- Content Row -->
          <div class="row">
		  
		  
<?php		
require 'config.php';
$query = "SELECT  count(*) as count FROM patient_list where id='$doctor_id'"; 
$result = mysqli_query($link,$query);

       
				if ($result) {
				//echo $result->num_rows;
		//$row = $result->fetch_assoc();
		while($row = $result->fetch_assoc()) 
	{
	

	    //$FirstName 	= $row["FirstName"];
		$count	= $row["count"];
	
	
?>
	

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Number of Patients</div>

						<div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo  $count; ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-address-card fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
				<?php }} ?>
          
			
<?php		
require_once 'config.php';
$query = "SELECT count(*) as count FROM `patient_list` WHERE created_on > (NOW() - INTERVAL 1 MONTH) and id='$doctor_id'"; 
//echo $query;
$result = mysqli_query($link,$query);

       
				if ($result) {
				//echo $result->num_rows;
		//$row = $result->fetch_assoc();
		while($row = $result->fetch_assoc()) 
	{
	

		//$FirstName 	= $row["FirstName"];
		$count	= $row["count"];
	
?>
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Patients joined this month</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $count ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas  fa-calendar fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
<?php }} ?>



<?php		
require_once 'config.php';
$query = "SELECT count(*) as count FROM `prescription` INNER JOIN `patient_list` 
          ON `patient_list`.`patientlist_id`=`prescription`.`patientlist_id`
           WHERE date(prescriped_date) = CURDATE() and `patient_list`.`id`='$doctor_id'"; 
$result = mysqli_query($link,$query);

       
				if ($result) {
				//echo $result->num_rows;
		//$row = $result->fetch_assoc();
		while($row = $result->fetch_assoc()) 
	{
	

		//$FirstName 	= $row["FirstName"];
		$count	= $row["count"];
	
?>
            <!-- Pending Requests Card Example -->
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">patients visited today</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $count; ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
<?php }} ?>
          <!-- Content Row -->

          <div class="row mt-5">
			
			<div class="col-md-6 mb-3 mb-sm-0" align="center">
				<a href="add_new_patient.php" class="btn btn-primary btn-icon-split btn-lg">
                    <span class="icon text-white-50">
                      <i class="fas fa-user-plus"></i>
                    </span>
                    <span class="text">Add new Patient</span>
                  </a>
			</div>	

			<div class="col-md-6 mb-3 mb-sm-0" align="center">
				  <a href="existing_patients.php" class="btn btn-primary btn-icon-split btn-lg">
                    <span class="icon text-white-50">
                      <i class="fas fa-users"></i>
                    </span>
                    <span class="text">Existing Patient </span>
                  </a>
			</div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

		
		
		

      <!-- Footer -->
      <?php include 'footer.php';?>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  

  <!-- Prescription modal end -->

<div class="modal fade" id="add_prescription" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
		

          <h5 class="modal-title" id="exampleModalLabel">Add Prescription for Patient id - <?php echo $id; ?></h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
			<div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
              </div>
              <form class="user" method="POST" >
                <div class="form-group row">
                  <div class="col-sm-2 mb-3 mb-sm-0">
                    <!--<input type="text" class="form-control form-control-user" id="FirstName" name="FirstName" placeholder="First Name"> -->
					<div class="col-sm-3 mb-0 font-weight-bold text-gray-800"><b>Patient Id</b></div>
                  </div>
                  <div class="col-sm-6">
                    <input type="text" class="form-control form-control-user" value=<?php echo $id; ?> id="Patient_id" name="Patient_id" placeholder="Patient_id" >
                  </div>
                </div>
				
				<div class="form-group">
                  
                    <input type="text" class="form-control form-control-user" id="Symptoms" name="Symptoms" placeholder="Symptoms">
                  
                  
                </div>
				
                
				<div class="form-group">
                  <input type="text" class="form-control form-control-user" id="Prescription"  name="Prescription" placeholder="Prescription">
                </div>
			
                <input type="submit" class="btn btn-primary btn-user btn-block">
                </input>
                <hr>
                
              </form>
		
		</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.html">Logout</a>
        </div>
      </div>
    </div>
  </div>
  <!-- Prescription modal end -->
  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
