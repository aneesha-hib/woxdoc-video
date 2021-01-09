<?php
// Initialize the session
session_start();
require 'config.php';
// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
  header("location: login.php");
  exit;
}
$status = '0';
$id = $_SESSION["id"];
$res = $link->query("SELECT noOfPatients from subscription where doctorId='$id'");
while ($row = $res->fetch_assoc()) {
  $noOfPrescription = $row['noOfPatients'];
}
$query = "select count(*) as count from prescription where id='$id'";
$res1 = $link->query($query);

if ($res1) {
  while ($row = $res1->fetch_assoc()) {
     $count = $row['count'];
  }
  if ($count == $noOfPrescription) {
    $status = '1';
  }
}
?>

<?php
$id = $_GET['id'];
?>

<?php
if (isset($_POST['Symptoms'])) {


  require 'config.php';

  $Patient_id = $_POST['Patient_id'];
  $Symptoms = $_POST['Symptoms'];
  $prescription = $_POST['Prescription'];
  $impression = $_POST['Impression'];

$ssql="select * from medicine where medicine_name='$prescription'";
 $r=mysqli_query($link,$ssql);
if(mysqli_num_rows($r)==0)
{
  echo $ssql1="INSERT INTO medicine(medicine_name,id)values('$prescription','$doctor_id')";
  mysqli_query($link,$ssql1);     
}


  ("$id-$Symptoms-$prescription");

  //$query = implode(",",$insertQrySplit);

  $sql = "INSERT INTO `prescription`(`patientlist_id` , `symptoms`, `prescription`,`Impression`,`id`) VALUES ('$Patient_id','$Symptoms','$prescription','$impression','$doctor_id')";

  if ($link->query($sql) === TRUE) {
    echo $iid = mysqli_insert_id($link);
    $cnt = 0;
    foreach ($_FILES['input-b9']['tmp_name'] as $key => $val) {
      $path = "./img/" . $iid . "." . $cnt . "." . pathinfo($_FILES['input-b9']['name'][$cnt++], PATHINFO_EXTENSION);

      echo $path . "</ br>";
      if (!move_uploaded_file($_FILES['input-b9']['tmp_name'][$key], $path)) {
        //die('error uploading file. Check destination is writeable.');
      }
    }
    $web = "location: prescription.php?id=$id";

    header($web);
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

  <title>Prescription</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top" onload=display_c();>

  <!-- Page Wrapper -->
  <!-- End of Topbar -->
  <?php include 'header.php'; ?>
  <!-- Begin Page Content -->
  <div class="container-fluid">

    <div class="col-xl-12 col-md-12 mb-12s">

      <div class="row py-3">
        <?php 
        if($status=='0')
        {
          echo ' <a href="#" class="btn btn-primary btn-icon-split" href="#" data-toggle="modal" data-target="#add_prescription">
          <span class="icon text-white-50">
            <i class="fas fa-flag"></i>
          </span>
          <span class="text">Add Prescription</span>
        </a>';
        }
        ?>
       



        <div class="my-2"></div>
      </div>
    </div>


    <?php
    require_once 'config.php';
    $query = "SELECT  * FROM prescription where patientlist_id = '" . $id . "' ORDER BY prescriped_date DESC";
    //echo $query;
    $result = mysqli_query($link, $query);

    if ($result->num_rows > 0) {


      while ($row = $result->fetch_assoc()) {


        $pres_id  = $row["prescription_id"];
        $pres_date   = $row["prescriped_date"];
        $patient_id = $row["patientlist_id"];
        $symptoms    = $row["symptoms"];
        $pres    = $row["prescription"];
        $impres     = $row["Impression"];



    ?>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-12 col-md-12 mb-12 py-3">
          <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center mb-2">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Prescribed Date </div>
                  <div class="mb-0 font-weight-bold text-gray-800"><?php echo $pres_date; ?></div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                </div>
              </div>

              <div class="row no-gutters align-items-center mb-2">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Symptoms </div>
                  <div class=" mb-0 font-weight-bold text-gray-800"><?php echo $symptoms; ?></div>
                </div>
              </div>

              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Impression </div>
                  <div class=" mb-0 font-weight-bold text-gray-800"><?php echo $impres; ?></div>
                </div>
              </div>

              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Prescription </div>
                  <div class=" mb-0 font-weight-bold text-gray-800"><?php echo $pres; ?></div>
                </div>
              </div>
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Attachments </div>
                  <div class=" mb-0 font-weight-bold text-gray-800">
                    <?php
                    $fpath = "./img/" . $row['prescription_id'] . ".*";
                    echo "<td style='color:black'>";
                    foreach (glob($fpath) as $fname) {
                      //if(filetype($fname) == )
                      echo "<img src='" . $fname . "' width='200' height='150' style='border-color:white; border-style: solid dashed; border-width:5px;'></a>";
                    }
                    ?>
                  </div>
                </div>
              </div>
              <br>
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <a class="btn btn-primary" href="fpdf/toPDF.php?id=<?php echo $pres_id; ?>">Print</a>
                  <a class="btn btn-warning" href="edit_prescription.php?id=<?php echo $pres_id; ?>&&patient_id=<?php echo $id; ?>">Edt</a>
                  <!-- <a class="btn btn-danger" href="delete_prescription.php?id=<?php echo $pres_id; ?>">Delete</a> -->
                </div>

              </div>

            </div>
          </div>
        </div>
    <?php
      }
    } else {
      echo ("No records");
    }
    ?>

    <!-- Page Heading -->


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
            <h1 class="h4 text-gray-900 mb-4">Add Prescription!</h1>
          </div>
          <form class="user" method="POST" enctype="multipart/form-data">
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

              <input type="text" class="form-control form-control-user" id="Symptoms" name="Symptoms" placeholder="Symptoms" required>


            </div>

            <div class="form-group">
              <input type="text" class="form-control form-control-user" id="Impression" name="Impression" placeholder="Impression" required>
            </div>

            <div class="form-group">
              <input type="text" class="form-control form-control-user" id="Prescription" name="Prescription" placeholder="Prescription" required list="somethingelse">
              <datalist  id="somethingelse">
                <?php

                $sql = "select * from medicine ";
                $res = mysqli_query($link, $sql);
                while ($row = $res->fetch_assoc()) {
                  echo "<option value='" . $row['medicine_name'] . "'>".$row['medicine_name']."</option>";
                }

                ?>


              </datalist>
              <!-- <textarea class="form-control form-control-user" id="Prescription"  name="Prescription" placeholder="Prescription" required></textarea> -->
            </div>

            Any attachments

            <input id="input-b9" name="input-b9[]" multiple type="file">

        </div>

        <input type="submit" class="btn btn-primary btn-user btn-block">
        </input>
        <hr>

        </form>

      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        <a class="btn btn-primary" href="login.php">Logout</a>
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
  <script>
    // Add the following code if you want the name of the file appear on select
    $(document).ready(function() {
      $("#input-b9").fileinput({
        showPreview: false,
        showUpload: false,
        elErrorContainer: '#kartik-file-errors',
        allowedFileExtensions: ["jpg", "png", "gif"]
        //uploadUrl: '/site/file-upload-single'
      });
    });


    jQuery(document).on("click", ".edit_prescription", function() {

      var edit_id = this.id;
      //alert (edit_id);
      // alert ('sfgsd');
      jQuery('#commonModalLabel').html("Patient id -<b>" + edit_id + "</b> ");

      jQuery("#commonModal").modal("show");


      //jQuery('#commonModal_res').html('rasdfsad');


      jQuery.post("edit_prescription.php", {
        "id": edit_id
      }, function(data) {
        jQuery('#commonModal_res').html(data);
      });

    });
  </script>
</body>

</html>