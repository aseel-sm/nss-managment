<?php 
require('dbconnect.php');

session_start();
if($_SESSION['auth']=='true'){

$_id=$_GET['i'];
$s=$_GET['s'];


$sql="update blood_request set is_satisfied='$s' where request_id=$_id";
    if (mysqli_query($conn, $sql)) {

        echo "<script>alert('Request Handled');
        window.location = '../routes/bloodbank/adminboard.php';</script> ";
    }
    else
    { 
        echo "<script>alert('Sorry".mysqli_error($conn)." !!! There was an error ');
    window.location = '../routes/bloodbank/adminboard.php';</script> ";
    }
}



?>