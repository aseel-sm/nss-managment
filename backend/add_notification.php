<?php 

require('dbconnect.php');

$title=$_POST['title'];
$category=$_POST['category'];
$description=$_POST['description'];

if (isset($_POST['submit'])) {
    $sql="INSERT INTO `notification`(`title`, `description`, `category`) VALUES ('$title','$description','$category')";
    if (mysqli_query($conn, $sql)) {
    
        header("Location:../routes/adminboard.php");
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