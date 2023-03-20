<?php
session_start();
$title = "Logout";
include './pagePartials/header.php';

if(isset($_SESSION['user'])){
    session_destroy();
    echo '
    <div class="alert alert-danger" role="alert">
    <h3>logout successfully</h3><p>redirecting to login page<p>
</div>';
    header( "refresh:1;url=/deanacadproj/Login_Signup.php" );
die();
}
else header("Location: /deanacadproj/Login_Signup.php");
?>