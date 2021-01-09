<?php
 
 require ('config.php');
 $prescription_id=$_GET['id'];
 $sql="SELECT patientlist_id FROM prescription where prescription_id='$prescription_id'";
 
 $result=mysqli_query($link,$sql);
 while($row=$result->fetch_assoc())
 {
     $patient_id=$row['patientlist_id'];
 }
if($result==1)
{
   
    $sql1="DELETE from prescription where  prescription_id='$prescription_id'";
 
    $result1=mysqli_query($link,$sql1);
    if($result1==1)
    {
        header("location: prescription.php?id=$patient_id");
    }
   
}

?>