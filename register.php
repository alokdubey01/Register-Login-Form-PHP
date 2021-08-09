<?php 
include "config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <title>Register</title>


    <?php 
	$error_message = "";$success_message = "";

	// Register user
	if(isset($_POST['btnsignup'])){
		$fname = trim($_POST['fname']);
		$lname = trim($_POST['lname']);
		$email = trim($_POST['email']);
		$password = trim($_POST['password']);
		$confirmpassword = trim($_POST['confirmpassword']);

		$isValid = true;

		// Check fields are empty or not
		if($fname == '' || $lname == '' || $email == '' || $password == '' || $confirmpassword == ''){
			$isValid = false;
			$error_message = "Please fill all fields.";
		}

		// Check if confirm password matching or not
		if($isValid && ($password != $confirmpassword) ){
			$isValid = false;
			$error_message = "Confirm password not matching.";
		}

		// Check if Email-ID is valid or not
		if ($isValid && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
		  	$isValid = false;
		  	$error_message = "Invalid Email-ID.";
		}

		if($isValid){

			// Check if Email-ID already exists
			$stmt = $con->prepare("SELECT * FROM users WHERE email = ?");
			$stmt->bind_param("s", $email);
			$stmt->execute();
			$result = $stmt->get_result();
			$stmt->close();
			if($result->num_rows > 0){
				$isValid = false;
				$error_message = "Email-ID is already existed.";
			}
			
		}

		// Insert records
		if($isValid){
			$insertSQL = "INSERT INTO users(fname,lname,email,password ) values(?,?,?,?)";
			$stmt = $con->prepare($insertSQL);
			$stmt->bind_param("ssss",$fname,$lname,$email,$password);
			$stmt->execute();
			$stmt->close();

			$success_message = "Account created successfully. <a href='login.php'>Login</a>";
		}
	}
	?>

</head>
<body>

    <div class="container">
        <div class="form">
            <div class="register">
                <form action="" method="POST" class="register_form">
                    <h2 class="title">Register</h2>
                    <?php 
					// Display Error message
					if(!empty($error_message)){
					?>
						<div class="alert alert-danger">
						  	<strong>Error!</strong> <?= $error_message ?>
						</div>

					<?php
					}
					?>

                    <?php 
					// Display Success message
					if(!empty($success_message)){
					?>
						<div class="alert alert-success">
						  	<strong>Success!</strong> <?= $success_message ?>
						</div>

					<?php
					}
					?>
                    <div class="input-field">
                    <i class="fas fa-user-circle"></i>
                    <input class="input" type="text" name="fname" placeholder="First Name" required>
                    </div>

                    <div class="input-field">
                    <i class="fas fa-user-circle"></i>
                    <input class="input" type="text" name="lname" placeholder="Last Name" required>
                    </div>

                    <div class="input-field">
                    <i class="fas fa-envelope"></i>
                    <input class="input" type="email" name="email" placeholder="Your Email" required>
                    <span id="check-e"></span>
                    </div>

                    <div class="input-field">
                    <i class="fas fa-lock"></i>
                    <input class="input" type="password" name="password" placeholder="Set Password" required>
                    </div>

                    <div class="input-field">
                    <i class="fas fa-lock"></i>
                    <input class="input" type="password" name="confirmpassword" placeholder="Set Password" required>
                    </div>

                    <input name="btnsignup" type="submit" value="Register" class="btn submit">
                </form>
            </div>
        </div>

        <div class="pannel">
        <img src="img/register.svg" alt="Image">
            <p>Already have a account ?</p>
            <a href="login.php">Login here</a>
        </div>
    </div>
</body>
</html>