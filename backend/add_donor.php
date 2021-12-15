<?php 
require('dbconnect.php');
function is_donor_exist($user)
{
    global $conn;
    $sql="select mobile_no  from donor_profile where mobile_no='$user'";
    if (mysqli_query($conn, $sql)) {
        $result=mysqli_query($conn, $sql);
        if (mysqli_num_rows($result)>0) {
            return 1;
        } else {
            return 0;
        }
    }
}

$mobile=$_POST['pno'];


if(is_donor_exist($mobile)==0){
    $pass=$_POST['pass'];
    $name=$_POST['name'];
    $dept=$_POST['dept'];
    $s_year=$_POST['s_year'];
    $place=$_POST['place'];
    $l_donate=$_POST['last_donate'];
    $bg=$_POST['bg'];
    $pincode=$_POST['pincode'];


    $next_donate=date('Y-m-d',strtotime('+ 3 months',strtotime($l_donate)));
$year=date('Y');
$sql="INSERT INTO `blood_donor_profile`( `donor_name`, `dept_id`, `year`, `blood_group`, `last_donate`, `next_donate`, `mobile_no`, `password`, `is_active`, `stdy_year`,`pincode`)
 VALUES ('$name','$dept','$year','$bg','$l_donate','$next_donate','$mobile','$pass','1','$s_year','$pincode')";
if(mysqli_query($conn,$sql)){

    echo "<script>alert('Registered. Login with mobile number');
    window.location = '../routes/bloodbank/bloodbank.php';</script> ";
        }
        echo mysqli_error($conn);
}
else{
    echo "<script>alert('Sorry !!!User Exist');
    window.location = '../routes/bloodbank/bloodbank.php';</script> ";
}












?>