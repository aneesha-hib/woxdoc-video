<?php
 

 require ('config.php');
 $medicine_id=$_GET['id'];
 
    $sql1="DELETE from medicine where  medicine_id='$medicine_id'";
 
    $result1=mysqli_query($link,$sql1);
    if($result1==1)
    {
        header("location: existing_medicine.php");
    }


?>