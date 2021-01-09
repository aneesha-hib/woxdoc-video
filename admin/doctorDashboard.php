<?php
// Initialize the session
session_start();
require '../config.php';
// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
  header("location: login.php");
  exit;
}
$doctor_id = $_SESSION['admin'];
$doctor = $_GET['id'];
$query = "SELECT * from users where id =$doctor";
$res = mysqli_query($link, $query);
while ($row = $res->fetch_assoc()) {


  $_username   = $row["username"];
  $_email    = $row["email"];
  $_address       = $row["address"];
  $_phone       = $row["phone"];
  $_department     = $row["department"];
  $_id = $row['id'];
}

if (isset($_POST["Symptoms"])) {


  // require '../config.php';

  $Patient_id = $_POST['Patient_id'];
  $Symptoms = $_POST['Symptoms'];
  $prescription = $_POST['Prescription'];



  ("$id-$Symptoms-$prescription");



  $sql = "INSERT INTO `prescription`(`patient_id` , `symptoms`, `prescription`) VALUES ('$Patient_id','$Symptoms','$prescription')";
  if ($link->query($sql) === TRUE) {
    echo '<script language="javascript">';
    echo 'alert("Added successfully ")';
    echo '</script>	<script type="text/javascript">
    $(document).ready(function(){
        $("#myModal").modal("show");
    });';

?>





    // <div class="alert alert-success">
      // <strong><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span></strong><a href="#" class="alert-link">Booked Successfully</a>.
      // </div>
<?php
    //echo("<h1 style='color:red'></h1>");
  } else {
    echo (" Not Successfully $sql");
  }
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

  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Popins:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">


  <link href="../css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top" onload=display_c();>

  <!-- Page Wrapper -->
  <!-- End of Topbar -->
  <?php include 'header.php'; ?>
  <!-- Begin Page Content -->


  <div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800"><?php echo $_username; ?></h1>
      <button class="btn btn-danger btn-sm text-light  " id='<?php echo $_id ?>'><i class="fa fa-pencil" aria-hidden="true" data-toggle="modal" data-target="#exampleModal1">Delete Account</i></button>
      <!--<a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
    </div>

    <!-- Content Row -->
    <div class="row">


      <?php

      $query = "SELECT  count(*) as count FROM patient_list where id='$_id' ";
      $result = mysqli_query($link, $query);


      if ($result) {
        //echo $result->num_rows;
        //$row = $result->fetch_assoc();
        while ($row = $result->fetch_assoc()) {


          //$FirstName 	= $row["FirstName"];
          $count  = $row["count"];


      ?>


          <!-- Earnings (Monthly) Card Example -->
          <div class="col-xl-3 col-md-6 mb-4">
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



      <?php }
      } ?>






      <?php
      // require_once '../config.php';
      $query = "SELECT count(*) as count FROM `patient_list` WHERE created_on > (NOW() - INTERVAL 1 MONTH) and id='$_id' ";
      //echo $query;
      $result = mysqli_query($link, $query);


      if ($result) {
        //echo $result->num_rows;
        //$row = $result->fetch_assoc();
        while ($row = $result->fetch_assoc()) {


          //$FirstName 	= $row["FirstName"];
          $count  = $row["count"];

      ?>
          <div class="col-xl-3 col-md-6 mb-4">
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
      <?php }
      } ?>



      <?php
      // require_once '../config.php';
      $query = "SELECT count(*) as count FROM `prescription` INNER JOIN `patient_list` 
ON `patient_list`.`patientlist_id`=`prescription`.`patientlist_id`
 WHERE date(prescriped_date) = CURDATE() and `patient_list`.`id`='$_id' ";
      $result = mysqli_query($link, $query);


      if ($result) {
        //echo $result->num_rows;
        //$row = $result->fetch_assoc();
        while ($row = $result->fetch_assoc()) {


          //$FirstName 	= $row["FirstName"];
          $count  = $row["count"];

      ?>
          <!-- Pending Requests Card Example -->
          <div class="col-xl-3 col-md-6 mb-4">
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
      <?php }
      } ?>

      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Subscription plan</div>
                <?php
                $query = "SELECT `subscriptionType` FROM `subscription` WHERE `doctorId`='$_id'  ";
                $result = mysqli_query($link, $query);


                if ($result) {
                  //echo $result->num_rows;
                  //$row = $result->fetch_assoc();
                  while ($row = $result->fetch_assoc()) {


                    //$FirstName 	= $row["FirstName"];
                    $subscription  = $row["subscriptionType"];
                ?>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo  $subscription; ?></div>
                <?php }
                } ?>
              </div>
              <div class="col-auto">
                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>


    </div>



    <!-- Content Row -->

    <!-- <div class="row mt-5">
			
			<div class="col-md-6" align="center">
				<a href="add_new_patient.php" class="btn btn-primary btn-icon-split btn-lg">
                    <span class="icon text-white-50">
                      <i class="fas fa-user-plus"></i>
                    </span>
                    <span class="text">Add new Patient</span>
                  </a>
			</div>	

			<div class="col-md-6" align="center">
				  <a href="existing_patients.php" class="btn btn-primary btn-icon-split btn-lg">
                    <span class="icon text-white-50">
                      <i class="fas fa-users"></i>
                    </span>
                    <span class="text">Existing Patient</span>
                  </a>
			</div>
          </div>-->
    <?php include 'patientlistbyDoctor.php'; ?>
  </div>
  <!-- /.container-fluid -->

  </div>
  <!-- End of Main Content -->





  <!-- Footer -->
  <?php include 'footer.php'; ?>
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
          <form class="user" method="POST">
            <div class="form-group row">
              <div class="col-sm-2 mb-3 mb-sm-0">
                <!--<input type="text" class="form-control form-control-user" id="FirstName" name="FirstName" placeholder="First Name"> -->
                <div class="col-sm-3 mb-0 font-weight-bold text-gray-800"><b>Patient Id</b></div>
              </div>
              <div class="col-sm-6">
                <input type="text" class="form-control form-control-user" value="<?php echo $id; ?>" id="Patient_id" name="Patient_id" placeholder="Patient_id">
              </div>
            </div>

            <div class="form-group">

              <input type="text" class="form-control form-control-user" id="Symptoms" name="Symptoms" placeholder="Symptoms">


            </div>


            <div class="form-group">
              <input type="text" class="form-control form-control-user" id="Prescription" name="Prescription" placeholder="Prescription">
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
  <!-- Modal -->
  <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <h5>Are you sure to want to delete this Doctor ?</h5>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>

          <a class="btn btn-danger" href="delete_doctor.php?id=<?php echo $_id ?>" role="button">Delete</a>
        </div>
      </div>
    </div>
  </div>
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../js/sb-admin-2.min.js"></script>

</body>

</html>