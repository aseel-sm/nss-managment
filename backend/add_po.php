<?php 

require('dbconnect.php');

$name=$_POST['name'];
$contact=$_POST['contact'];
$dept=$_POST['dept'];


if (isset($_POST['submit'])) {
    $sql="INSERT INTO `program_officers`(`name`,dept_id,phone) VALUES ('$name','$dept','$contact')";
    if (mysqli_query($conn, $sql)) {
    
        echo "<script>alert('PO Added');
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