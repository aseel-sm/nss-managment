<?php
session_start();
require('dbconnect.php');
if(isset($_SESSION['auth']))
{
    if($_SESSION['type']=='volunteer'||$_SESSION['type']=='admin'){



$user=$_GET['q'];
$mobile=$_POST['mobile'];
$mail=$_POST['mail'];

$sql="update volunteers_profile set mobile_no='$mobile' ,email='$mail' where username='$user'";
    if (mysqli_query($conn, $sql)) {

        echo "<script>alert('Updated ');
        window.location = '../routes/userboard.php'
        </script> ";

    }
    else
    echo  mysqli_error($conn);


    }

}


?>