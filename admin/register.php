<?php
// Include config file
require_once "../config.php";

// Define variables and initialize with empty values
$username = $password = $confirm_password = $email = $address = $phone = $department = "";
$username_err = $password_err = $confirm_password_err = $email_err = $address_err = $phone_err = $department_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate username
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter a username.";
    } else {
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set parameters
            $param_username = trim($_POST["username"]);

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                /* store result */
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $username_err = "This username is already taken.";
                } else {
                    $username = trim($_POST["username"]);
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }
    //Validate email
    if (empty(trim($_POST['department']))) {
        $department_err = "Please enter your department ";
    } else {
        $department = trim($_POST['department']);
    }

    if (empty(trim($_POST['email']))) {
        $email_err = "Please enter your email id ";
    } else {
        $email = trim($_POST['email']);
    }
    //Validate address
    if (empty(trim($_POST['address']))) {
        $address_err = "Please enter your address ";
    } else {
        $address = trim($_POST['address']);
    }
    //Validate phone
    if (empty(trim($_POST['phone']))) {
        $phone_err = "Please enter your phone";
    } else {
        $phone = trim($_POST['phone']);
    }
    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password.";
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $password_err = "Password must have atleast 6 characters.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate confirm password
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Please confirm password.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = "Password did not match.";
        }
    }

    // Check input errors before inserting in database
    if (empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($email_err) && empty($address_err) && empty($phone_err)) {

        // Prepare an insert statement
        $sql = "INSERT INTO users (username,email,address,phone, password,department) VALUES (?, ?, ?,?,?,?)";
        // echo $sql = "INSERT INTO users (username,email,address,phone, password) VALUES ('$username', '$email', '$address',$phone,'$password')";
        //$res=mysqli_query($link,$sql);
        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssss", $param_username, $param_email, $param_address, $param_phone, $param_password, $param_department);

            // Set parameters
              $param_username = $username;
             $param_email = $email;
              $param_address = $address;
             $param_phone = $phone;
             $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
             $param_department = $department;
            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Redirect to login page
                $iid = mysqli_insert_id($link);
                header("location:../pricingPlan.php?id=$iid");
                echo "Registered Successfully";
            } else {
                echo "Something went wrong. Please try again later.";
            }
        } else {
            echo "failed";
        }

        // Close statement
        //mysqli_stmt_close($stmt);
    }

    // Close connection
    // 
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Add Doctor</title>

  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body onload=display_c(); id="page-top">
    <br>
    <div class="container-fluid">
    <center>
        <h2>Add Doctor</h2>
        <p>Please fill this form to create an account.</p>
      

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="user "  >

            <div class="form-group col-sm-6 <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <!-- <label>Username</label> -->
                <input type="text" name="username" class="form-control form-control-user" value="<?php echo $username; ?>" placeholder="Username">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>
            <div class="form-group col-sm-6 <?php echo (!empty($department_err)) ? 'has-error' : ''; ?>">
                <!-- <label>Department</label> -->
                <input type="text" name="department" class="form-control form-control-user" value="<?php echo $department; ?>"  placeholder="Department">
                <span class="help-block"><?php echo $department_err; ?></span>
            </div>
            <div class="form-group col-sm-6 <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                <!-- <label>Email</label> -->
                <input type="text" name="email" class="form-control form-control-user" value="<?php echo $email; ?>" placeholder="Email">
                <span class="help-block"><?php echo $email_err; ?></span>
            </div>

            <div class="form-group col-sm-6 <?php echo (!empty($address_err)) ? 'has-error' : ''; ?>">
                <!-- <label>Address</label> -->
                <input type="text" name="address" class="form-control form-control-user" value="<?php echo $address; ?>" placeholder="Address">
                <span class="help-block"><?php echo $address_err; ?></span>
            </div>

            <div class="form-group col-sm-6 <?php echo (!empty($phone_err)) ? 'has-error' : ''; ?>">
                <!-- <label>Phone</label> -->
                <input type="text" name="phone" class="form-control form-control-user" value="<?php echo $phone; ?>" placeholder="Phone">
                <span class="help-block"><?php echo $phone_err; ?></span>
            </div>


            <div class="form-group col-sm-6 <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <!-- <label>Password</label> -->
                <input type="password" name="password" class="form-control form-control-user" value="<?php echo $password; ?>" placeholder="Password">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group col-sm-6 <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <!-- <label>Confirm Password</label> -->
                <input type="password" name="confirm_password" class="form-control form-control-user" value="<?php echo $confirm_password; ?>" placeholder="Confirm Password">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group col-sm-6">
                <input type="submit" class="btn btn-primary btn-user btn-block" value="Submit">
                <!-- <input type="reset" class="btn btn-default btn-user btn-block" value="Reset"> -->
            </div>
            <!-- <p>Already have an account? <a href="login.php">Login here</a>.</p> -->
        </form>
       </center>
    </div>
</body>

</html>