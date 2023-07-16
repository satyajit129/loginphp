<?php
session_start();



    require_once "databaseconnection.php";

    if(isset($_POST['submit'])){
        $username = mysqli_real_escape_string($conn, $_POST['username']) ;
            $_SESSION['username'] = $username;
        $useremail = mysqli_real_escape_string($conn, $_POST['useremail']) ;
        $userpassword = mysqli_real_escape_string($conn, $_POST['userpassword']) ;
        $usercpassword = mysqli_real_escape_string($conn, $_POST['cuserpassword']) ;
        $userbirthday = mysqli_real_escape_string($conn, $_POST['userbirthday']) ; 

        $pass= password_hash($userpassword, PASSWORD_BCRYPT);
        $cpass= password_hash($usercpassword, PASSWORD_BCRYPT);
        $token = bin2hex(random_bytes(15));

        $emailquery = " SELECT * FROM `sign up information` WHERE email= '$useremail' ";
        $query = mysqli_query($conn, $emailquery);

        $emailcount = mysqli_num_rows($query);

        if($emailcount>0){
            echo "This email already exist";
        }
        else{
            if($userpassword === $usercpassword){

                $insertquery=  "INSERT INTO `sign up information`(`id`, `name`, `email`, `password`, `date of birth`, `confirm_password`, `token`, `status`) VALUES ('','$username','$useremail','$pass','$userbirthday','$cpass','$token','inactive')";

                $iquery = mysqli_query($conn, $insertquery);
                if($iquery){
                    
                    $subject = "Email Activation";
                    $body = "Hi, $username  click here to reset the password http://http://localhost/login/activate.php?token=$token;";
                    $headers = "From: noreply@gmail.com";
        
                    if (mail($useremail, $subject, $body, $headers))
                    // if($username != null)
                    {
                        $_SESSION['message'] = "check your mail to activate $useremail";
                        header('location: login.php');
                    } else {
                        echo "Email sending failed...";
                    }

                    
                    // header("Location: welcome.php");
                    // exit();
                }
                else{
                    echo "data not inserted ";
                }
            }
            else{
                echo "password not matching";
            }
        }
    }


 /*   if(isset($_POST['submit'])){
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $useremail = mysqli_real_escape_string($conn, $_POST['useremail']);
        $userpassword = mysqli_real_escape_string($conn, $_POST['userpassword']);
        $usercpassword = mysqli_real_escape_string($conn, $_POST['cuserpassword']);
        $userbirthday = mysqli_real_escape_string($conn, $_POST['userbirthday']);
        
        $pass= password_hash($userpassword, PASSWORD_BCRYPT);
        $cpass= password_hash($usercpassword, PASSWORD_BCRYPT);
        // check if the email already registered or not 
        $emailquery= " SELECT * FROM `sign up information` WHERE email='$useremail' ";
        $query= mysqli_query($conn, $emailquery);


        // this part of code check if one email available in database 
        $emailcount= mysqli_num_rows($query);
        
        if($emailcount>0){
            echo " email already exist";
        }
        else{
            if($userpassword === $usercpassword){
                $insertquery= "INSERT INTO `sign up information`(`id`, `name`, `email`, `password`, `date of birth`) VALUES ('','$username','$useremail','$pass','$userbirthday')";

                $iquery= mysqli_query($conn, $insertquery);
                if($iquery){
                    echo "inserted successfully";
                }
                else{
                    echo "not inserted successfully";
                }
            }
            else{
                echo " password are not matching";
            }
        }
}*/

?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- <link rel="stylesheet" href="/bootstrap.min.css"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/cdn.jsdelivr.net_npm_bootstrap@5.3.0_dist_css_bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Sign Up</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Navbar</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">Log In</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <div class="container">
        <h2 class="text-center">Please sign up</h2>
        <form action="signup.php" method="POST" class="form-control-sm">
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="username" class="form-control" id="username" placeholder="Type your name" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Enter Your Email</label>
                <input type="email" name="useremail" class="form-control" id="useremail" placeholder="Enter your Email" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="userpassword" class="form-control" id="userpassword"
                    placeholder="Enter your password" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Confirm Password</label>
                <input type="password" name="cuserpassword" class="form-control" id="cuserpassword"
                    placeholder="Confirm Your Password" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Date of Birth</label>
                <input type="date" id="birthday" class="form-control" name="userbirthday" required>
            </div>
            <button type="submit" class="btn btn-primary" name="submit" >Sign Up</button><br>
            <label class="form-label">Have An Account? <a href="login.php">PLease log in </a> </label>
        </form>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="/cdn.jsdelivr.net_npm_@popperjs_core@2.11.8_dist_umd_popper.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
</body>

</html>