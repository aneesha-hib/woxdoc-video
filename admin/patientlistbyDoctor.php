	
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Patient List</h6>
            </div>
			
			
			<?php		
require_once '../config.php';
$query = "SELECT  * FROM patient_list where id='$_id'"; 
$result = mysqli_query($link,$query);
       
				if ($result->num_rows > 0) {
				echo('
			
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
					  <th>Patient Id</th>						
                      <th>First Name </th>
                      <th>Last Name</th>
                      <th>Email</th>
                      <th>Phone</th>
                      <th>Address</th>
                      <th>Sex</th>
					  <th>Age</th>
					 
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Patient Id</th>						
                      <th>First Name </th>
                      <th>Last Name</th>
                      <th>Email</th>
                      <th>Phone</th>
                      <th>Address</th>
                      <th>Sex</th>
					  <th>Age</th>
					 
                    </tr>
                  </tfoot>
                  <tbody>');
				  
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

					

                    <tr>
                      <td><?php echo $patient_id; ?></td>
                      <td><?php echo $FirstName; ?></td>
                      <td><?php echo $LastName; ?></td>
                      <td><?php echo $Email; ?></td>
                      <td><?php echo $Phone; ?></td>
                      <td><?php echo $Address; ?></td>
					  <td><?php echo $sex; ?></td>
                      <td><?php echo $Age; ?></td>
					  <!-- <td>
            <button class="btn btn-primary btn-sm text-light  view_patient" id=<?php echo $patient_id ?>><i class="fa fa-pencil" aria-hidden="true">View</i></button>
            <a href="edit_patient.php?id=<?php echo $patient_id ?>" class="btn btn-warning btn-sm text-light " ><i class="fa fa-pencil" aria-hidden="true">Edit</i></a>
            <button class="btn btn-danger btn-sm text-light  " id=<?php echo $patient_id ?>><i class="fa fa-pencil" aria-hidden="true" data-toggle="modal" data-target="#exampleModal">Delete</i></button>
					</td> -->
                    </tr>
					
	<?php		
	}
	echo("				
					</tbody>
                </table>
              </div>
            </div>");
	}
	else
	{
	    echo("No records");
	}	
?>	
			
			
			
          </div>		
					
              
	