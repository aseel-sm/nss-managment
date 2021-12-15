<?php 
require('dbconnect.php');



function portal_status($type){
    global $conn;
    $sql="select status from portal_status where type='$type'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
return $row['status'];
}


?>