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
    <title>Gallery</title>
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
              <a class="nav-link" href="downloads.php">Downloads</a>
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
<div class="container mt-5">






<?php 
      $pics=get_gallery_images();
      if (mysqli_num_rows($pics)==0) {
        echo "<h3>No Image Files</h3>";
    }      
      else{
          while ($pic=mysqli_fetch_assoc($pics)) {

echo '<a href="../assets/gallery/'.$pic['path'].'"><figure class="figure">
<img src="../assets/gallery/'.$pic['path'].'"  style="width:250px;height:250px;" alt="..." class="figure-img img-thumbnail ">
  <figcaption class="figure-caption text-center">'.$pic['title'].'</figcaption>
</figure></a>
';
          }
      }
      ?>



</div>
  </body>
</html>
