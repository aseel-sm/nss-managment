<?php 
require('dbconnect.php');





if(isset($_POST['submit'])){
    
$bg=$_POST['bg'];
$unit=$_POST['unit'];
$address=$_POST['hospital'];
$pname=$_POST['patient'];
$contact=$_POST['contact'];
$dater=$_POST['dater'];
  
    
  
    $pincode=$_POST['pincode'];


   
$sql="INSERT INTO `blood_request`(`patient_name`, `blood_group`, `no_of_unit`, `hospital`, `mobile_no`, `request_date`,`pincode`)
 VALUES ('$pname','$bg','$unit','$address','$contact','$dater','$pincode')";
if(mysqli_query($conn,$sql)){

    echo "<script>alert('Requested.Please give an SMS REQUESTED to 9207418150');
    window.location = '../routes/bloodbank/bloodbank.php';</script> ";
        }
        else
        echo mysqli_error($conn);




}
else
echo "<script>alert('Error');
window.location = '../routes/bloodbank/bloodbank.php';</script> "






?>