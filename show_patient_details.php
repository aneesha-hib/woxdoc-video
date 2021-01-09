<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>


<?php		
require_once 'config.php';
$query = "SELECT  * FROM patient_list where patientlist_id = '".$_POST['edit_id']."'"; 
//echo $query ;
$result = mysqli_query($link,$query);


	
	while($row = $result->fetch_assoc()) 
	{
	

		$FirstName 	= $row["FirstName"];
		$LastName  	= $row["LastName"];
		$Email     	= $row["Email"];
		$Phone     	= $row["Phone"];
		$Address   	= $row["Address"];
		$sex       	= $row["sex"];
		$Age       	= $row["Age"];
		$patient_id = $row["patientlist_id"];
		
?>		

					<h3> Patient Details</h3>
					
					<div class="row py-3">
					  <div class="col-sm-3 mb-0 font-weight-bold text-gray-800"><b>Name</b></div>
					  <div class="col-sm-8"><?php echo $FirstName; ?>&nbsp<?php echo $LastName; ?></div>
					  
					</div>
					
					<div class="row  py-3">
					  <div class="col-sm-3 mb-0 font-weight-bold text-gray-800"><b>Email</b></div>
					  <div class="col-sm-8"><?php echo $Email; ?></div>
					  
					</div>
					
					<div class="row  py-3">
					  <div class="col-sm-3 mb-0 font-weight-bold text-gray-800"><b>Phone</b></div>
					  <div class="col-sm-8"><?php echo $Phone; ?></div>
					  
					</div>
					
					<div class="row  py-3">
					  <div class="col-sm-3 mb-0 font-weight-bold text-gray-800"><b>Email</b></div>
					  <div class="col-sm-8"><?php echo $Email; ?></div>
					  
					</div>
					
					<div class="row  py-3">
					  <div class="col-sm-3 mb-0 font-weight-bold text-gray-800"><b>Address</b></div>
					  <div class="col-sm-8"><?php echo $Address; ?></div>
					  
					</div>
					
					<div class="row  py-3">
					  <div class="col-sm-3 mb-0 font-weight-bold text-gray-800"><b>sex</b></div>
					  <div class="col-sm-8"><?php echo $sex; ?></div>
					  
					</div>
					
					<div class="row  py-3">
					  <div class="col-sm-3 mb-0 font-weight-bold text-gray-800"><b>Age</b></div>
					  <div class="col-sm-8"><?php echo $Age; ?></div>
					  
					</div>
					
					<div class="row  py-3 mr-2 float-right">
					
					<center>
					<!-- <a class="btn btn-primary btn-sm text-light " href="attachments.php?id=<?php echo $patient_id ?>"><i class="fa fa-pencil" aria-hidden="true">Attachments</i></a> -->
						<a class="btn btn-warning btn-sm text-light " href="prescription.php?id=<?php echo $patient_id ?>"><i class="fa fa-pencil" aria-hidden="true">Prescribe</i></a>

					</center>
					  
					</div>

                    
					  
<?php	}

?>
	
	
		