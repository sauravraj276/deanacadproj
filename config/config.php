<?php
$servername = "localhost";
$username = "root";
$passwoord = "";
$database = "institute";
$conn = mysqli_connect($servername,$username,$passwoord,$database);
if(mysqli_connect_errno()){
    echo "failed to connect to".$database."database :".mysqli_connect_error();
}
?>