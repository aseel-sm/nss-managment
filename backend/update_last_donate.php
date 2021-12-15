<?php
session_start();
require('dbconnect.php');
if(isset($_SESSION['auth']))
{
    if($_SESSION['type']=='donor'){

$id=$_GET['q'];
$l_date=$_POST['l_date'];
$next_donate=date('Y-m-d',strtotime('+ 3 months',strtotime($l_date)));


$sql="update blood_donor_profile set last_donate='$l_date' ,next_donate='$next_donate' where donor_id='$id'";
    if (mysqli_query($conn, $sql)) {

        echo "<script>alert('Updated ');
        window.location = '../routes/bloodbank/bloodboard.php'
        </script> ";

    }
    else
    echo  mysqli_error($conn);


    }

}


?>