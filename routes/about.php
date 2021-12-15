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
    <title>Abous Us</title>
  </head>
  <body>
    <div class="container py-2">



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
              <a class="nav-link" href="downloads.php">Downloads</a>
            </li>
            
           
          </ul>
         </a>
         <?php
        
        
        if( $_SESSION['auth']=="true")
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
            <h3 class="text-center">Program officers</h3>
<div class="row">       
            <?php
            
            $pos=get_po();
            while ($po=mysqli_fetch_assoc($pos)) {
              if($po['status']==0)
              continue;
              ?>
                   <div class="col my-2">
                <div class="card">
                  <div class="card-body text-center status-card">
                    <h2 class="card-title"> <?php echo  $po['name']?></h2>
                    <h4 class="card-text"><?php echo  "Phone:",$po['phone']?></h4>
                  </div>
                </div>
              </div>
              
              
              
              <?php
            }
            
            
            ?>
            </div>

      <div class="row">
        <p>
          The National Service Scheme (NSS) is a Central Sector Scheme of
          Government of India, Ministry of Youth Affairs & Sports. It provides
          opportunity to the student youth of 11th & 12th Class of schools at +2
          Board level and student youth of Technical Institution, Graduate &
          Post Graduate at colleges and University level of India to take part
          in various government led community service activities &
          programmes.The sole aim of the NSS is to provide hands on experience
          to young students in delivering community service. Since inception of
          the NSS in the year 1969, the number of students strength increased
          from 40,000 to over 3.8 million up to the end of March 2018 students
          in various universities, colleges and Institutions of higher learning
          have volunteered to take part in various community service programmes.
        </p>
      </div>
      <div class="row">
        <div class="media p-3">
          <img
            src="../assets/favicon.png"
            alt="John Doe"
            class="mr-3 mt-3 rounded-circle"
            style="width: 90px"
          />
          <div class="media-body">
            <h4>The NSS Badge Proud to Serve the Nation</h4>
            <p>
              All the youth volunteers who opt to serve the nation through the
              NSS led community service wear the NSS badge with pride and a
              sense of responsibility towards helping needy. The Konark wheel in
              the NSS badge having 8 bars signifies the 24 hours of a the day,
              reminding the wearer to be ready for the service of the nation
              round the clock i.e. for 24 hours. Red colour in the badge
              signifies energy and spirit displayed by the NSS volunteers. The
              Blue colour signifies the cosmos of which the NSS is a tiny part,
              ready to contribute its share for the welfare of the mankind.
            </p>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
