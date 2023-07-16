<?php
    session_start();
    require_once "databaseconnection.php";
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

    <title>Log in </title>
</head>

<body>

<?php
    require_once "databaseconnection.php";
    if(isset($_POST['submit'])){
        $useremail = $_POST['useremail'];
        $userpassword = $_POST['userpassword'];

        $email_search= " SELECT * FROM `sign up information` WHERE  email ='$useremail'  and status = 'active' LIMIT 1 ";
        $query = mysqli_query($conn,$email_search);
        $email_count = mysqli_num_rows($query);
        if($email_count){
            $user_password= mysqli_fetch_assoc($query);

            $db_pass= $user_password['password'];

                $_SESSION['username'] = $user_password['name'];

            $password_decode= password_verify($userpassword, $db_pass );

            if($password_decode){
                echo "login successfull";
                header('location:welcome.php');
            }
            else{
                echo "password inCorrect ";
            }
        }
        else{
            echo "invalid email";
        }
    }
?>
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
                            <a class="nav-link active" aria-current="page" href="signup.php">Sign Up</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <div class="container">
    <h2 class="text-center">Please Log in </h2>

    <p class="bg-success text-white px-4"> <?php echo $_SESSION['message'];  ?> </p>
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" class="form-control-sm">
            <div class="mb-3">
                <label class="form-label">Enter Your Email</label>
                <input type="email" name="useremail" class="form-control" id="useremail" placeholder="Enter your Email">
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="userpassword" class="form-control" id="userpassword"
                    placeholder="Enter your password">
            </div>
            <input class="form-label" type="submit" name="submit" value="login">
            <br><label class="form-label">Forgot Password? No Worry <a href="recover_email.php">Click here to recover </a> </label>
            <br><label class="form-label">Don't Have an Account? <a href="signup.php">PLease Sign up </a> </label>
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