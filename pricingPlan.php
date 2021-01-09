<?php
if(isset($_POST['btn1']))
{
    settingPlan('free','10','0');
}
else if(isset($_POST['btn2']))
{
    settingPlan('bronce','50','1000');
}
else if(isset($_POST['btn3']))
{
    settingPlan('silver','100','2000');
}
else if(isset($_POST['btn4']))
{
    settingPlan('gold','200','3000');
}
else{}

 
function settingPlan($plan,$noOfPatients,$amount){
 echo $plan;
    
        require 'config.php';
        
        $doctorId=$_GET['id'];
        $sql="INSERT INTO `subscription`( `doctorId`, `subscriptionType`, `amount`, `noOfPatients`) VALUES ('$doctorId','$plan','$amount','$noOfPatients')";
       //$res=mysqli_query($link,$sql);
      
       if($link->query($sql))
       {
           echo "success";
           header("Location:admin/doctorsList.php");
       }
       else{
           echo "Failed";
       }
    

}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pricing </title>
      
<!-- Bootstrap CSS -->
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'>
       
    <link rel="stylesheet" type="text/css" href="css/style.css">
	<!-- Demo CSS -->
	<link rel="stylesheet" href="css/demo.css">
  
  </head>
  <body>
 <!-- <header class="intro"> -->
 <!-- <h1>Bootstrap Pricing Tables Example </h1>
 <p> Bootstrap 4 pricing table snippet for comparing subscription plans or different product tiers.</p>
 <p> Written in HTML, CSS, JavaScript (jQuery)... </p>
 <div class="action">
 <a href="https://www.codehim.com/others/responsive-pricing-table-using-bootstrap/" title="Back to download and tutorial page" class="btn back">Back to Tutorial</a>
 <a href="https://github.com/bootstrapstudio/pricing-table-bootstrap-snippet" title="View, Fork or Star on GitHub" class="btn github">View on GitHub</a>
 </div> -->
 
 <!-- </header> -->
  <br>
 <main>
  <article>
  <!-- <p>The following is the example of Bootstrap pricing tables. </p> -->

       <section class="pricing-table">
        <div class="container">
            <div class="block-heading">
              <h2>Pricing Plan</h2>
              <!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quam urna, dignissim nec auctor in, mattis vitae leo.</p> -->
            </div>
            <div class="row justify-content-md-center">
                <div class="col-md-3 ">
                    <div class="item">
                        <div class="heading">
                            <h3>FREE</h3>
                        </div>
                        <p></p>
                        <div class="features">
                            <!-- <h4><span class="feature">Full Support</span> : <span class="value">No</span></h4> -->
                            
                            <h4><span class="feature">Duration</span> : <span class="value">30 Days</span></h4>
                            <h4><span class="feature">Accounts</span> : <span class="value">10</span></h4>
                        </div>
                        <div class="price">
                            <h4>$0</h4>
                        </div>
                        <form method="POST">
                        <button class="btn btn-block btn-outline-primary" type="submit"  name="btn1">SELECT</button></form>
                    </div>
                </div>
                <div class="col-md-3 ">
                    <div class="item">
                        <div class="heading">
                            <h3>BRONCE</h3>
                        </div>
                        <p></p>
                        <div class="features">
                            <!-- <h4><span class="feature">Full Support</span> : <span class="value">No</span></h4> -->
                            <h4><span class="feature">Duration</span> : <span class="value">30 Days</span></h4>
                            <h4><span class="feature">Accounts</span> : <span class="value">50</span></h4>
                        </div>
                        <div class="price">
                            <h4>$25</h4>
                        </div>
                        <form method="POST">
                        <button class="btn btn-block btn-outline-primary" type="submit" name="btn2">SELECT</button></form>
                    </div>
                </div>
                <div class="col-md-3 ">
                    <div class="item">
                        <!-- <div class="ribbon">Best Value</div> -->
                        <div class="heading">
                            <h3>SILVER</h3>
                        </div>
                        <p></p>
                        <div class="features">
                            <!-- <h4><span class="feature">Full Support</span> : <span class="value">Yes</span></h4> -->
                            <h4><span class="feature">Duration</span> : <span class="value">30 Days</span></h4>
                            <h4><span class="feature">Accounts</span> : <span class="value">100</span></h4>
                        </div>
                        <div class="price">
                            <h4>$50</h4>
                        </div>
                        <form method="POST">
                        <button class="btn btn-block btn-outline-primary" type="submit"  name="btn3">SELECT</button></form>
                    </div>
                </div>
                <div class="col-md-3 ">
                    <div class="item">
                        <div class="heading">
                            <h3>GOLD</h3>
                        </div>
                        <p></p>
                        <div class="features">
                            <!-- <h4><span class="feature">Full Support</span> : <span class="value">Yes</span></h4> -->
                            <h4><span class="feature">Duration</span> : <span class="value">30 Days</span></h4>
                            <h4><span class="feature">Accounts</span> : <span class="value">200</span></h4>
                        </div>
                        <div class="price">
                            <h4>$150</h4>
                        </div>
                        <form method="POST">
                        <button class="btn btn-block btn-outline-primary" type="submit"  name="btn4">SELECT</button></form>
                    </div>
                </div>
            </div>
        </div>
        <br>
    </section>
  
  </article>
 </main>
 
  <!-- <footer class="credit">Author: Bootstrap Studio - Distributed By: <a title="Awesome web design code & scripts" href="https://www.codehim.com?source=demo-page" target="_blank">CodeHim</a></footer> -->
  
  </body>
 
</html>