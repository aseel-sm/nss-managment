<?php
session_start();
require('dbconnect.php');
require('utilities.php');
if (isset($_SESSION['auth'])) {
    if ($_SESSION['type']=='admin') {
        if(isset($_POST['pass'])){
            $sql="select * from admin";
            $result=mysqli_query($conn, $sql);
            $user=mysqli_fetch_assoc($result);
            if($user['password']==$_POST['pass']){
academic_update('donor');
academic_update('volunteer');
academic_update('event');
           echo "success";
            }
            else{
                echo "nopass";
            }
           

        }
      
    }
}

?>