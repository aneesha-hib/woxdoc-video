<?php
// require('./fpdf.php');

// $pdf=new FPDF();
// $pdf->AddPage();
// $pdf->SetFont('Arial','B',16);
// $pdf->Cell(40,10,'Hello World!');
// $pdf->Output();
include ('../config.php');
require('./fpdf.php');
$pres_id=$_GET['id'];
// $pres_id=$_GET['pres_id'];
$pdf=new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',10);
$pdf->Ln();

// $pdf->Cell(80);
$pdf->Cell(500);
$pdf->Image('logo.png',160,10,30);
$pdf->Ln();
$pdf->SetFont('Arial','B',14);

//$pdf->Cell(144);
$sql="SELECT users.username,users.address,users.email,users.phone ,users.department from prescription INNER JOIN users ON prescription.id=users.id where prescription_id=".$pres_id;
$result = mysqli_query($link,$sql);

while($rows=mysqli_fetch_array($result))
{
$pdf->SetTextColor(0,0,145);
$pdf->Cell(0,7,$rows[0]);
$pdf->Ln();
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(0,7,$rows[4]);
$pdf->Ln();
//$pdf->Cell(130);
$pdf->SetFont('Arial','',10);

$pdf->Cell(30,7,$rows[1]);
$pdf->Ln();
//$pdf->Cell(158);
$pdf->Cell(10,7,"Email:");
$pdf->Cell(30,7,$rows[2]);
$pdf->Ln();
$pdf->Cell(7,7,"Ph:");
$pdf->Cell(30,7,$rows[3]);
$pdf->Ln();
}

$pdf->Ln();
$pdf->SetFont('times','B',14);


$pdf->Ln();
$pdf->SetFont('times','B',13);
 $pdf->Cell(30,7,"PATIENT DETAILS");

 $pdf->Ln();
$pdf->Cell(450,7,"________________________________________________________________________________");
$pdf->Ln();
$pdf->Ln();
    
        $sql = "SELECT `patient_list`.`patientlist_id`, `patient_list`.`created_on`, `patient_list`.`FirstName`, `patient_list`.`LastName`, `patient_list`.`Email`, 
        `patient_list`.`Phone`, `patient_list`.`Address`, `patient_list`.`sex`, `patient_list`.`Age` FROM `patient_list` INNER JOIN `prescription` ON 
        `prescription`.`patientlist_id`=`patient_list`.`patientlist_id`  WHERE `prescription`.`prescription_id`=".$pres_id;
        $result = mysqli_query($link,$sql);

        while($rows=mysqli_fetch_array($result))
        {
            $patientid = $rows[0];
            $name = $rows[2]." ".$rows[3];
            $age=$rows[8];
            $sex=$rows[7];
            $address = $rows[6];
            $phone = $rows[5];
            $email = $rows[4];
          $date= date('d/m/yy');
          $pdf->SetFont('times','',12);
            $pdf->Cell(30,7,"Patient Name");
            $pdf->Cell(30,7,": ".$name);
            $pdf->Cell(90);
            $pdf->Cell(20,7,"Patient ID");
            $pdf->Cell(30,7,": ".$patientid);
            $pdf->Ln();

            $pdf->Cell(30,7,"Age");
            $pdf->Cell(30,7,": ".$age);
            $pdf->Cell(90);
            $pdf->Cell(20,7,"Date");
            $pdf->Cell(30,7,": ".$date);
            $pdf->Ln();

            $pdf->Cell(30,7,"Sex");
            $pdf->Cell(30,7,": ".$sex);
            $pdf->Ln();

            $pdf->Cell(30,7,"Address");
            $pdf->Cell(40,7,": ".$address);
            $pdf->Ln();

            $pdf->Cell(30,7,"Email");
            $pdf->Cell(30,7,": ".$email); 
            $pdf->Ln();

            $pdf->Cell(30,7,"Phone Number");
            $pdf->Cell(30,7,": ".$phone);
            $pdf->Ln();
   

            $pdf->Ln(); 
        }
        $pdf->SetFont('times','B',13);
        $pdf->Cell(30,7,"SYMPTOMS");
        // $pdf->Ln();
        //  $pdf->Cell(450,7,"________________________________________________________________________________");
        // $pdf->Ln();
        $pdf->Ln();
        $sql = "SELECT `symptoms` FROM `prescription` WHERE  `prescription_id`=".$pres_id;
        $result = mysqli_query($link,$sql);

        while($rows=mysqli_fetch_array($result))
        {
            $Symptoms = $rows[0];
            $pdf->SetFont('times','',12);
           $pdf->Cell(30,7,$Symptoms);
           $pdf->Ln(); 
          
            $pdf->Ln(); 
        }


      

        $pdf->SetFont('times','B',13);
        $pdf->Cell(30,7,"IMPRESSION");
        // $pdf->Ln();
        //  $pdf->Cell(450,7,"________________________________________________________________________________");
        // $pdf->Ln();
        $pdf->Ln();
        $sql = "SELECT `Impression` FROM `prescription` WHERE  `prescription_id`=".$pres_id;
        $result = mysqli_query($link,$sql);

        while($rows=mysqli_fetch_array($result))
        {
            $impression = $rows[0];
            $pdf->SetFont('times','',12);
           $pdf->Cell(30,7,$impression);
           $pdf->Ln(); 
         

            $pdf->Ln(); 
        }
        $pdf->SetFont('times','B',13);
        $pdf->Cell(30,7,"PRESCRIPTIONS");
        // $pdf->Ln();
        //  $pdf->Cell(450,7,"________________________________________________________________________________");
        // $pdf->Ln();
        $pdf->Ln();
        $sql = "SELECT `prescription` FROM `prescription` WHERE  `prescription_id`=".$pres_id;
        $result = mysqli_query($link,$sql);

        while($rows=mysqli_fetch_array($result))
        {
            $prescription = $rows[0];
            $pdf->SetFont('times','',12);
           $pdf->Cell(30,7,$prescription);
           $pdf->Ln(); 
         

            $pdf->Ln(); 
        }

      
    $pdf->Ln();  $pdf->Ln(); 
        $pdf->Ln(); 
        $pdf->Cell(140);
        $pdf->Cell(30,7,'Signature of Doctor');
$pdf->Output();
?>