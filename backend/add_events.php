<?php 

require('dbconnect.php');

$name=$_POST['name'];
$s_date=$_POST['s_date'];
$e_date=$_POST['e_date'];
$desc=$_POST['desc'];
$ven=$_POST['ven'];
$hour=$_POST['hour'];
$curdate=strtotime(date('m/d/Y', time()));



$mydate=strtotime($s_date);
$ee_date=strtotime($e_date);
if ($mydate>$curdate) {
    
if ($ee_date>=$mydate) {
    if (isset($_POST['submit'])) {
        $sql="INSERT INTO `event`( `start_date`, `end_date`, `name`, `description`, `total_hour`, `venue`) VALUES ('$s_date','$e_date','$name','$desc','$hour','$ven')";
        if (mysqli_query($conn, $sql)) {
      
            




            echo "<script>alert('Event Added ');
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
}else{ echo "<script>alert('Sorry !!! Date logic error ');
    window.location = '../routes/adminboard.php';</script> ";}

}
else{
    echo "<script>alert('Sorry !!! Date logic error ');
    window.location = '../routes/adminboard.php';</script> ";}





?>