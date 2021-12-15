<?php
require('../backend/dbconnect.php');
require('../backend/status.php');
require('../backend/utilities.php');


session_start();


if ($_SESSION['type']!='admin' && $_SESSION['auth']!==true) {
    header("Location:../index.php");
 
}
else{
 
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin</title>
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

<body style="background-color:">
  <div class="container my-1">
    <!--Navbar-->
    <nav class="navbar navbar-expand-lg navbar-light rounded bg-light my-3 shadow-sm">
      <a class="navbar-brand" href="../">
        <img src="../assets/favicon.png" width="30" height="30" class="d-inline-block align-top" alt=""
          loading="lazy" />
        NSS MESM</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText"
        aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
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
            <a class="nav-link" href="../routes/about.html">About</a>
          </li>
        </ul>
        <a class="btn btn-outline-primary my-2 my-sm-0" href="../backend/logout.php?q=out">Log Out</a>
        <a class="btn btn-danger my-2 my-sm-0  mx-1" href="bloodbank/adminboard.php">Blood Bank Service</a>

    </nav>
    <div class="row">
      
      <button class="btn btn-success" data-toggle="modal" data-target="#addDoc" type="button">
        Add Document
      </button>



      <button class="btn btn-success ml-1" data-toggle="modal" data-target="#addPhoto" type="button">
        Add Photo
      </button>







      <!--Add Document-->
      <div class="modal fade" id="addDoc">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add Doc</h4>
              <button type="button" class="close" data-dismiss="modal">
                &times;
              </button>
            </div>

            <div class="modal-body">
              <form action="../backend/upload_doc.php" method='post' enctype="multipart/form-data">
                <!--Title-->
                <div class="form-group">
                  <label for="docTitle">Title</label>
                  <input type="text" class="form-control" name="docTitle" id="docTitle" />
                </div>
                <!--FIle-->
                <div class="form-group">
                  <label for="docFile">File</label>
                  <input type="file" class="form-control" name="docFile" id="docFile" />
                </div>
                <button class="btn btn-primary" value="submit" name="upload_doc" type="submit">Add</button>
              </form>
            </div>
          </div>
        </div>
      </div>

      <!--Add Photo-->
      <div class="modal fade" id="addPhoto">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add Photo</h4>
              <button type="button" class="close" data-dismiss="modal">
                &times;
              </button>
            </div>

            <div class="modal-body">
              <form action="../backend/upload_gallery.php" method='post' enctype="multipart/form-data">
                <!--Title-->
                <div class="form-group">
                  <label for="photoTitle">Title</label>
                  <input type="text" class="form-control" name='title' id="photoTitle" />
                </div>
                <!--FIle-->
                <div class="form-group">
                  <label for="photoFile">Photo</label>
                  <input type="file" class="form-control" name="gallery_image" id="photoFile" />
                </div>
                <button class="btn btn-primary" value="upload" name="upload_image" type="submit">Add</button>
              </form>
            </div>
          </div>
        </div>
      </div>

      <!--Notifcation-->
      <div>
        <button type="button" class="btn btn-primary ml-1" data-toggle="modal" data-target="#myNotification">
          Add Notification
        </button>

        <!-- The Notification Model -->
        <div class="modal fade" id="myNotification">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Add Notification</h4>
                <button type="button" class="close" data-dismiss="modal">
                  &times;
                </button>
              </div>

              <!-- Category -->
              <div class="modal-body">
                <form action="../backend/add_notification.php" method='post'>
                  <div class="form-group">
                    <label for="inputState">Category</label>
                    <select id="inputState" name="category" class="form-control">

                      <option value="public">Public</option>
                      <option value="unit">Unit</option>
                    </select>
                  </div>

                  <!--Title-->
                  <div class="form-group">
                    <label for="inputZip">Title</label>
                    <input type="text" name="title" class="form-control" id="inputZip" />

                  </div>
                  <!--Content-->
                  <div class="form-group">
                    <label for="inputZip">Description</label>
                    <textarea class="form-control" name="description" id="exampleFormControlTextarea1"
                      rows="3"></textarea>

                  </div>
                  <button class="btn btn-primary" type="submit" name="submit">Add</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
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
    </div>
 

    <div class="row my-5">
      <div class="col-md-3 pt-2 border">
        <div class="nav flex-md-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="horizontal">
          <a class="nav-link active"  id="v-pills-home-tab" data-toggle="pill" href="#v-pills-status" role="tab"
            aria-controls="v-pills-home" aria-selected="true">Status</a>

          <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-requests" role="tab"
            aria-controls="v-pills-messages" aria-selected="false">Requests</a>
          <a class="nav-link" id="v-pills-volunteers-tab" data-toggle="pill" href="#v-pills-volunteers" role="tab"
            aria-controls="v-pills-volunteers" aria-selected="false">Volunteers</a>
          <a class="nav-link" id="v-pills-add_data-tab" data-toggle="pill" href="#v-pills-add_data" role="tab"
            aria-controls="v-pills-add_data" aria-selected="false">Downloads and gallery</a>
          <a class="nav-link" id="v-pills-notification-tab" data-toggle="pill" href="#v-pills-notification" role="tab"
            aria-controls="v-pills-notification" aria-selected="false">Notification</a>
          <a class="nav-link" id="v-pills-events-tab" data-toggle="pill" href="#v-pills-events" role="tab"
            aria-controls="v-pills-events" aria-selected="false">Events</a>
          <a class="nav-link" id="v-pills-portal-tab" data-toggle="pill" href="#v-pills-portal" role="tab"
            aria-controls="v-pills-portal" aria-selected="false">Portal Status</a>
          <a class="nav-link" id="v-pills-others-tab" data-toggle="pill" href="#v-pills-others" role="tab"
            aria-controls="v-pills-others" aria-selected="false">Others</a>
        </div>
      </div>
      <div class="col-md-9 pt-2 border">
        <div class="tab-content" id="v-pills-tabContent">
          <!--Status-->
          <div class="tab-pane fade show active" id="v-pills-status" role="tabpanel" aria-labelledby="v-pills-home-tab">
          <div class="row row-cols-1 p-3 row-cols-sm-3">
              <div class="col my-2">
                <div class="card">
                  <div class="card-body text-center status-card">
                    <h5 class="card-title"> Volunteers</h5>
                    <h1 class="card-text"><?php echo get_unit_status1();?></h1>
                  </div>
                </div>
              </div>
              <div class="col my-2">
                <div class="card">
                  <div class="card-body text-center status-card">
                    <h5 class="card-title"> Event</h5>
                    <h1 class="card-text"><?php echo get_unit_status2();?></h1>
                  </div>
                </div>
              </div>
              <div class="col my-2">
                <div class="card">
                  <div class="card-body text-center status-card">
                    <h5 class="card-title"> Donors</h5>
                    <h1 class="card-text"><?php echo get_unit_status3();?></h1>
                  </div>
                </div>
              </div>
              <div class="col my-2">
                <div class="card">
                  <div class="card-body text-center status-card">
                    <h5 class="card-title"> Notifications</h5>
                    <h1 class="card-text"><?php echo get_unit_status4();?></h1>
                  </div>
                </div>
              </div>
              <div class="col my-2">
                <div class="card">
                  <div class="card-body text-center status-card">
                    <h5 class="card-title"> B.Request to satisfy</h5>
                    <h1 class="card-text"><?php echo get_unit_status5();?></h1>
                  </div>
                </div>
              </div>
              <div class="col my-2">
                <div class="card">
                  <div class="card-body text-center status-card">
                    <h5 class="card-title"> B.Request to verify</h5>
                    <h1 class="card-text"><?php echo get_unit_status6();?></h1>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!--Requests-->
          <div class="tab-pane fade" id="v-pills-requests" role="tabpanel" aria-labelledby="v-pills-profile-tab">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item" role="presentation">
                <a class="nav-link active" id="leave-tab" data-toggle="tab" href="#leave" role="tab"
                  aria-controls="leave" aria-selected="false">Leave</a>
              </li>
             
            </ul>
            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active" id="leave" role="tabpanel" aria-labelledby="leave-tab">
              <input class="form-control" id="myLeave" type="text" placeholder="Search..">
  <br>
  <?php 
        $leaves=get_all_leave();
        if(mysqli_num_rows($leaves)==0)
        echo "<h1>No request</h1>";
        else {
        ?>
              <table class="table table-light">
                  <thead class="thead-light">
                    <tr>
                      <th>Name</th>
                      <th>Event</th>
                     
                      <th>Reason</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody id="myLeaveTable">
                  <?php 
            while ($leave=mysqli_fetch_assoc($leaves)) {
                echo "    <tr>
          <td>".$leave['vname']."</td>
          <td>".$leave['name']."</td>
          <td>".$leave['reason']."</td>
          <td>";
                if ($leave['status']==null) {

?>
<a href="../backend/handle_leave?i=<?php echo $leave['id']?>&s=1"><button class="btn btn-success" type="button">
                          Accept</button></a>
<a href="../backend/handle_leave?i=<?php echo $leave['id']?>&s=0"><button class="btn btn-danger" type="button">
                          Decline</button></a>



<?php





                 
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
              <div class="tab-pane fade" id="blood" role="tabpanel" aria-labelledby="blood-tab">
            
              </div>
            </div>
          </div>

          <!--Volunteers-->
          <div class="tab-pane fade" id="v-pills-volunteers" role="tabpanel" aria-labelledby="v-pills-volunteers-tab">
            <!--Volunteer table-->
          




            <div class="table-responsive">
              <input class="form-control" id="myInput" type="text" placeholder="Search.." />
              <br />

              <?php 
      $volunteers=get_volunteers();


      
      if (mysqli_num_rows($volunteers)==0) {
        echo "<h3>No Volunteers </h3>";
    }      
      else{?>
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Volunteer Name</th>
                    <th>Dept</th>
                    <th>Total hour</th>
                    <th>Contact</th>
                  </tr>
                </thead>
                <tbody id="myTable">
                  <?php
                while ($volunteer=mysqli_fetch_assoc($volunteers)) {




    if($volunteer['is_active']==1){
      echo '<tr>
      <td>'.$volunteer['id'].'</td>
      <td>'.$volunteer['name'].'</td>
      <td>'.$volunteer['dept'].'</td>
      <td>'.user_hour($volunteer['id']).'</td>
      <td>'.$volunteer['mobile_no'].'</td>
      </tr>';
    }
                }}
?>
                 
                </tbody>
              </table>
            </div>
          </div>
          <!--Add data and foto-->
          <div class="tab-pane fade show" id="v-pills-add_data" role="tabpanel" aria-labelledby="v-pills-home-tab">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item" role="presentation">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#downloads" role="tab"
                  aria-controls="home" aria-selected="true">Downloads</a>
              </li>
              <li class="nav-item" role="presentation">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#gallery" role="tab"
                  aria-controls="profile" aria-selected="false">Gallery</a>
              </li>
            </ul>
            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active" id="downloads" role="tabpanel" aria-labelledby="home-tab">
                <!--Downloads Table-->
                <div class="table-responsive">
                  <input class="form-control" id="downloadInput" type="text" placeholder="Search.." />
                  <br />
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>Title</th>
                        <th>Time</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody id="myDownloads">
                      <?php 
      $downloads=get_downloads();
      if (mysqli_num_rows($downloads)==0) {
        echo "<h3>No Download Files</h3>";
    }      
      else{
          while ($file=mysqli_fetch_assoc($downloads)) {
            $stamp=date("d F Y",strtotime($file['upload_date']));
$did="D_".$file['id'];
echo '<tr id="'.$did.'" >
<td>'.$file['title'].'</td>
<td>'.$stamp.'</td>
<td>';?>

                      <button class="btn btn-danger" onclick="deleteRow('<?php echo $did?>')" type="button">
                        Delete
                      </button>
                      </td>
                      </tr><?php
          }
      }
      ?>



                    </tbody>
                  </table>
                </div>
              </div>
              <div class="tab-pane fade" id="gallery" role="tabpanel" aria-labelledby="profile-tab">
                <!--Gallery Table-->
                <div class="table-responsive">
                  <input class="form-control" id="galleryInput" type="text" placeholder="Search.." />
                  <br />
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>Title</th>
                        <th>Time</th>

                      </tr>
                    </thead>
                    <tbody id="myGallery">
                      <?php 
      $pics=get_gallery_images();
      if (mysqli_num_rows($pics)==0) {
        echo "<h3>No Image Files</h3>";
    }      
      else{
          while ($pic=mysqli_fetch_assoc($pics)) {

$gid="G_".$pic['id'];
echo '<tr id="'.$gid.'">
<td>'.$pic['title'].'</td>
<td>';?>

                      <button class="btn btn-danger" onclick="deleteRow('<?php echo $gid?>')" type="button">
                        Delete
                      </button>
                      </td>
                      </tr><?php
          }
      }
      ?>





                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <!--Notification-->
          <div class="tab-pane fade show" id="v-pills-notification" role="tabpanel" aria-labelledby="v-pills-home-tab">
            <!--Notification table-->
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
                    <th>Category</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody id="myNotification">
                  <?php

          while ($notification=mysqli_fetch_assoc($notifications)) {
            $nid='N_'.$notification['id'];
echo '
<tr id="'.$nid.'">
  <td>'.$notification['title'].'
  </td>
  <td>'.date("d F Y  ",strtotime($notification['notification_time'])).'
  </td>
 
  <td>'.$notification['description'].'
  </td>
  <td>'.$notification['category'].'
  </td>
  <td>';?>

                  <button class="btn btn-danger" onclick="deleteRow('<?php echo $nid?>')" type="button">
                    Delete
                  </button>
                  </td>
                  </tr> <?php
          }
      }
      ?>




                </tbody>
              </table>
            </div>
          </div>
          <!--Event-->
          <div class="tab-pane fade show" id="v-pills-events" role="tabpanel" aria-labelledby="v-pills-home-tab">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item" role="presentation">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#viewEvents" role="tab"
                  aria-controls="home" aria-selected="true">View</a>
              </li>
              <li class="nav-item" role="presentation">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#addEvents" role="tab"
                  aria-controls="addEvents" aria-selected="false">Add</a>
              </li>
            </ul>
            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active" id="viewEvents" role="tabpanel" aria-labelledby="home-tab">
                <!--View Events-->
                <div class="table-responsive">
                  <input class="form-control" id="eventsInput" type="text" placeholder="Search.." />
                  <br />

                  <?php 
      $events=get_events();
      if (mysqli_num_rows($events)==0) {
        echo "<h3>No Events </h3>";
    }      
      else{?>
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Hours</th>
                        <th>Action</th>

                      </tr>
                    </thead>
                    <tbody id="myEvents">
                      <?php

          while ($event=mysqli_fetch_assoc($events)) {
            if($event['is_valid']==0)
            continue;
              $eid='EV_'.$event['id'];
              echo '
<tr   id="'.$eid.'">
  <td>'.$event['name'].'
  </td>
  <td>'.date("d F Y", strtotime($event['start_date'])).'
  </td>
  <td>'.date("d F Y", strtotime($event['end_date'])).'
  </td>
  <td>'.$event['total_hour'].'
  </td>
  <td>'?>

                     <a href="../backend/delete_event.php?id=<?php echo $event['id'] ?>"> <button class="btn btn-danger"  type="button">
                        Delete
                      </button></a>
                      </td>
                      </tr><?php
          }
        }
      ?>


                    </tbody>
                  </table>
                </div>
              </div>
              <div class="tab-pane fade" id="addEvents" role="tabpanel" aria-labelledby="profile-tab">
                <!--Add Events-->
                <form action="../backend/add_events.php" method="post">
                  <div class="form-group">
                    <label for="eventTitle">Name</label>
                    <input type="text" class="form-control" id="eventTitle" name="name" placeholder="Name" />
                  </div>
                  <div class="form-group">
                    <label for="eventDay">Start date</label>
                    <input type="date" class="form-control" min="<?php echo date("Y-m-d"); ?>" id="eventDay" name="s_date" placeholder="" />
                  </div>
                  <div class="form-group">
                    <label for="eventDay"> End Date</label>
                    <input type="date" class="form-control" min="<?php echo date("Y-m-d"); ?>" id="eventDay" name="e_date" placeholder="" />
                  </div>
                  <div class="form-group">
                    <label for="eventDay">Description</label>
                    <input type="text" class="form-control" id="eventDay" name="desc" placeholder="Description" />
                  </div>
                  <div class="form-group">
                    <label for="eventDay">Venue</label>
                    <input type="text" class="form-control" id="eventDay" name="ven" placeholder="Venue" />
                  </div>
                  <div class="form-group">
                    <label for="eventDay">Hour</label>
                    <input type="number" class="form-control" id="eventDay" name="hour" placeholder="Hour" />
                  </div>
                  <button class="btn btn-primary" type="submit" name="submit" value="add_ev">Add</button>
                </form>
              </div>
            </div>
          </div>
          <!--Status-->
          <div class="tab-pane fade show" id="v-pills-portal" role="tabpanel" aria-labelledby="v-pills-home-tab">
            <div>
              <?php $enr_status=portal_status('enrollment');
      $reg_status=portal_status('registration');
      $r=$reg_status==0?'success':'danger';
      $e=$enr_status==0?'success':'danger';
      $eb=$enr_status==0?'Turn On':'Turn Off';
      $rb=$reg_status==0?'Turn On':'Turn Off';

      ?>

              Registration: <button id="set_reg_status" class="btn btn-<?php echo $r ?> mx-2" type="button"
                value="<?php echo $reg_status ?>"><?php echo $rb ?></button>
            </div>
            <div class="py-3">
              Enrollment: <button id="set_enr_status" class="btn btn-<?php echo $e ?> mx-2" type="button"
                value="<?php echo $enr_status ?>"><?php echo $eb ?></button>
            </div>
            <div class="py-3">
               <button id="update_academic" onclick="updateAcademic()" class="btn btn-danger mx-2" type="button"
              >Update Academic Year</button>
            </div>
            <?php 
            if($reg_status==1){
            ?>
            <div class="py-3">
            <a class="btn btn-success my-2 my-sm-0  mx-1" href="set_enrollment.php">Set Enrollment</a>

            </div>
      <?php }?>
          </div>
          
          <!--Other-->


          <div class="tab-pane fade show" id="v-pills-others" role="tabpanel" aria-labelledby="v-pills-home-tab">
      

          <ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Department</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Add Department</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">PO</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#add_po" role="tab" aria-controls="contact" aria-selected="false">Add PO</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#special_status" role="tab" aria-controls="contact" aria-selected="false">Special Status</a>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">  <?php   $depts=get_dept();
  if (mysqli_num_rows($depts)==0) {
    echo "<h3>No Depts </h3>";
}      
  else{?>
              <table class="table table-bordered mt-3">
                <thead>
                  <tr>
                    <th>Name</th>
                    
                    <th>Action</th>

                  </tr>
                </thead>

                <tbody > 
                  <?php 
                  while($dept=mysqli_fetch_assoc($depts)){

           echo'         <tr >
<td>
'.$dept['name'].'
</td>

<td>';
?>
              <a href="../backend/delete_dept?q=<?php echo $dept['dept_id']?>">    <button class="btn btn-danger" type="button">
                    Delete
                  </button></a>
                  </td>
                  </tr>

<?php 
                  }

                }
                ?>
                </tbody>
                  </table>
                  
                  
                  
                  
                  
             </div>
  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">


<form action="../backend/add_dept.php" method="post">

<div class="form-group">
                    <label for="eventDay">Department Name</label>
                    <input type="text" class="form-control" id="eventDay" name="dept" placeholder="" />
                  </div>
                  <button class="btn btn-primary" name="submit" value="submit" type="submit">Add Department</button>

</form>


  </div>
  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">

  <table class="table table-bordered">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody id="myTable">
    <?php   $pos=get_po();
    if (mysqli_num_rows($pos)>0) {
        while ($row=mysqli_fetch_assoc($pos)) {
            ?>
     <tr>
        <td><?php echo $row['po_id'] ?></td>
        <td><?php echo $row['name'] ?></td>
   <td><input type="checkbox" <?php echo $row['status']==1?'checked':''; ?> name="" onclick="setPO(<?php echo $row['po_id'] ?>)" id="<?php echo $row['po_id'] ?>"></td>
      </tr>
      <tr>





                      <?php
        }
    }  ?>
            

    
 
      


    </tbody>
  </table>

   


  
  </div>
  <div class="tab-pane fade" id="add_po" role="tabpanel" aria-labelledby="contact-tab">

<form action="../backend/add_po.php" method="post">
<div class="form-group">
                    <label for="eventTitle">Name</label>
                    <input type="text" class="form-control" id="eventTitle" name="name" placeholder="Name" />
                  </div>
                  <div class="form-group">
                    <label for="eventTitle">Contact</label>
                    <input type="text" class="form-control" id="eventTitle" name="contact" placeholder="Phone" />
                  </div>
                  <div class="form-group col-md-4">
            <label for="inputDept">Department</label>
            <select id="inputDept"  name='dept' class="form-control"  required>
           <?php
           
           $dept_list=get_dept();
           
           if (mysqli_num_rows($dept_list)>0) {
        while ($row=mysqli_fetch_assoc($dept_list)) {
            ?>
             <option value="<?php echo $row['dept_id']?>"><?php echo $row['name']?></option>
             <?php
        }
    } ?>
            </select>
          </div>

<button class="btn btn-primary" name='submit' value='submit' type="submit">Add</button>


</form>




  </div>

  <div class="tab-pane fade" id="special_status" role="tabpanel" aria-labelledby="contact-tab">
  <form action="../backend/set_special.php" method="post">
<div class="form-group">
                    <label for="eventTitle">ID</label>
                    <input type="number" class="form-control" id="" name="id" placeholder="ID" />
                  </div>
                  
                  <div class="form-group col-md-8">
            <label for="inputDept">Special Status</label>
            <select id="inputDept"  name='status' class="form-control"  required>
         <option value="3">Blood manager</option>
         <option value="2">Secretary</option>
         <option value="1">Volunteer</option>
            </select>
          </div>

<button class="btn btn-primary" name='submit' value='submit' type="submit">Add</button>


</form>







</div>
  </div>
</div>
</div>

















</div>
             
            </div>
          </div>






















        </div>
      </div>
    </div>
  </div>
  <script>
    $(document).ready(function () {
      $("#myInput").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function () {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
      });
    });

    $(document).ready(function () {
      $("#downloadInput").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $("#myDownloads tr").filter(function () {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
      });
    });
    $(document).ready(function () {
      $("#galleryInput").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $("#myGallery tr").filter(function () {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
      });
    });
    $(document).ready(function () {
      $("#notificationInput").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $("#myNotification tr").filter(function () {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
      });
    });
    $(document).ready(function () {
      $("#eventsInput").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $("#myEvents tr").filter(function () {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
      });
    });
  </script>
  <script src='../js/admin_ajax.js'></script>
  <script>

    function deleteRow(id) {

      [rest, param_id] = id.split('_');
      if (rest == 'N')
        tb = 'notification';
      if (rest == 'EV')
        tb = 'event';
      if (rest == 'D')
        tb = 'downloads';
      if (rest == 'G')
        tb = 'gallery';

      console.log(param_id);
      $.ajax({
        method: "POST",
        url: "../backend/delete_row.php",
        data: { id: param_id, tb: tb },
      }).done(function (data) {

        const result = data;
        if (result == "success") {
          console.log(id);
          $("#" + id).remove()
        }
        else
          alert("Error")
      });
    }


    function setPO(id){
 console.log(id);

 $.ajax({
        method: "POST",
        url: "../backend/set_po.php",
        data: { id: id },
      }).done(function (data) {

        const result = data;
        if (result == "success") {
          console.log(result);
     
        }
        else
          alert(result)
      });
}
    function updateAcademic(){
// console.log("Academic");
pass=prompt("Enter Password");

 $.ajax({
        method: "POST",
        url: "../backend/update_academic.php",
        data: { pass: pass },
      }).done(function (data) {

        const result = data;
        if (result == "success") {
          console.log(result);
     
        }
        else
          alert(result)
      });
}
$(document).ready(function(){
  $("#myLeave").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myLeaveTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
  </script>

</body>

</html>
<?php }?>