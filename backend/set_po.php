<?php 

require('dbconnect.php');
$id=$_POST['id'];
$sql="select status from program_officers where po_id='$id' ";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_array($result);
$new_status=$row['status']==0?1:0;
$sql="update  program_officers set  status='$new_status' where po_id='$id' ";
if(mysqli_query($conn,$sql)){
    echo "success";
}
else{
    echo mysqli_error($conn);
}
?>