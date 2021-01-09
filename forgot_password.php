<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Forgot Password</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Popins:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <image class="col-lg-6 d-none d-lg-block" src="doctor.jpg.jpg">
                <div class="col-lg-6">
                  <div class="p-5">
                    <div class="text-center">
                      <h1 class="h4 text-gray-900 mb-2">Forgot Your Password?</h1>
                      <p class="mb-4">We get it, stuff happens. Just enter your email address below and we'll send you a otp, you can log in with the otp!</p>
                    </div>

                    <?php
                    session_start();
                    require 'config.php';
                    if (isset($_POST['generate_otp'])) {
                      $user_id = $_POST['user_id'];
                      //echo $_POST['user_id'];
                      $query = "SELECT * FROM `users` WHERE email='" . $user_id . "'";
                      //echo $query;
                      $result = mysqli_query($link, $query);
                      // $fetch_user_id='';
                      // $row = mysqli_fetch_assoc($result);
                      while ($row = mysqli_fetch_assoc($result)) {
                        $fetch_user_id = $row['email'];
                        $password = $row['password'];
                      }

                      //$email_id=$row['email_id'];

                      //echo $user_id;
                      //	echo $fetch_user_id  ;
                      //echo $password;

                      if ($user_id == '') {
                        echo "Enter user id to proceed...";
                      } else if ($user_id == $fetch_user_id) {
                        require 'sendmail.php';
                        $subject = 'OTP for forgot password';
                        $otp = mt_rand(100000, 999999);
                        $message = "Hello " . $user_id . "Your otp is: " . $otp;
                        $_SESSION['otp']=$otp;
                         sendMail($user_id, $subject, $message);
                       
                          header("location: loginWithOtp.php?id=".$user_id);
                      

                      }
                      // else if($user_id==$fetch_user_id) 
                      // {
                      // 		require('textlocal.class.php');

                      // 		$textlocal = new Textlocal(false,false,'yVqTbKgFiks-VW3DtUVBonMWgSssTYNJ7A1jA4xcOz	');

                      // 		$numbers = array(9048874240);
                      // 		$sender = 'TXTLCL';
                      // 		$otp = mt_rand(100000,999999);
                      // 		$message = "Hello ".$user_id."Your otp is: ".$otp;

                      // 		try {
                      // 			$result = $textlocal->sendSms($numbers, $message, $sender);
                      // 			//print_r($result);
                      // 			setcookie('otp',$otp);
                      // 			echo "otp Successfully send...".$message;


                      // 		} catch (Exception $e) {
                      // 			die('Error: ' . $e->getMessage());
                      // 		}
                      // }
                      else {
                        echo 'invalid userid';
                      }
                    }
                    ?>
                    <form class="user" action='#' method='post'>
                      <div class="form-group">
                        <input type='text' name='user_id' class="form-control form-control-user" id="user_id" aria-describedby="emailHelp" placeholder="Enter email id...">
                      </div>
                      <input type='submit' name='generate_otp' value='generate_otp' class="btn btn-primary btn-user btn-block" />

                    </form>
                  </div>

                  <?php
                  if (isset($_POST['login_with_otp'])) {
                    $otp = $_POST['otp'];
                    if ($_COOKIE['otp'] == $otp) {
                      // Password is correct, so start a new session
                      if (!isset($_SESSION)) {
                        session_start();
                      }
                      //session_start();

                      // Store data in session variables
                      $_SESSION["loggedin"] = true;
                      $_SESSION["id"] = $id;
                      $_SESSION["username"] = $user_id;

                      // Redirect user to welcome page
                      header("location: index.php");
                    } else {
                      // Display an error message if password is not valid
                      echo "otp wrong";
                    }
                  }
                  ?>
                  <!-- <div class="p-5">

                    <div class="text-center">
                      <h1 class="h4 text-gray-900 mb-2">Login with otp</h1>
                    </div>
                    <form class="user" id="otp_login" action='' method='post'>
                      <div class="form-group">
                        <input type='text' name='otp' class="form-control form-control-user" id="otp" aria-describedby="emailHelp" placeholder="Enter otp...">
                      </div>
                      <input type='submit' name='login_with_otp' value='login_with_otp' class="btn btn-primary btn-user btn-block" />

                    </form>
                    <hr>

                  </div> -->
                </div>
            </div>
          </div>
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

</body>

</html>