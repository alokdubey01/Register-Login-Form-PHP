<?php
include "config.php";


if(isset($_POST['but_submit'])){

    $email = mysqli_real_escape_string($con,$_POST['txt_email']);
    $password = mysqli_real_escape_string($con,$_POST['txt_pwd']);


    if ($email != "" && $password != ""){

        $sql_query = "select count(*) as cntUser from users where email='".$email."' and password='".$password."'";
        $result = mysqli_query($con,$sql_query);
        $row = mysqli_fetch_array($result);

        $count = $row['cntUser'];

        if($count > 0){
            $_SESSION['email'] = $email;
            header('Location: index.php');
        }else{
            echo "<script>alert('Invalid username and password')</script>";
        }

    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen"> 
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>
<body>
    <div class="container">
        <div class="form">
            <div class="register">
                <form action="" method="POST" class="register_form">

                    <h2 class="title">Login</h2>
                    <?php
                        if(isset ($msg)){
                            echo $msg;
                        }
                    ?>

                    <div class="input-field">
                    <i class="fas fa-user-circle"></i>
                    <input class="input" type="email" name="txt_email" placeholder="Set Username">
                    <span id="check-e"></span>
                    </div>

                    <div class="input-field">
                    <i class="fas fa-lock"></i>
                    <input class="input" type="password" name="txt_pwd" placeholder="Enter Password">
                    </div>

                    <input name="but_submit" type="submit" value="Login" class="btn submit">

                </form>
            </div>
        </div>

        <div class="pannel">
        <img src="img/login.svg" alt="Image">
            <p>Already have a account ?</p>
            <a href="register.php">Register here</a>
        </div>
    </div>
</body>
</html>