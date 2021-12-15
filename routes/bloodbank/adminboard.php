
<?php
require('../../backend/utilities.php')

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
    <title>Blood Manager</title>
  </head>
  <body class="bg-light">
<div class="container bg-white mt-3 py-5 ">
  <nav
  class="navbar navbar-expand-lg navbar-light rounded bg-light mt-3 shadow-sm"
>
  <a class="navbar-brand" href="bloodbank.php">
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
</nav>

<div class="container-fluid px-5 pt-4">
  <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
    <li class="nav-item" role="presentation">
      <a
        class="nav-link active"
        id="pills-home-tab"
        data-toggle="pill"
        href="#pills-home"
        role="tab"
        aria-controls="pills-home"
        aria-selected="true"
        >Requests</a
      >
    </li>
    <li class="nav-item" role="presentation">
      <a
        class="nav-link"
        id="pills-profile-tab"
        data-toggle="pill"
        href="#pills-profile"
        role="tab"
        aria-controls="pills-profile"
        aria-selected="false"
        >Donors</a
      >
    </li>
    <!-- <li class="nav-item" role="presentation">
      <a
        class="nav-link"
        id="pills-contact-tab"
        data-toggle="pill"
        href="#pills-contact"
        role="tab"
        aria-controls="pills-contact"
        aria-selected="false"
        >Contact</a
      >
    </li> -->
  </ul>
  <div class="tab-content border" id="pills-tabContent">
    <div
      class="tab-pane fade show active"
      id="pills-home"
      role="tabpanel"
      aria-labelledby="pills-home-tab"
    >
      <div class="table-responsive">
      <input class="form-control" id="myRequest" type="text" placeholder="Search..">
<br>
        <table class="table table-dark table-striped">
          <thead class="thead-light">
            <tr>
              <th>Patient Name</th>
              <th>Required Blood</th>
              <th>Unit</th>
              <th>Date of Requirment</th>
              <th>Hospital</th>
              <th>Pincode</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody id="myRequestTable">
          <?php
          
          
          $requets=get_blood_requests();
          if (mysqli_num_rows($requets)==0) {
              echo "<h1>No Data</h1>";
          } else {
              while ($request=mysqli_fetch_assoc($requets)) {
                  echo " <tr>
              <td>".$request['patient_name']."</td>
              <td>".$request['blood_group']."</td>
              <td>".$request['no_of_unit']."</td>
              <td>".date("d F Y h:m:s ", strtotime($request['request_date']))."</td>
              <td>".$request['hospital']."</td>
              <td>".$request['pincode']."</td>
            
              <td>";
                  $is_verified=$request['is_verified'];

                  if ($is_verified==null) {
                      ?>

<a href="../../backend/verify_blood_req?i=<?php echo $request['request_id']?>&s=1"><button class="btn btn-success" type="button">
                      Verify</button></a>
                      <a href="../../backend/verify_blood_req?i=<?php echo $request['request_id']?>&s=0"><button class="btn btn-danger" type="button">
                      Reject</button></a>

           <?php
                  } elseif ($is_verified==1) {
                      ?>
<button class="btn btn-success mb-2" type="button">Verified</button><br>
<?php

$is_satisfied=$request['is_satisfied'];
                      if ($is_satisfied==null) {
                          ?>
<a href="../../backend/satisfy_req?i=<?php echo $request['request_id']?>&s=1"><button class="btn btn-success" type="button">
                      Satisfy</button></a>
<a href="../../backend/satisfy_req?i=<?php echo $request['request_id']?>&s=0"><button class="btn btn-danger" type="button">
Couldn't Satisfy</button></a>
                   

<?php
                      } elseif ($is_satisfied==1) {
                          ?>

                      <button class="btn btn-success" type="button">Satisfied</button>
                   
<?php
                      } else {
?><button class="btn btn-danger" type="button">Not Satisfied</button>
<?php
                      } ?>


<?php
                  } else {
                      ?>
                      
                      <button class="btn btn-danger" type="button">Rejected</button>

                      <?php
                  } ?>


             
              </td>
            </tr>
            <?php
              }
          }?>
          </tbody>
   
        </table>
      </div>
    </div>
    <div
      class="tab-pane fade"
      id="pills-profile"
      role="tabpanel"
      aria-labelledby="pills-profile-tab"
    >
      <div class="table-responsive">

      <input class="form-control" id="myInput" type="text" placeholder="Search..">
<br>

        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Name</th>
              <th>Dept</th>
              <th>Blood Group</th>
              <th>Contact</th>
              <th>PINCODE</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody id="myTable">
            <?php  $donors=get_donors();
            if (mysqli_num_rows($donors)==0) {
                echo "No Data";
            } else {
                while ($donor=mysqli_fetch_assoc($donors)) {
                    echo "                <tr>
              <td>".$donor['donor_name']."</td>
              <td>".$donor['d_name']."</td>
              <td>".$donor['blood_group']."</td>
              <td>".$donor['mobile_no']."</td>
              <td>".$donor['pincode']."</td>";

$status=$donor['next_donate']<=date('Y-m-d')?"&#9989;":"&#10060;";

            echo " <td>".$status."</td></tr>";
                }
            }
            
          
            ?>


          </tbody>
        </table>
      </div>
    </div>
    <!-- <div
      class="tab-pane fade"
      id="pills-contact"
      role="tabpanel"
      aria-labelledby="pills-contact-tab"
    >
 .....

    </div> -->
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
        $("#myRequest").on("keyup", function () {
          var value = $(this).val().toLowerCase();
          $("#myRequestTable tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
          });
        });
      });
    </script>
  </body>
</html>
