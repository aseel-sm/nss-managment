<?php 
require('dbconnect.php');

session_start();
if($_SESSION['type']=='admin'){
    $id=$_GET['q'];
    $sql="DELETE FROM `department` WHERE `dept_id`='$id'";
    if (mysqli_query($conn, $sql)) {
        header("Location:../routes/adminboard.php");
    }
    else
    echo "<script>alert('Sorry !!! There was an error ');
    window.location = '../routes/adminboard.php';</script> ";

}



?>