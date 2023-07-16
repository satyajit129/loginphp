<?php
session_start();
require_once "databaseconnection.php";
if(isset($_GET['token'])){
    $token = $_GET['token'];
    $updatequery = " UPDATE `sign up information` SET status='active' where token= '$token' ";

    $query = mysqli_query($conn, $updatequery);
    if($query){
        if(isset($_SESSION['message'])){
            $_SESSION['message']= " Account update successfully";
            header('location: login.php');
        }else{
            $_SESSION['message']= "YOu are logged out";
            header('location: login.php');
        }
    }else{
        $_SESSION['message']= " Account not update ";
            header('location: signup.php');
    }
}


?>