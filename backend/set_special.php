<?php 

require('dbconnect.php');
$id=$_POST['id'];
$status=$_POST['status'];
if($status==3)
$type=3;
if($status==2)
$type=2;
if($status==1)
$type=1;



$sql="update volunteers_profile set user_type='$type'  where id='$id' ";


if (mysqli_query($conn, $sql)) {
  echo "<script>alert('Special Status Added');
 window.location = '../routes/adminboard.php';</script> ";
}
else{
    echo mysqli_error($conn);
}
?>