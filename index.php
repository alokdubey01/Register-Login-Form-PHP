<?php
include "config.php";


if(!isset($_SESSION['email'])){
    header('Location: index.php');
}

if(isset($_POST['but_logout'])){
    session_destroy();
    header('Location: login.php');
}
?>
<!doctype html>
<html>
    <nav>
        <h1>Index</h1> <!--
        <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">contact</a></li>
            <li><a href="#">About Us</a></li>
        </ul> -->
    </nav>
    <head></head>
    <body>
        <h1>Homepage</h1>
        <form method='post' action="">
            <input type="submit" value="Logout" name="but_logout">
        </form>
    </body>
</html>