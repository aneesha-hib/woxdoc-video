<?php
 
 require ('config.php');
 $patient_id=$_GET['id'];
 $sql="DELETE from patient_list where patientlist_id='$patient_id'";
 
 $result=mysqli_query($link,$sql);
if($result==1)
{
    $sql1="DELETE from prescription where patientlist_id='$patient_id'";
 
    $result1=mysqli_query($link,$sql1);
    if($result1==1)
    {
        header("location: existing_patients.php");
    }
   
}

?>