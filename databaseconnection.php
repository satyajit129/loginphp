<?php
    $servername="localhost";
    $username= "root";
    $userpassword= "";
    $databasename= "signupsystem";
    
    $conn = mysqli_connect($servername,$username,$userpassword,$databasename);
    if(!$conn){
        ?>
        <script>
            alert(" Not Connected successfully");
        </script>
        <?php
    }
    /* $servername= "localhost";
    $username= "root";
    $password="";
    $databasename="signupsystem";

    $conn= mysqli_connect($servername,$username,$password,$databasename);
    if($conn){
        ?>
        <script>
            alert("Connected successfully");
        </script>
        <?php        
    }
    else{
        ?>
        <script>
            alert(" Not Connected successfully");
        </script>
        <?php
    } */
?>