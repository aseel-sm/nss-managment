<?php 

require('dbconnect.php');
$vid=$_POST['v_id'];
$eid=$_POST['e_id'];
$sql="select vol_id from attendence where vol_id='$vid' and event_id='$eid' ";
$result=mysqli_query($conn,$sql);
if(mysqli_num_rows($result)>0)
$sql="DELETE FROM attendence WHERE vol_id='$vid' and event_id='$eid'";
else
$sql="INSERT INTO `attendence`(`vol_id`, `event_id`) VALUES ('$vid','$eid')";

if(mysqli_query($conn,$sql)){
    echo "success";
}
else{
    echo mysqli_error($conn);
}
?>