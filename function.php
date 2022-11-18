<?php
session_start();
$conn = mysqli_connect('localhost', 'root', 'root', 'pengaduan', 8889);

function seeErrror()
{
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(0);
    error_reporting(E_ALL);
}

function cek_login(){
    if(isset($_SESSION['username'])){

    }else{
        header("location:login.php");
    }
}

function logout(){
    session_abort();
    session_unset();
    header("location:login.php");
}
?>