<?php 

require('../backend/dbconnect.php');
require('../backend/status.php');
require('../backend/utilities.php');
$id=$_POST['eventid'];
$absents=attendence_by_event($id);
if($absents==0)
  $absents=array();
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
    <title>Attendence</title>
  </head>
  <body>
    <div class="container">
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

       
          </li>
        </ul>
        <a class="btn btn-outline-primary my-2 my-sm-0" href="../routes/adminboard">Home</a>
      

    </nav>
    <h1 class='text-center'>Attendence of Event ID: <?php echo $id; ?></h1>

<table class="table table-bordered">
<thead>
  <tr>
    <th>ID</th>
    <th>Name</th>
    <th>Status</th>
  </tr>
</thead>
<tbody id="myTable">
<?php   $volunteers=get_volunteers_active();
if (mysqli_num_rows($volunteers)>0) {
    while ($row=mysqli_fetch_assoc($volunteers)) {
        ?>
 <tr>
    <td><?php echo $row['id'] ?></td>
    <td><?php echo $row['name'] ?></td>
<td><input type="checkbox" <?php echo in_array($row['id'],$absents)?'':'checked'; ?> name="" onclick="handleAbsent(<?php echo $row['id'],',',$id ?>)" id="<?php echo $row['id'] ?>"></td>
  </tr>
  <tr>





                  <?php
    }
} else {
    echo "NIL";
} ?>
        



  


</tbody>
</table>
<script>

  
function handleAbsent(vid,eid){
 console.log(vid,eid);

 $.ajax({
        method: "POST",
        url: "../backend/handle_absent.php",
        data: { v_id: vid,e_id:eid },
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
   


    </div>
  </body>
</html>
