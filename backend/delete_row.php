<?php 
require('dbconnect.php');
$id=$_POST['id'];
$tb=$_POST["tb"];
$sql="DELETE FROM `$tb` WHERE id =$id ";
if(mysqli_query($conn,$sql)){
    
    echo "success";
}
else
echo mysqli_error($conn);


?>