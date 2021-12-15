<?php 
require('dbconnect.php');
$dept=$_POST['dept'];


if (isset($_POST['submit'])) {
    $sql="INSERT INTO `department`(`name`) VALUES ('$dept')";
    if (mysqli_query($conn, $sql)) {
    
        echo "<script>alert('Department Added');
    window.location = '../routes/adminboard.php';</script> ";
    } else {
        die(mysqli_error($conn));
        echo "<script>alert('Sorry !!! There was an error ');
    window.location = '../routes/adminboard.php';</script> ";
    }
}else
{
    echo "<script>alert('Sorry !!! There was an error ');
    window.location = '../routes/adminboard.php';</script> ";
}

?>