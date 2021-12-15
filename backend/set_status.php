<?php 
require('dbconnect.php');
$type=$_POST['type'];
$status=$_POST["status"];
$new_status=$status==0? 1:0;
$sql="UPDATE portal_status set status=$new_status where type='$type'";
if(mysqli_query($conn,$sql)){
    
    echo "success";
}

?>