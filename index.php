<?php

require('backend/dbconnect.php');
require('backend/utilities.php');
require('backend/status.php');
session_start();


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <link rel="icon" href="assets/favicon.png" type="image/x-icon" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <link rel="stylesheet" href="css/bootstrap.min.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="css/style.css">
  <title>Welcome</title>


  <style>
    .login-form {
      width: 340px;
      margin: 50px auto;
    }

    .login-form form {
      margin-bottom: 15px;
      background: #f7f7f7;
      box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
      padding: 30px;
    }

    .login-form h2 {
      margin: 0 0 15px;
    }

    .form-control,
    .btn {
      min-height: 38px;
      border-radius: 2px;
    }

    .input-group-addon .fa {
      font-size: 18px;
    }

    .btn {
      font-size: 15px;
      font-weight: bold;
    }

    .bottom-action {
      font-size: 14px;
    }
  </style>



</head>

<body>



  <div class="container">
    <!-- Image and text -->
    <nav class="navbar navbar-expand-lg navbar-light rounded bg-light mt-3 shadow-sm">
      <a class="navbar-brand" href="#">
        <img src="assets/favicon.png" width="30" height="30" class="d-inline-block align-top" alt="" loading="lazy" />
        NSS MESM</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText"
        aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="routes/gallery.php">Gallery</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="routes/downloads.php">Downloads</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="routes/about.php">About</a>
          </li>
        </ul>

        <?php
        
       
       if (isset($_SESSION['auth'])) {
           if ($_SESSION['auth']=="true") {
               $path='';
               $path=$_SESSION['type']=='admin'? 'routes/adminboard.php':'routes/userboard.php';
               if ($_SESSION['type']=='registered') {
                   $path='routes/registrationstatus.php';
               }
            
               echo '<a class="btn btn-danger my-2 my-sm-0  mx-1" href="' . $path .'">Dashboard</a>';
           }
       } else {?>
        <a class="btn btn-outline-primary my-2 my-sm-0" data-toggle="modal" data-target="#myModal"
          href="routes/signin.html">Sign In</a>
        <a class="btn btn-danger my-2 my-sm-0  mx-1" href="routes/bloodbank/bloodbank.php">Blood Bank Service</a> <?php
  $reg_status=portal_status('registration');
  if ($reg_status==1) {
      echo '<a class="btn btn-success my-2 my-sm-0  mx-1" href="routes/volunteerregister.php">Register Now</a>';
  }
           }?>

      </div>
    </nav>


    <div class="row py-5">
      <div class="col">
        <ul class="data-list list-group" data-autoscroll>
          <h5 class="text-center">Events</h5>

          <?php
$events=get_events();
if (mysqli_num_rows($events)==0) {
    echo "<h3>No Events</h3>";
} else {
    while ($event=mysqli_fetch_assoc($events)) {
        echo '
<li class="list-group-item my-2 border border-info">
 <div class="media  p-1 d-flex">
<img
src="assets/calendar.svg"
alt="NIL"
class=" mt-1 mb-1 mr-2 rounded"
style="width: 30px"
/>
<div class="media-body row align-items-center ">
<div class="col-12   align-items-center">
<h5>'.$event['name'].'</h5>
<h6>'.$event['description'].'</h6>
<h6>Venue:'.$event['venue'].'</h6>
<h6>'.date("d F Y", strtotime($event['start_date'])).'</h6>
</div>

</div></div>
      
  </li>';
    }
}
?>


        </ul>
      </div>
      <div class="col mt-4 mt-md-0">

        <ul class="data-list " data-autoscroll>
          <h5 class="text-center">Notifications</h5>

          <?php
$notifications=get_notification();
if (mysqli_num_rows($notifications)==0) {
    echo "<h3>No Notification</h3>";
} else {
    $i=0;
    while ($notification=mysqli_fetch_assoc($notifications)) {
        if ($notification['category']=='public') {
            echo '
<li class="list-group-item my-2 border border-info">
 <div class="media  p-1 d-flex">
<img
src="assets/notification.svg"
alt="NIL"
class=" mt-1 mb-1 mr-2 rounded"
style="width: 30px"
/>
<div class="media-body row align-items-center ">
<div class="col-12   align-items-center">
<h5>'.$notification['title'].'</h5>
<h6>'.$notification['description'].'</h6>
<h6>Time:'.date("d F Y h:m:s", strtotime($notification['notification_time'])).'</h6>
</div>

</div></div>
      
  </li>';
            $i++;
        }
    }
    if ($i==0) {
        echo "<h3>No Notification</h3>";
    }
}
?>
        </ul>
      </div>
    </div>





    <section>










    </section>
  </div>
  <footer class="text-center bg-secondary text-white">NSS Unit MES College Marampally</footer>

  <!--Modal-->
  <div class="modal fade" id="myModal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <div class="login-form">
            <form action="backend/login.php" method="post">
              <h2 class="text-center">Sign In</h2>
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <span class="fa fa-user"></span>
                    </span>
                  </div>
                  <input type="text" class="form-control" placeholder="Username" required="required" name="username" />
                </div>
              </div>
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="fa fa-lock"></i>
                    </span>
                  </div>
                  <input type="password" class="form-control" placeholder="Password" required="required"
                    name="password" />
                </div>
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">
                  Log in
                </button>
              </div>
            </form>
          </div>
        </div>



      </div>
    </div>
  </div>
  <script src="js/jquery.autoscroll.js"></script>
</body>

</html>