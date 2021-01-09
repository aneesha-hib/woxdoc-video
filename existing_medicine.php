<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
$id = $_SESSION["id"];

?>

<?php
if (isset($_POST['medicine_name'])) {


    require 'config.php';

    $medicine_name = $_POST['medicine_name'];
    $medicine_usage = $_POST['medicine_usage'];
    // $email = $_POST['Email'];
    // $phone = $_POST['phone'];
    // $address = $_POST['Address'];
    // $sex = $_POST['sex'];
    // $age = $_POST['Age'];


    //echo("$name-$add-$Email-$Mobile");



    $sql = "INSERT INTO `medicine`(`medicine_name`, `medicine_usage`, `id`) VALUES ('$medicine_name','$medicine_usage','$id')";

    if ($link->query($sql) === TRUE) {

        /*
	echo '<script language="javascript">';
echo 'alert("Added successfully ")';
echo '</script>';

    ?>
	<script type="text/javascript">
    $(document).ready(function(){
        $("#myModal").modal('show');
    });
	

	
	<!--
    <div class="alert alert-success">
  <strong><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span></strong><a href="#" class="alert-link">Booked Successfully</a>.
    </div>-->
    <?php
//echo("<h1 style='color:red'></h1>");
*/
        header("location: existing_medicine.php");
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
    <style>
  .form-control,
.form-control:focus,
.form-control:focus:active {
  background-color: #ebeef7!important;
  border-color: #96d3ec;
  color: white;
}

</style>
    <title>Existing Medicine</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Popins:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">



</head>

<body id="page-top" onload=display_c();>

    <?php include 'header.php'; ?>
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"></h1>
            <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" href="#" data-toggle="modal" data-target="#add_patient"><i class="fas fa-download fa-sm text-white-50"></i> Add Medicine</a>
        </div>



        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Medicine List</h6>
            </div>


            <?php
            require_once 'config.php';
            $query = "SELECT  * FROM medicine  order by medicine_name ASC";
            $result = mysqli_query($link, $query);

            if ($result->num_rows > 0) {
                echo ('
			
            <div class="card-body">
              <div class="table-responsive" >
              <form  method="POST" >
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
					  <th>Medicine Id</th>					
                      <th>Medicine Name </th>
                      <th>Usage</th>
					  <th>Manage</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                    <th>Medicine Id</th>						
                    <th> <input type="text" class="form-control" id="medicine_name" name="medicine_name" placeholder="Medicine Name" required></th>
                    <th><input type="text" class="form-control" id="medicine_usage" name="medicine_usage" placeholder="Medicine Usage" required></th>
                    <th><input type="submit" class="btn btn-primary  btn-block" value="Add"></th>
                    </tr>
                  </tfoot>
                  <tbody>');

                while ($row = $result->fetch_assoc()) {


                    $medicine_id = $row["medicine_id"];
                    $medicine_name = $row["medicine_name"];
                    $medicine_usage = $row["medicine_usage"];


            ?>

                    <tr>
                        <td><?php echo $medicine_id; ?></td>
                        <td><?php echo $medicine_name; ?></td>
                        <td><?php echo $medicine_usage; ?></td>

                        <td>
                            <!-- <button class="btn btn-primary btn-sm text-light  view_patient" id=<?php echo $medicine_id ?>><i class="fa fa-pencil" aria-hidden="true">View</i></button> -->
                            <a class="btn btn-warning btn-sm text-light mb-3 mb-sm-1" href="edit_medicine.php?medicine_id=<?php echo $medicine_id ?>">Edit</a>
                            <a class="btn btn-danger btn-sm text-light"  href="delete_medicine.php?id=<?php echo $medicine_id?>">Delete</a>
                        </td>
                    </tr>

            <?php
                }
                echo ("				
					</tbody>
                </table>
                </form>
              </div>
            </div>");
            } else {
                echo ("No records");
            }
            ?>








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



    <!-- modal starts here -->
    <div class="modal fade" id="commonModal" style="background-color:#6b69696e">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="commonModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div id='commonModal_res'></div><br>
                    <div id='commonModal_res_summary' style='font-size:12px !important'></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>


    <!-- modal ends here -->

    <!-- patient details modal -->


    <div class="modal fade" id="Patient_details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Patient Details </h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php
                    /*		
require_once 'config.php';
$patient_query = "SELECT  * FROM patient_list where "; 
$res = mysqli_query($link,$patient_query);
       
				if ($res->num_rows > 0) {
				echo(' ')
*/
                    ?>


                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!--     Common modal  -->

    <div class="modal fade" id="add_patient" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Medicine</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <!-- <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1> -->
                    </div>
                    <form class="user" method="POST">
                        <div class="form-group ">
                            <!-- <div class="col-sm-6 mb-3 mb-sm-0"> -->
                            <input type="text" class="form-control form-control-user" id="medicine_name" name="medicine_name" placeholder="Medicine Name" required>
                            <!-- </div> -->
                        </div>
                        <div class="form-group ">
                            <!-- <div class="col-sm-6"> -->
                            <input type="text" class="form-control form-control-user" id="medicine_usage" name="medicine_usage" placeholder="Usage" required>
                            <!-- </div> -->
                        </div>


                        <!-- <div class="form-group row">
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
                        </div> -->

                        <!-- <div class="form-group">
                            <input type="email" class="form-control form-control-user" id="Email" name="Email" placeholder="Email Address">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" id="Address" name="Address" placeholder="Address">
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="number" class="form-control form-control-user" id="phone" name="phone" placeholder="phone" required>
                            </div>

                        </div> -->
                        <input type="submit" class="btn btn-primary btn-user btn-block">
                        </input>
                        <hr>

                    </form>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>

                </div>
            </div>
        </div>
    </div>
    <!-- Common  Modal-->

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5>Are you sure to want to delete this medicine ?<?php echo $medicine_id ?></h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>

                    <a class="btn btn-danger" href="delete_medicine.php?id=<?php echo $medicine_id ?>" role="button">Delete</a>
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

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>



    <script>
        jQuery(document).on("click", ".view_patient", function() {

            var edit_id = this.id;
            //alert (edit_id);
            // alert ('sfgsd');
            jQuery('#commonModalLabel').html("Patient id -<b>" + edit_id + "</b> ");

            jQuery("#commonModal").modal("show");


            //jQuery('#commonModal_res').html('rasdfsad');


            jQuery.post("show_patient_details.php", {
                "edit_id": edit_id
            }, function(data) {
                jQuery('#commonModal_res').html(data);
            });

        });


        jQuery(document).on("click", ".edit_patient", function() {

            var edit_id = this.id;
            //alert (edit_id);
            // alert ('sfgsd');
            jQuery('#commonModalLabel').html("Patient id -<b>" + edit_id + "</b> ");

            jQuery("#commonModal").modal("show");


            //jQuery('#commonModal_res').html('rasdfsad');


            jQuery.post("edit_patient.php", {
                "id": edit_id
            }, function(data) {
                jQuery('#commonModal_res').html(data);
            });

        });
    </script>

</body>

</html>