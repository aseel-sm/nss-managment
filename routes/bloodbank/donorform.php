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
    <title>Donor Registration</title>
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-light rounded bg-light mt-3 shadow-sm">
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

    <div class="container border py-3 mt-3">
  

      <form action='../../backend/add_donor.php' method='post'>
        <div class="form-row">
        <div class="form-group col-md-6">
              <label for="inputUsername">Phone No</label>
              <input
                type="number"
                name='pno'
                class="form-control"
                id="inputUsername"
                placeholder="Phone No"
              />
            </div>
          <div class="form-group col-md-6">
            <label for="inputPassword">Password</label>
            <input
            name='pass'
              type="password"
              class="form-control"
              id="inputPassword"
              placeholder="Password"
            />
          </div>
        </div>
    
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputName">Name</label>
            <input
              type="search"
              name='name'
              class="form-control"
              id="inputUsername"
              placeholder="Name"
            />
          </div>
          <div class="form-group col-md-4">
            <label for="inputState">Department</label>
            <select name='dept' id="inputState" class="form-control">
            <?php 
             $dept_list=get_dept();if (mysqli_num_rows($dept_list)>0) {
        while ($row=mysqli_fetch_assoc($dept_list)) {
            ?>
             <option value="<?php echo $row['dept_id']?>"><?php echo $row['name']?></option>
             <?php
        }
    } ?>
            </select>
          </div>
          <div class="form-group col-md-4">
            <label for="inputState">Study Year</label>
            <select name='s_year' id="inputState" class="form-control">
         <option value="1">First</option>
         <option value="2">Second</option>
         <option value="3">Third</option>
         <option value="0">NIL</option>
            </select>
          </div>
        </div>
        <div class="form-row">
           
            <div class="form-group col-md-6">
              <label for="inputPassword">Place</label>
              <input
              name='place'
                type="text"
                class="form-control"
                id="inputPassword"
                placeholder="Place"
              />
            </div>
          </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputName">Last Donate Date (default is 3 month back)</label>
            <input
            value="<?php echo date('Y-m-d',strtotime('- 3 months',strtotime(date('Y-m-d')))); ?>"
            name='last_donate'
              type="date"
              class="form-control"
              id="inputLastDonate"
              placeholder="Name"
            />
          </div>
          <div class="form-group col-md-4">
            <label for="inputState">Blood Group</label>
            <select name='bg' id="inputState" class="form-control">
            <?php 
              $blood_g=get_blood();
              foreach ($blood_g as $blood)
            //  $blood=trim($blood,"'");
              echo " <option value=$blood> $blood</option>" 
              ?>
           
            </select>
          </div>
        </div>
        <div class="form-group ">
            <label for="inputPincode">Pincode</label>
            <input
            name='pincode'
              type="number"
              class="form-control"
              id="inputPincode"
              placeholder="Pincode"
            />
          </div>
        <button type="submit" class="btn btn-primary">Register</button>
      </form>
    </div>
    <!-- Selected-->
  
    </div>
  </body>
</html>
