<?php
require('../../backend/dbconnect.php');
require('../../backend/utilities.php');
session_start();
echo $_SESSION['auth'];
 echo $_SESSION['type'];

if ($_SESSION['type']=='donor' && $_SESSION['auth']=="true") {
  ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../../css/bootstrap.min.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="../../js/bootstrap.min.js"></script>
  <title>Donor Profile</title>
</head>

<body>


  <nav class="navbar navbar-expand-lg navbar-light rounded bg-light my-3 shadow-sm">
    <a class="navbar-brand" href="bloodbank.php">
      <img src="../../assets/favicon.png" width="30" height="30" class="d-inline-block align-top" alt=""
        loading="lazy" />
      NSS MESM</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText"
      aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav mr-auto">


      </ul>
      <a class="btn btn-outline-primary my-2 my-sm-0" href="../../backend/logout.php?q=out&u=donor">Log Out</a>



  </nav>
  <div class="card m-3">
    <div class="card-body row">
      <div class="col-lg-4 p-3 d-flex">
        <img src="../../assets/bloodbank/savelife.jpg" alt="John Doe" class="mr-3 mt-3 rounded-circle border"
          style="width: 60px" />
        <div class="">
          <?php 
            $user=get_donor_details($_COOKIE['mob']);
            
            ?>
          <h5>
            Name:
            <?php echo $user['donor_name'] ?>
          </h5>
          <h6>
            Dept:
            <?php echo $user['dept'] ?>
          </h6>
        </div>
      </div>


    </div>
  </div>

  <h1 class="text-center">Update Last donate</h1>
  <form action="../../backend/update_last_donate.php?q=<?php echo $user['donor_id'];?>" method="post">
    <div class="col-5">
      <div class="form-group ">
        <label for="eventDay">New last donate date</label>
        <input type="date" class="form-control" min="<?php echo date("Y-m-d",strtotime($user['next_donate'])); ?>"
          id="eventDay" name="l_date" placeholder="" />
      </div>
      <button class="btn btn-primary" type="submit">Update</button>
    </div>
  </form>





  <h1 class="text-center">Update Contact</h1>
  <form action="../../backend/update_donor_contact.php?q=<?php echo $user['donor_id'];?>" method="post">
    <div class="col-5">
      <div class="form-group ">
        <label for="eventDay">New Mobile no</label>
        <input type="number" class="form-control" id="eventDay" name="mobile" value="<?php echo $user['mobile_no']?>"
          placeholder="" />
      </div>
      <button class="btn btn-primary" type="submit">Update</button>
    </div>
  </form>

  </div>
</body>

</html>

<?php

}
else{
  header("Location:../../index.php");
  ?>

<?php } ?>