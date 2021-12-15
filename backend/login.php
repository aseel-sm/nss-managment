<?php
session_start();

require("utilities.php");
require("status.php");
$r_status=portal_status('registration');
$e_status=portal_status('enrollment');


$user=$_POST['username'];
$pass=$_POST['password'];

$user_exist=is_user_exist($user);
if ($user_exist!=0) {
    

    $authentication=authenticate($user, $pass, 'volunteers_profile');
    if ($authentication==1) {
        

        $user_type=get_user_type($user);
        $_SESSION['auth']="true";
        setcookie(
            "username",
            $user,
            time() + (10 * 365 * 24 * 60 * 60),'/'
        );
      
        if ($user_type==4 || $user_type==5) {
            $_SESSION['type']="registered";
            setcookie(
                "username",
                $user,
                time() + (10 * 365 * 24 * 60 * 60),'/'
            );
          

            header("Location:../routes/registrationstatus.php");
         
        } else {
            echo mysqli_error($conn);

            $_SESSION['type']="volunteer";

            if ($user_type==1) {
                $_SESSION['special']='';
            } elseif ($user_type==2) {
                $_SESSION['special']="secretary";
            } else {
                $_SESSION['special']="blood_manager";
            }
            header("Location:../routes/userboard.php");
        }
        echo mysqli_error($conn);

 }

else{
    echo mysqli_error($conn);


    echo "<script>alert('Invalid Credentials');
    window.location = '../index.php';</script> ";



}
}

else{
    echo mysqli_error($conn);
    echo "<script>alert('No user Exist');
    window.location = '../index.php';</script>";

  
}



