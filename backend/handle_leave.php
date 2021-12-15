<?php 
require('dbconnect.php');

session_start();
if($_SESSION['type']=='admin'){

$_id=$_GET['i'];
$s=$_GET['s'];


$sql="update leave_request set status='$s' where id=$_id";
    if (mysqli_query($conn, $sql)) {

        echo "<script>alert('Leave Handled');
        window.location = '../routes/adminboard.php';</script> ";
    }
    else
    { 
        echo "<script>alert('Sorry".mysqli_error($conn)." !!! There was an error ');
    window.location = '../routes/adminboard.php';</script> ";
    }
}



?>