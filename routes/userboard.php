<?php
require('../backend/dbconnect.php');
require('../backend/utilities.php');
session_start();


if ($_SESSION['type']!='volunteer' || $_SESSION['auth']!="true") {
    header("Location:../index.php");
 
}
else{

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>User</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <style>
.status-card{
  background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(27,58,168,1) 0%, rgba(0,212,255,1) 100%);  color:white;
}

</style>
  </head>
  <body>
    <div class="container my-5">

    <nav class="navbar navbar-expand-lg navbar-light rounded bg-light my-3 shadow-sm">
        <a class="navbar-brand" href="../">
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
           
            <li class="nav-item">
              <a class="nav-link" href="../routes/gallery.php">Gallery</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../routes/downloads.php">Downloads</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../routes/about.php">About</a>
            </li>
          </ul>
        <a class="btn btn-outline-primary my-2 my-sm-0"  href="../backend/logout.php?q=out">Log Out</a>
        
            <?php if(isset($_SESSION['special']))
        {
          if($_SESSION['special']=='secretary' || $_SESSION['special']=='blood_manager'){ ?>
                  <a class="btn btn-danger my-2 my-sm-0  mx-1" href="bloodbank/bloodbank.php">Blood Bank Service</a>    

         <?php  }
        }?>

            </nav>
      <div class="card">
        <div class="card-body row">
          <div class="col-lg-4 p-3 d-flex">
            <img
              src="../assets/favicon.png"
              alt="John Doe"
              class="mr-3 mt-3 rounded-circle"
              style="width: 60px"
            />
            <div class="">
            <?php 
            $user=get_user_details($_COOKIE['username']);
            
            ?>
              <h5>Name: <?php echo $user['name'] ?></h5>
              <h6>Dept: <?php echo $user['dept'] ?> </h6>
              <h6>Enrollment ID: ENRNO<?php echo $user['id'] ?></h6>
            </div>
          </div>
          <div class="col my-2">
                <div class="card">
                  <div class="card-body text-center status-card">
                    <h5 class="card-title"> Total Hour</h5>
                    <h1 class="card-text"><?php echo user_hour($user['id']);?></h1>
                  </div>
                </div>
              </div>
         
        </div>
      </div>

      <?php if(isset($_SESSION['special']))
        {
          if($_SESSION['special']=='secretary'){ ?>
    <form action='attendence.php' method='post' class="form-inline my-2 mx-2 my-lg-0">
      <input
        list="eventid"
        class="form-control"
        id="eventsid"
        name="eventid"
        placeholder="ID"
      />
      <datalist id="eventid">
      <?php   $event=get_events();
                      if (mysqli_num_rows($event)>0) {
                          while ($row=mysqli_fetch_assoc($event)) {
                              ?>
                      <option value="<?php echo $row['id']?>"><?php echo $row['name']?></option>
                      <?php
                          }
                      }
     ?>
      </datalist>
      <button class="btn btn-outline-success my-2 mx-1 my-sm-0" type="submit">
        Search
      </button>
    </form>
         <?php  }
        }?>



  
      <div class="row my-5">
        <div class="col-md-3 pt-2 border">
          <div
            class="nav flex-md-column nav-pills"
            id="v-pills-tab"
            role="tablist"
            aria-orientation="horizontal"
          >
            <a
              class="nav-link active"
              id="v-pills-home-tab"
              data-toggle="pill"
              href="#v-pills-attendence"
              role="tab"
              aria-controls="v-pills-home"
              aria-selected="true"
              >Attendence</a
            >
            <a
              class="nav-link"
              id="v-pills-profile-tab"
              data-toggle="pill"
              href="#v-pills-profile"
              role="tab"
              aria-controls="v-pills-profile"
              aria-selected="false"
              >Profile</a
            >
            <a
              class="nav-link"
              id="v-pills-messages-tab"
              data-toggle="pill"
              href="#v-pills-requests"
              role="tab"
              aria-controls="v-pills-messages"
              aria-selected="false"
              >Leave Request</a
            >
            <a
              class="nav-link"
              id="v-pills-notifications-tab"
              data-toggle="pill"
              href="#v-pills-notifications"
              role="tab"
              aria-controls="v-pills-notifications"
              aria-selected="false"
              >Notification</a
            >
          </div>
        </div>
        <div class="col-md-9 pt-2 border">
          <div class="tab-content" id="v-pills-tabContent">
            <!--Attendence-->
            <div
              class="tab-pane fade show active"
              id="v-pills-attendence"
              role="tabpanel"
              aria-labelledby="v-pills-home-tab"
            >
              <div class="table-responsive">
                <table class="table  table-bordered">
                  <thead class="thead-light">
                    <tr>
                      <th>Event</th>
                      <th>Date</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <?php 
                  
                  $events=get_valid_events();
                  
                  ?>
                  <tbody>
                  <?php 
                  
                  while($event=mysqli_fetch_assoc($events)){
                    $status=is_absent($event['id'],$user['id']);
$status=$status==0?"&#9989;":"&#10060;";

echo " <tr><td>".$event['name']."</td><td>".$event['start_date']."</td><td>".$status."</td></tr>";
                  }

                  ?>
                   
         
                  </tbody>
                  <tfoot></tfoot>
                </table>
              </div>
            </div>

            <!--Profile-->
            <div
              class="tab-pane fade"
              id="v-pills-profile"
              role="tabpanel"
              aria-labelledby="v-pills-profile-tab"
            >

            <h6>Gender: <?php echo $user['name'] ?></h6>
            <h6>Guadian Name: <?php echo $user['guardian_name'] ?> </h6>
            <h6>Date of Birth: <?php echo $user['dob'] ?> </h6>
            <h6>Community: <?php echo $user['community'] ?> </h6>
            <h6>Mobile No: <?php echo $user['mobile_no'] ?> </h6>
            <h6>Email: <?php echo $user['email'] ?> </h6>
            <h6>Place: <?php echo $user['place'] ?> </h6>
            <h6>PINCODE: <?php echo $user['pincode'] ?> </h6>
            <h6>Blood Group: <?php echo $user['blood_group'] ?> </h6>
            <h4 class="border my-3 py-2 text-center rounded bg-primary"> Edit Profile</h4>
<form class="my-5" action="../backend/update_user.php?q=<?php echo $user['username'] ?>" method='post'>
<div class="form-group col-md-6">
            <label for="inputPh">Mobile</label>
            <input
              type="number"
              class="form-control"
              id="inputPh"
              name='mobile'
              value="<?php echo $user['mobile_no'] ?>"
              placeholder="Mobile"
             
             
            />
          </div>

          <div class="form-group col-md-6">
            <label for="inputEmail">Email</label>
            <input
              type="email"
              class="form-control"
              id="inputEmail"
              name='mail'
              value="<?php echo $user['email'] ?>"
              placeholder="Email"
             
             
            />
          </div>
          <button class="btn btn-primary" type="submit" >Update</button>
              </form>
            </div>

            <!--Leave Request-->
            <div
              class="tab-pane fade"
              id="v-pills-requests"
              role="tabpanel"
              aria-labelledby="v-pills-messages-tab"
            >
            <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
          <a
            class="nav-link active"
            id="leave_view-tab"
            data-toggle="tab"
            href="#leave_view"
            role="tab"
            aria-controls="leave_view"
            aria-selected="true"
            >Requests</a
          >
        </li>
        <li class="nav-item" role="presentation">
          <a
            class="nav-link"
            id="leave_apply-tab"
            data-toggle="tab"
            href="#leave_apply"
            role="tab"
            aria-controls="leave_apply"
            aria-selected="false"
            >Apply</a
          >
        </li>
      </ul>
   <div class="tab-content" id="myTabContent">
      <div
        class="tab-pane fade show active"
        id="leave_view"
        role="tabpanel"
        aria-labelledby="leave_view-tab"
      >
        <input
          class="form-control"
          id="myLeave"
          type="text"
          placeholder="Search.."
        />
        <br />
        <?php 
        $leaves=get_leave($user['id']);
        if(mysqli_num_rows($leaves)==0)
        echo "<h1>No request</h1>";
        else {
        ?>
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Event</th>
              <th>Reason</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody id="myLeaveTable">
            <?php 
            while ($leave=mysqli_fetch_assoc($leaves)) {
                echo "    <tr>
          <td>".$leave['name']."</td>
          <td>".$leave['reason']."</td>
          <td>";
            

                if ($leave['status']==null) {
                    echo '<button class="btn btn-info" type="button">Waiting</button> ';
                } elseif ($leave['status']==0) {
                    echo '                <button class="btn btn-danger" type="button">Declined</button> ';
                } else {
                    echo '                <button class="btn btn-success" type="button">Approved</button> ';
                } ?>
         
              </td>
            </tr>
     
        <?php
            } }?>
          </tbody>
        </table>
      </div>
      <div
        class="tab-pane fade"
        id="leave_apply"
        role="tabpanel"
        class=''
        aria-labelledby="leave_apply-tab"
      >
        <form class='py-3' method='post' action="../backend/leave_req.php">


        <input type="text" hidden   class="form-control" name='userid' value="<?php echo $user['id'] ?>" id="" />

<div class="form-group col-md-6 py-3">

         
<input
        list="eventid"
        class="form-control"
        id="eventsid"
        name="eventid"
        placeholder="ID"
      />
      <datalist id="eventid">
      <?php   $event=get_events();
                      if (mysqli_num_rows($event)>0) {
                          while ($row=mysqli_fetch_assoc($event)) {
                              ?>
                      <option value="<?php echo $row['id']?>"><?php echo $row['name']?></option>
                      <?php
                          }
                      }
     ?>
      </datalist>
</div>
            <div class="form-group col-md-10">
              <label for="reason">Reason</label>
              <input type="text" class="form-control" name='reason' id="reason" />
            </div>
            <button class="btn btn-primary" type="submit" name='submit' value='submit'>Apply leave</button>
       
        </form>
      </div>
      </div>
            </div>
            <div
              class="tab-pane fade"
              id="v-pills-notifications"
              role="tabpanel"
              aria-labelledby="v-pills-settings-tab">


              <div class="table-responsive">
              <input class="form-control" id="notificationInput" type="text" placeholder="Search.." />
              <br />

              <?php 
      $notifications=get_notification();
      if (mysqli_num_rows($notifications)==0) {
        echo "<h3>No Notification </h3>";
    }      
      else{?>
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>Title</th>
                    <th>Time</th>
                    <th>Description</th>
                    
                  </tr>
                </thead>
                <tbody id="myNotification">
                  <?php

          while ($notification=mysqli_fetch_assoc($notifications)) {
            
echo '
<tr >
  <td>'.$notification['title'].'
  </td>
  <td>'.date("d F Y",strtotime($notification['notification_time'])).'
  </td>
 
  <td>'.$notification['description'].'
  </td>
 
  ';?>

                 <?php
          }
      }
      ?>




                </tbody>
              </table>
            </div>
    
</div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script>
      $(document).ready(function () {
        $("#myLeave").on("keyup", function () {
          var value = $(this).val().toLowerCase();
          $("#myLeaveTable tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
          });
        });
      });
    </script>
      <script src="../js/jquery.autoscroll.js"></script>

  </body>
</html>
<?php }?>