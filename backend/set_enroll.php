<?php 

require('dbconnect.php');
$id=$_POST['id'];
$sql="select user_type from volunteers_profile where id='$id' ";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_array($result);
$new_status=$row['user_type']==4?5:4;
$sql="update  volunteers_profile set  user_type='$new_status' where id='$id' ";
if(mysqli_query($conn,$sql)){
    echo "success";
}
else{
    echo mysqli_error($conn);
}
?>