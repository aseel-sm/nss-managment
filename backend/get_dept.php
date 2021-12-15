<?php
require('dbconnect.php');
function get_dept()
{   global $conn;
    $sql="select *from department";
    if (mysqli_query($conn, $sql)) {
        $result=mysqli_query($conn,$sql);
       
        return $result;
    }
}


?>