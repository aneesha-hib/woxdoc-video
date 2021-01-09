<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
	header("location: login.php");
	exit;
}
?>


<?php
require_once '../config.php';
$query = "SELECT  * FROM users where id = '" . $_POST['id'] . "'";
//echo $query ;
$result = mysqli_query($link, $query);




while ($row = $result->fetch_assoc()) {


	$id = $row['id'];
	$username 	= $row["username"];
	$email  	= $row["email"];
	$address     	= $row["address"];
	$phone     	= $row["phone"];
	$department   	= $row["department"];


?>
	<html>

	<head>
		<link href="https://fonts.googleapis.com/css?family=Popins:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
	</head>

	<body onload=display_c();>
		<h3> Doctor Details</h3>

		<div class="row py-3">
			<div class="col-sm-3 mb-0 font-weight-bold text-gray-800"><b>Username</b></div>
			<div class="col-sm-8"><?php echo $username; ?></div>

		</div>

		<div class="row  py-3">
			<div class="col-sm-3 mb-0 font-weight-bold text-gray-800"><b>Email</b></div>
			<div class="col-sm-8"><?php echo $email; ?></div>

		</div>

		<div class="row  py-3">
			<div class="col-sm-3 mb-0 font-weight-bold text-gray-800"><b>Address</b></div>
			<div class="col-sm-8"><?php echo $address; ?></div>

		</div>

		<div class="row  py-3">
			<div class="col-sm-3 mb-0 font-weight-bold text-gray-800"><b>Phone</b></div>
			<div class="col-sm-8"><?php echo $phone; ?></div>

		</div>

		<div class="row  py-3">
			<div class="col-sm-3 mb-0 font-weight-bold text-gray-800"><b>Department</b></div>
			<div class="col-sm-8"><?php echo $department; ?></div>

		</div>

		<!-- <div class="row  py-3">
					  <div class="col-sm-3 mb-0 font-weight-bold text-gray-800"><b>sex</b></div>
					  <div class="col-sm-8"><?php echo $sex; ?></div>
					  
					</div>
					
					<div class="row  py-3">
					  <div class="col-sm-3 mb-0 font-weight-bold text-gray-800"><b>Age</b></div>
					  <div class="col-sm-8"><?php echo $Age; ?></div>
					  
					</div> -->

		<div class="row  py-3 mr-2 float-right">

			<center>
				<a class="btn btn-primary btn-sm text-light " href="doctorDashboard.php?id=<?php echo $id ?>"><i class="fa fa-pencil" aria-hidden="true">More</i></a>
				<!-- <a class="btn btn-warning btn-sm text-light " href="prescription.php?id=<?php echo $patient_id ?>"><i class="fa fa-pencil" aria-hidden="true">Prescribe</i></a> -->

			</center>

		</div>
	</body>

	</html>

<?php	}

?>