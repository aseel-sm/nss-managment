<?php 

require('dbconnect.php');

$cat=$_POST['cat'];
$bg=$_POST['bg'];
$email=$_POST['email'];
$dob=$_POST['dob'];
$gname=$_POST['gname'];
$vphone=$_POST['vphone'];
$place=$_POST['place'];
$pincode=$_POST['pincode'];
$talent=$_POST['talent'];
$yoj=date("Y");
$user=$_GET['q'];
echo $_POST['submit'];
if (isset($_POST['submit'])) {
    $sql="UPDATE `volunteers_profile` SET `guardian_name`='$gname',`dob`='$dob',`community`='$cat',
    `blood_group`='$bg',`mobile_no`='$vphone',`email`='$email',`pincode`='$pincode',`place`='$place',`year_of_join`='$yoj' where username='$user'";
    if (mysqli_query($conn, $sql)) {

    if(mysqli_query($conn, "UPDATE volunteers_profile set user_type=1,is_active=1 where username='$user'"))
{  $_SESSION['type']="volunteer";

    if ($user_type==1) {
        $_SESSION['special']='';
    } elseif ($user_type==2) {
        $_SESSION['special']="secretary";
    } else {
        $_SESSION['special']="blood_manager";
    }
    header("Location:../routes/userboard.php");
}       
    } else {
        die(mysqli_error($conn));
        echo "<script>alert('Sorry !!! There was an error1 ');
    ";
    }
    //window.location = '../routes/adminboard.php';</script> 
}
else
{
    echo "<script>alert('Sorry !!! There was an error2 ');
</script> ";
}

?>