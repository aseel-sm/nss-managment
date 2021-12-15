<?php
session_start();
require('dbconnect.php');
if(isset($_SESSION['auth']))
{
    if($_SESSION['type']=='donor'){

$id=$_GET['q'];
$mob=$_POST['mobile'];


$sql="update blood_donor_profile set mobile_no=$mob  where donor_id='$id'";
    if (mysqli_query($conn, $sql)) {
        setcookie(
            "mob",
            $mob,
            time() + (10 * 365 * 24 * 60 * 60),'/'
        );

        echo "<script>alert('Updated ');
        window.location = '../routes/bloodbank/bloodboard.php'
        </script> ";

    }
    else
    echo  mysqli_error($conn);


    }

}


?>