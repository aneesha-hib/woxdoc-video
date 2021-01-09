<?php
require 'config.php';
$appointment_id=$_GET['id'];
$sql="Select * from appointment where appointment_id='$appointment_id'";
$res=mysqli_query($link,$sql);
while($row=$res->fetch_assoc())
{
    $FirstName 	= $row["FirstName"];
    $LastName  	= $row["LastName"];
    $Email     	= $row["Email"];
    $Phone     	= $row["Phone"];
    $Address   	= $row["Address"];
    $sex       	= $row["sex"];
    $Age       	= $row["Age"];
    $doctor_id=$row['id'];
    
    $sql1="INSERT INTO `patient_list`(`FirstName`, `LastName`, `Email`, `Phone`, `Address`, `sex`, `Age`,`id`)
             VALUES ('$FirstName','$LastName','$Email','$Phone','$Address','$sex','$Age','$doctor_id')";
    $result=mysqli_query($link,$sql1);
    if($result==1)
    {
        $sql2="DELETE from appointment where appointment_id='$appointment_id'";
        mysqli_query($link,$sql2);
        header("location:viewAppointments.php");
    }
}
?>