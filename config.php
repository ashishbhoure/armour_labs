<?php
$con=mysqli_connect("127.0.0.1:3307", "root", "", "armourdb");
if(!$con){
    die('Connection Failed'.mysqli_connect_error());
}
?>