<?php 

require('../backend/dbconnect.php');
require('../backend/status.php');
require('../backend/utilities.php');

session_start();



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
    <title>Downloads</title>
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-light rounded bg-light mt-3 shadow-sm">
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
        <button
          class="navbar-toggler"
          type="button"
          data-toggle="collapse"
          data-target="#navbarText"
          aria-controls="navbarText"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="../index.php"
                >Home <span class="sr-only">(current)</span></a
              >
            </li>
            <li class="nav-item">
              <a class="nav-link" href="gallery.php">Gallery</a>
            </li>
            
            <li class="nav-item">
              <a class="nav-link" href="about.php">About</a>
            </li>
          </ul>
         </a>
         <?php
        
        
        if($_SESSION['auth']=="true")
        {
          $path='';
          $path=$_SESSION['type']=='admin'? 'adminboard.php':'userboard.php';
          if($_SESSION['type']=='registered')
          $path='registrationstatus.php';
         echo '<a class="btn btn-danger my-2 my-sm-0  mx-1" href="' . $path .'">Dashboard</a>';
      
 
      
     
        }else{?>
          <a class="btn btn-outline-primary my-2 my-sm-0"  data-toggle="modal" data-target="#myModal" href="routes/signin.html">Sign In</a>
        <a class="btn btn-danger my-2 my-sm-0  mx-1" href="">Blood Bank Service</a>   <?php 
  $reg_status=portal_status('registration');
  if ($reg_status==1)
            echo '<a class="btn btn-success my-2 my-sm-0  mx-1" href="routes/volunteerregister.php">Register Now</a>';
           }?>


            </nav>
    <div class="container">
      <ul class="list-unstyled py-5">


      <?php 
      $downloads=get_downloads();
      if (mysqli_num_rows($downloads)==0) {
        echo "<h3>No Download Files</h3>";
    }      
      else{
          while ($file=mysqli_fetch_assoc($downloads)) {
            $stamp=date("d F Y",strtotime($file['upload_date']));
echo ' <li class="py-2">
<div class="media border p-2 d-flex">
  <img
    src="../assets/document.svg"
    alt="John Doe"
    class="ml-1 mt-1 mb-1 mr-3 rounded"
    style="width: 40px"
  />
  <div class="media-body row align-items-center ">
   <div class="col-12 col-md-10 d-flex flex-wrap align-items-center">
    <h6>'.$file['title'].'<small class="ml-3"><i>Uploaded  on '.$stamp.' </i></small></h6>

   </div>
   <div class="col-12 col-md-2">
   <a href=../assets/downloads/'.$file['path'].' > <button class="btn btn-primary text-wrap " type="button">Download</button></a>
  </div>
</div>
</li>';

          }
      }
      ?>
       
      
      
        
      </ul>
    </div>
  </body>
</html>
