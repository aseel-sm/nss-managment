<?php

require('../backend/utilities.php');
$user_type=get_user_type($_COOKIE['username']);
if ($user_type==5) {
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
    <title>Enrollment Form</title>
  </head>
  <body>
    <div class="container border py-3 mt-3">
      <form action='../backend/enrollment_controller.php?q=<?php echo   $_COOKIE['username'] ?>' method='post'>
       
     
         
      

        <div class="form-row">
        
          <div class="form-group col-md-3">
            <label for="inputState">Category</label>
            <select id="inputState" name="cat" required class="form-control">
              <option value="OBC" >OBC</option>
              <option value="SC" >SC</option>
              <option value="ST" >ST</option>
              <option value="General" >General</option>
                           
             
              
              
            </select>
          </div>
          <div class="form-group col-md-3">
            <label for="inputState">Blood Group</label>
            <select name="bg" required id="inputState" class="form-control">
              <?php 
              $blood_g=get_blood();
              foreach ($blood_g as $blood)
            //  $blood=trim($blood,"'");
              echo " <option value=$blood> $blood</option>" 
              ?>
           
            </select>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-8">
            <label for="inputEmail4">Email</label>
            <input
            name="email"
              type="email"
              class="form-control"
              id="inputEmail4"
              placeholder="Email"
              required
            />
          </div>
          <div class="form-group col-md-4">
            <label for="inputPassword4">Date of Birth</label>
            <input
            name="dob"
              type="date"
              class="form-control"
              id="inputPassword4"
              placeholder=""
              required
            />
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-8">
            <label for="inputEmail4">Parent's Name</label>
            <input
            name="gname"
              type="text"
              class="form-control"
              id="inputEmail4"
              placeholder="Name"
              required
            />
          </div>
       
        </div>
        <div class="form-row">
        
          <div class="form-group col-md">
            <label for="inputPassword4">Volunteer Phone</label>
            <input
            name="vphone"
              type="text"
              class="form-control"
              id="inputPassword4"
              placeholder=""
              required
            />
          </div>
        </div>
        <div class="form-group">
          <label for="inputAddress">Place</label>
          <input
            type="text"
            name="place"
            class="form-control"
            id="inputAddress"
            placeholder=""
            required
          />
        </div>
        <div class="form-group">
          <label for="inputAddress">PINCODE</label>
          <input
            type="number"
            name="pincode"
            class="form-control"
            id="inputAddress"
            placeholder=""
            required
          />
        </div>
        <div class="form-group">
          <label for="inputAddress">Cultural Talenta(Specify)</label>
          <input
          name="talent"
            type="text"
            class="form-control"
            id="inputAddress"
            placeholder=""
            required
          />
        </div>

        <button type="submit" name="submit" value='submit' class="btn btn-primary">Enroll</button>
      </form>
    </div>
  </body>
</html>
<?php
} 
else{
  echo "<h1>Invalid Access</h1>";
}?>