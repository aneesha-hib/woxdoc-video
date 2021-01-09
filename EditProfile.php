<?php
// Include config file
require_once "config.php";
session_start();
$doctor_id=$_SESSION['id'];
// Define variables and initialize with empty values
$username = $email = $address = $phone = $department = "";
$username_err =  $email_err = $address_err = $phone_err = $department_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate username
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter a username.";
    } else {
        $username = trim($_POST['username']);
        
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
   
    // Check input errors before inserting in database
    if (empty($username_err)  && empty($email_err) && empty($address_err) && empty($phone_err)) {

        // Prepare an insert statement
      //  $sql = "INSERT INTO users (username,email,address,phone, password,department) VALUES (?, ?, ?,?,?,?)";
        $sql = "UPDATE users set username=?,email=?,address=?,phone=?,department=? where id =?";
        // echo $sql = "INSERT INTO users (username,email,address,phone, password) VALUES ('$username', '$email', '$address',$phone,'$password')";
        //$res=mysqli_query($link,$sql);
        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssssi", $param_username, $param_email, $param_address, $param_phone, $param_department,$param_id);

            // Set parameters
            echo  $param_username = $username;
            echo $param_email = $email;
            echo  $param_address = $address;
            echo $param_phone = $phone;
            // echo $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            echo $param_department = $department;
            echo $param_id=$doctor_id;
            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Redirect to login page
                header("location: index.php");
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
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body {
            font: 14px sans-serif;
        }

        .wrapper {
            width: 350px;
            padding: 20px;
        }
    </style>
     
</head>

<body onload=display_c();>

    <div class="wrapper">
        <h2>View Profile</h2>
        
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <?php 
        $query = "SELECT  * FROM users where id='$doctor_id'"; 
        $result = mysqli_query($link,$query);
         while($row=$result->fetch_assoc())
         {
             $username=$row['username'];
             $department=$row['department'];
             $email=$row['email'];
             $address=$row['address'];
             $phone=$row['phone'];
             ?>
            
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <!-- <input type="text" name="username" class="form-control" value="<?php echo $username; ?>"> -->
                <label class="form-control"><?php echo $username; ?></label>
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($department_err)) ? 'has-error' : ''; ?>">
                <label>Department</label>
                <!-- <input type="text" name="department" class="form-control" value="<?php echo $department; ?>"> -->
                <label class="form-control"><?php echo $department; ?></label>
                <span class="help-block"><?php echo $department_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                <label>Email</label>
                <!-- <input type="text" name="email" class="form-control" value="<?php echo $email; ?>"> -->
                <label class="form-control"><?php echo $email; ?></label>
                <span class="help-block"><?php echo $email_err; ?></span>
            </div>

            <div class="form-group <?php echo (!empty($address_err)) ? 'has-error' : ''; ?>">
                <label>Address</label>
                <!-- <input type="text" name="address" class="form-control" value="<?php echo $address; ?>"> -->
                <label class="form-control"><?php echo $address; ?></label>
                <span class="help-block"><?php echo $address_err; ?></span>
            </div>

            <div class="form-group <?php echo (!empty($phone_err)) ? 'has-error' : ''; ?>">
                <label>Phone</label>
                <!-- <input type="text" name="phone" class="form-control" value="<?php echo $phone; ?>"> -->
                <label class="form-control"><?php echo $phone; ?></label>
                <span class="help-block"><?php echo $phone_err; ?></span>
            </div>


            <!-- <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div> -->
            <div class="form-group">
                <!-- <input type="submit" class="btn btn-primary" value="Update"> -->
                <a href="index.php" type="cancel" class="btn btn-primary" value="Reset" >OK</a>
            </div>
            
            <?php
         }
        ?>
        </form>
       
    </div>
   
</body>
</html>