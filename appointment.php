<?php
require 'config.php';
$doctor_id = $_GET['id'];
$date=$_GET['date'];

$sql1 = "SELECT username from users where id='$doctor_id'";
$res = mysqli_query($link, $sql1);
$data = mysqli_fetch_row($res);
$doctor_name = $data[0];


if (isset($_POST['FirstName'])) {




  $fname = $_POST['FirstName'];
  $lname = $_POST['LastName'];
  $email = $_POST['Email'];
  $phone = $_POST['phone'];
  $address = $_POST['Address'];
  $sex = $_POST['sex'];
  $age = $_POST['Age'];
  $date=$_POST['date'];



  //echo("$name-$add-$Email-$Mobile");



   $sql = "INSERT INTO `appointment`(`FirstName`, `LastName`, `Email`, `Phone`, `Address`, `sex`, `Age`,`id`,`appointment_date`) VALUES ('$fname','$lname','$email','$phone','$address','$sex','$age','$doctor_id','$date')";

  if ($link->query($sql) === TRUE) {
echo "Appointment successfully submitted";
    //header("location: existing_patients.php");
  } else {
    echo ("Not Successfully $sql");
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

  <title>Appointment</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Popins:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top" onload=display_c();>

  <!-- Page Wrapper -->
  <!-- End of Topbar -->

  <!-- Begin Page Content -->


  <div class="container-fluid">

    <!-- Page Heading -->
    <div class="modal-body">
      <div class="text-center">
        <h1 class="h4 text-gray-900 mb-4">Take Appointment</h1>
      </div>
      <div><label>Consultation time from <b><?php echo $_GET['from'];?></b> to  <b><?php echo $_GET['to'];?></b></label></div>
      <form class="user" method="POST">
        <div class="form-group">

          <input type="text" class="form-control form-control-user" id="doctorname" name="doctorname" placeholder="First Name" value='<?php echo $doctor_name; ?>' required readonly>

        </div>
        <div class="form-group row">
          <div class="col-sm-6 mb-3 mb-sm-0">
            <input type="text" class="form-control form-control-user" id="FirstName" name="FirstName" placeholder="First Name" required>
          </div>
          <div class="col-sm-6">
            <input type="text" class="form-control form-control-user" id="LastName" name="LastName" placeholder="Last Name" required>
          </div>
        </div>

        <div class="form-group row">
          <div class="col-sm-6 mb-3 mb-sm-0">
            <input type="number" class="form-control form-control-user" id="Age" name="Age" placeholder="Age" required>
          </div>
          <div class="form-group row">
            <div class="radio form-control-user">
              <label><input type="radio" name="sex" value="male" checked>Male</label>
            </div>
            <div class="radio form-control-user">
              <label><input type="radio" name="sex" value="female">Female</label>
            </div>

          </div>
        </div>

        <div class="form-group">
          <input type="email" class="form-control form-control-user" id="Email" name="Email" placeholder="Email Address">
        </div>
        <div class="form-group">
          <input type="text" class="form-control form-control-user" id="Address" name="Address" placeholder="Address">
        </div>

        <div class="form-group row">
          <div class="col-sm-6 mb-3 mb-sm-0">
            <input type="number" class="form-control form-control-user" id="phone" name="phone" placeholder="phone" required>
          </div>
          <div class="col-sm-6 mb-3 ">
            <input class="form-control form-control-user" type="text" placeholder="Appointment Date" id="date" name="date" value='<?php echo $date; ?>'  required readonly>
          </div>
        </div>
        <input type="submit" class="btn btn-primary btn-user btn-block">
        </input>
        <hr>

      </form>

    </div>

  </div>
  <!-- /.container-fluid -->

  </div>
  <!-- End of Main Content -->





  <!-- Footer -->

  <!-- End of Footer -->

  </div>
  <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.html">Logout</a>
        </div>
      </div>
    </div>
  </div>



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
            <div class="form-group">
              <input type="text" class="form-control form-control-user" id="doctor" name="doctor" placeholder=""></div>
        </div>
        <div class="form-group row">
          <div class="col-sm-2 mb-3 mb-sm-0">
            <!--<input type="text" class="form-control form-control-user" id="FirstName" name="FirstName" placeholder="First Name"> -->
            <div class="col-sm-3 mb-0 font-weight-bold text-gray-800"><b>Patient Id</b></div>
          </div>
          <div class="col-sm-6">
            <input type="text" class="form-control form-control-user" value=<?php echo $id; ?> id="Patient_id" name="Patient_id" placeholder="Patient_id">
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