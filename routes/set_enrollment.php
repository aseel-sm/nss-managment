<?php 

require('../backend/dbconnect.php');
require('../backend/status.php');
require('../backend/utilities.php');
if (portal_status('registration')==1) {
    ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Set enrollment</title>
  </head>

  <body>
    <div class="container">

    <h1>Set Enrollment of Students</h1>

    <table class="table table-bordered">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody id="myTable">
    <?php   $volunteers=get_volunteers();
    if (mysqli_num_rows($volunteers)>0) {
        while ($row=mysqli_fetch_assoc($volunteers)) {
          if ($row['user_type']==4) {
              ?>
     <tr>
        <td><?php echo $row['id'] ?></td>
        <td><?php echo $row['name'] ?></td>
   <td><input type="checkbox" <?php echo $row['user_type']==5?'checked':''; ?> name="" onclick="setEnroll(<?php echo $row['id'] ?>)" id="<?php echo $row['id'] ?>"></td>
      </tr>
      <tr>





                      <?php
          }  }
    } else {
        echo "NIL";
    } ?>
            

    
 
      


    </tbody>
  </table>

   
      
     
    </div>

   <script>

function setEnroll(id){
 console.log(id);

 $.ajax({
        method: "POST",
        url: "../backend/set_enroll.php",
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


    </script>
   
  </body>
</html>
<?php
}
else
echo "No Access";?>