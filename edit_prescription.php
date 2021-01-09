<?php
// Initialize the session
session_start();
$pres_id = $_GET['id'];
$patient_id = $_GET['patient_id'];
// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
$id = $_SESSION["id"];
if (isset($_GET['filename'])) {
    unlink($_GET['filename']);

    header("Location:edit_prescription.php?id=$pres_id&&patient_id=$patient_id");
}



?>



<?php
if (isset($_POST['Symptoms'])) {


    require 'config.php';

    //$Patient_id = $_POST['Patient_id'];
    $Symptoms = $_POST['Symptoms'];
    $prescription = $_POST['Prescription'];
    $impression = $_POST['Impression'];



    ("$id-$Symptoms-$prescription");

    //$query = implode(",",$insertQrySplit);

    // $sql = "INSERT INTO `prescription`(`patientlist_id` , `symptoms`, `prescription`,`Impression`,`id`) VALUES ('$Patient_id','$Symptoms','$prescription','$impression','$doctor_id')";
    $sql = "UPDATE  prescription set symptoms='" . $Symptoms . "',prescription='" . $prescription . "',Impression='" . $impression . "' where prescription_id='" . $pres_id . "'";
    if ($link->query($sql) === TRUE) {
        //echo $iid = mysqli_insert_id($link);
        $cnt = 0;
        $cnt1=0;
        $fpath = "./img/" . $pres_id. ".*";
        foreach (glob($fpath) as $fname) {
            $cnt++;

          }
        
        foreach ($_FILES['input-b9']['tmp_name'] as $key => $val) {
           
           $path = "img/" . $pres_id . "." . $cnt . "." . pathinfo($_FILES['input-b9']['name'][$cnt1++], PATHINFO_EXTENSION);
          $cnt++;
                if (!move_uploaded_file($_FILES['input-b9']['tmp_name'][$key], $path)) {
                   // die('error uploading file. Check destination is writeable.');
                }
                
          
        }
        $web = "location: prescription.php?id=$patient_id";

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

    <title>Edit Prescription</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <style>
        .img-wraps {
            position: relative;
            display: inline-block;

            font-size: 0;
        }

        .img-wraps .closes {
            position: absolute;
            top: 5px;
            right: 8px;
            z-index: 100;
            background-color: #FFF;
            padding: 4px 3px;

            color: #000;
            font-weight: bold;
            cursor: pointer;

            text-align: center;
            font-size: 22px;
            line-height: 10px;
            border-radius: 50%;
            border: 1px solid red;
        }

        .img-wraps:hover .closes {
            opacity: 1;
        }
    </style>
</head>

<body id="page-top" onload=display_c();>

    <!-- Page Wrapper -->
    <!-- End of Topbar -->
    <?php include 'header.php'; ?>
    <!-- Begin Page Content -->


    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="modal-body">
            <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Edit Prescription</h1>
            </div>
            <?php

            require_once 'config.php';
            $query = "SELECT  * FROM prescription where prescription_id = '" . $_GET['id'] . "'";
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

                    <form class="user" method="POST" enctype="multipart/form-data">
                        <div class="form-group row">
                            <!-- <div class="col-sm-2 mb-3 mb-sm-0">
                <!--<input type="text" class="form-control form-control-user" id="FirstName" name="FirstName" placeholder="First Name"> -->
                            <!-- <div class="col-sm-3 mb-0 font-weight-bold text-gray-800"><b>Patient Id</b></div>
              </div>
              <div class="col-sm-6">
                <input type="text" class="form-control form-control-user" value=<?php echo $id; ?> id="Patient_id" name="Patient_id" placeholder="Patient_id">
              </div> -->
                        </div>

                        <div class="form-group">

                            <input type="text" class="form-control form-control-user" id="Symptoms" name="Symptoms" placeholder="Symptoms" value="<?php echo $symptoms; ?>" required>


                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" id="Impression" name="Impression" placeholder="Impression" value="<?php echo $impres; ?>" required>
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" id="Prescription" name="Prescription" placeholder="Prescription" value="<?php echo $pres; ?>" required>
                            <!-- <textarea class="form-control form-control-user" id="Prescription"  name="Prescription" placeholder="Prescription" required></textarea> -->
                        </div>

                        Attachments

                        <input id="input-b9" name="input-b9[]" multiple type="file"><br>
                        <?php
                        $fpath = "./img/" . $row['prescription_id'] . ".*";
                        echo "<td style='color:black'>";
                        foreach (glob($fpath) as $fname) {
                            //if(filetype($fname) == )
                            // echo "<img src='" . $fname . "' width='200' height='150' style='border-color:white; border-style: solid dashed; border-width:5px;'></a>";

                            echo '<div  class="img-wraps">
                           <a  class="closes" title="Delete" href="?filename=' . $fname . '&&id=' . $_GET['id'] . '&&patient_id=' . $patient_id . '">&times;</a>
                              <img src="' . $fname . '" width="200" height="150" style="border-color:white; border-style: solid dashed; border-width:5px;" ></div>';
                        }

                        ?>
                        <!-- </div> -->

                        <input type="submit" class="btn btn-primary btn-user btn-block">
                        </input>
                        <hr>

                    </form>
            <?php }
            } ?>
        </div>

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




    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>