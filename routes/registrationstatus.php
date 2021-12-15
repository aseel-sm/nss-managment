<?php   
require('../backend/dbconnect.php');
require('../backend/utilities.php');
require('../backend/status.php');
$user_type=get_user_type($_COOKIE['username']);
$portal_status=portal_status('enrollment');
$r_portal_status=portal_status('registration');
$message='';


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <title>Registration Status</title>
  </head>
  <body>


  <nav class="navbar navbar-expand-lg navbar-light rounded bg-light mt-3 shadow-sm mb-5">
        <a class="navbar-brand" href="#">
          <img
            src="../assets/favicon.png"
            width="30"
            height="30"
            class="d-inline-block align-top"
            alt=""
            loading="lazy"
          />
          NSS MESM</a
        >
        
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="../index.php"
                >Home</a
              >
            </li>
           
            <li class="nav-item ">
            <a class="btn btn-outline-primary my-2 my-sm-0"  href="../backend/logout.php?q=out">Log Out</a>

            </li>
           
          </ul>
         </a>
            </nav>


  <?php 
echo $r_portal_status,$portal_status,$user_type;
if($r_portal_status==1){
  echo "<h4>Please wait for selection</h4>";

}
 else if($user_type==5 && $portal_status==1){
echo '  <a class="btn btn-danger my-2 my-sm-0 mx-1" href="../routes/enrollment.php">Enrollment</a>';

  }
  else if($user_type==4 && $portal_status==1 ){
    echo "<h4>No selection</h4>";
    
  }
  else{
    echo "<h4>Please wait for selection</h4>";
    
   $_SESSION['auth']='';
   $_SESSION['type']='';


  }
  ?>
  
  </body>
</html>
