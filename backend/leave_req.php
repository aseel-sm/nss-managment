<?php 
require('dbconnect.php');

session_start();
if($_SESSION['type']=='volunteer'){

$user_id=$_POST['userid'];
$e_id=$_POST['eventid'];

$reason=$_POST['reason'];
$sql="INSERT INTO `leave_request`( `event_id`, `v_id`, `reason`) VALUES ('$e_id','$user_id','$reason')";
    if (mysqli_query($conn, $sql)) {
 
        echo "<script>alert('Leave Applied');
        window.location = '../routes/userboard.php';</script> ";
    }
    else
    { 
        echo mysqli_error($conn)  ;
        echo "<script>alert('Sorry".mysqli_error($conn)." !!! There was an error ');
    window.location = '../routes/userboard.php';</script> ";
    }
}



?>