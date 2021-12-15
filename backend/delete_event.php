<?php
require('dbconnect.php');

$id=$_GET['id'];
    $sql="select * from event order by start_date desc";
    if ($result=mysqli_query($conn, $sql)) {
   $row=mysqli_fetch_assoc($result);
   $name= $row['name'];
   $date=$row['start_date'];
   
  

   if (date('Y-m-d')<$date) {
    
       
   $desc='Event '.$name.' scheduled on '.$date.' is cancelled. Sorry for the inconvinience';

   $sql="DELETE FROM `event` WHERE id =$id ";
   if(mysqli_query($conn,$sql)){
       
    $sql="INSERT INTO `notification`(`title`, `description`, `category`) VALUES ('Event Cancelled','$desc','public')";
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Event Deleted ');
        window.location = '../routes/adminboard.php';</script> ";
        
    } else {
        die(mysqli_error($conn));
        echo "<script>alert('Sorry !!! There was an error ');
    window.location = '../routes/adminboard.php';</script> ";
    }
   }
   else
   echo mysqli_error($conn),"yuuy";
   }
   else
    echo "<script>alert('Event Date over ');
      window.location = '../routes/adminboard.php';</script> ";
   

    }

?>
