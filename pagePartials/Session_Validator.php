<?php
session_start();
// echo $_SESSION['user'];
// echo $pageuser;

if (isset($_SESSION['user'])) {

    if ($_SESSION['user'] != $pageuser || $pageuser == 'login-signup') {
        if ($_SESSION['user'] == 'Student') {
            header("Location: /deanacadproj/Student_Dashboard.php");
            die();
        } else {
            if ($_SESSION['user'] == 'Professor') {
                header("Location: /deanacadproj/Professor_Dashboard.php");
                die();
            } else {
                header("Location: /deanacadproj/Admin_Dashboard.php");
                die();
            }
        }
    }
}
//else redirect to login page
else {

    if ($pageuser != 'login-signup') {
        header("Location: /deanacadproj/Login_Signup.php");
        die();
    }
}
