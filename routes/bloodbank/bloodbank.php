<?php 
require('../../backend/utilities.php');
session_start();


?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../../css/bloodbank_landing_page.css" />
    <link rel="stylesheet" href="../../css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
    <title>Blood Bank</title>
  </head>
  <body>
    <!--Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light rounded bg-light mt-3 shadow-sm">
        <a class="navbar-brand" href="../../index.php">
          <img
            src="../../assets/favicon.png"
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
              <a class="nav-link" href="#"
                >Home <span class="sr-only">(current)</span></a
              >
            </li>
          
          </ul>
          <?php 
     
          
          if(isset($_SESSION['type'])){
          

if ($_SESSION['type']=='donor') {
  $path='bloodboard.php';
}
echo '<a class="btn btn-danger my-2 my-sm-0  mx-1" href="' . $path .'">Dashboard</a>';
          }
          else{
          
          ?>


        <a class="btn btn-outline-primary my-2 my-sm-0"  href="sign_in.php">Sign In </a>
            <a class="btn btn-success my-2 my-sm-0  mx-1" href="donorform.php">Register Now</a>
          <?php }?>
            </nav>
    <!--Request Blood Form-->
    <div class="row pt-5 mt-5">
        <div class="col-1"></div>
      <div class="col-5 border pt-3">
        <h6 class="text-center">Request Blood</h6>

       <form method='post' action='../../backend/request_blood.php'>
        <div class="col-10">
          <div class="form-group">
            <label for="inputState">Blood Group</label>
            <select name='bg' id="inputState" class="form-control">
            <?php 
              $blood_g=get_blood();
              foreach ($blood_g as $blood)
          
            echo " <option value=$blood> $blood</option>" 
              ?>
              
            </select>
          </div>
          <div class="form-group">
            <label for="inputAddress">Required Unit</label>
            <input
              type="number"
              class="form-control"
              name='unit'
              id="inputAddress"
              placeholder=""
            />
          </div>
          <div class="form-group">
            <label for="inputAddress">Patient Name</label>
            <input
              type="text"
              name='patient'
              class="form-control"
              id="inputAddress"
              placeholder="Name"
            />
          </div>
          <div class="form-group">
            <label for="inputAddress">Contact No</label>
            <input
            name='contact'
              type="number"
              class="form-control"
              id="inputAddress"
              placeholder="Phone No"
            />
          </div>
          <div class="form-group">
            <label for="inputAddress">Hospital</label>
            <input
              type="text"
              name='hospital'
              class="form-control"
              id="inputAddress"
              placeholder="Hospital Address"
            />
          </div>
          <div class="form-group">
            <label for="inputAddress">Date of requirment</label>
            <input
              type="datetime-local"
              name='dater'
              min='<?php echo  date('Y-m-d')."T".date('h:m') ?>'

              class="form-control"
              id="inputAddress"
              placeholder="Hospital Address"
            />
          </div>
          <div class="form-group">
            <label for="inputAddress">Pincode</label>
            <input
            name='pincode'
              type="number"
              class="form-control"
              id="inputAddress"
              placeholder=""
            />
          </div>

          <button class="btn btn-primary" value='submit' name='submit' type="submit">Request</button>
        </div>
</form>
      </div>
      <div class="col-6">
        <ul id="hexGrid" class="bg-light">
          <li class="hex">
            <a class="hexIn" style="border: 1px solid red" ` href="#">
              <img src="../../assets/bloodbank/blood1.png" alt="" />

              <p class="white">
                Some sample text about the article this hexagon leads to
              </p>
            </a>
          </li>
          <li class="hex">
            <a class="hexIn" href="#">
              <img src="../../assets/bloodbank/onetime.jpeg" alt="" />

              <p class="white">It Doesn’t Have to be a One-Time Gift</p>
            </a>
          </li>
          <li class="hex">
            <a class="hexIn" href="#">
              <img src="../../assets/bloodbank/hur.jpg" alt="" />

              <p class="white">It’s Only an Hour of Your Time</p>
            </a>
          </li>
          <li class="hex">
            <a class="hexIn" href="#">
              <img src="../../assets/favicon.png" alt="" />

              <p class="white">NSS MESM</p>
            </a>
          </li>
          <li class="hex">
            <a class="hexIn" href="#">
              <img src="../../assets/bloodbank/savelife.jpg" alt="" />

              <p class="white">It Saves Lives</p>
            </a>
          </li>
          <li class="hex">
            <a class="hexIn" href="#">
              <img src="../../assets/bloodbank/little.jpg" alt="" />

              <p class="white">There’s Little Pain Involved</p>
            </a>
          </li>
          <li class="hex">
            <a class="hexIn" href="#">
              <img src="../../assets/bloodbank/little.jpg" alt="" />

              <p class="white">There’s Little Pain Involved</p>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </body>
</html>
