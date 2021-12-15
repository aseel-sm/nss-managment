<?php
require('../backend/status.php');

require('../backend/utilities.php');
require('../backend/dbconnect.php');
session_start();
$reg_status=portal_status('registration');
if ($reg_status!=1) {
    header("Location:../index.php");
} else {
    $user=$pass=$name='';
    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $dept_list=get_dept();
    $err='';
    if ($_SERVER['REQUEST_METHOD']=='POST') {

        if (isset($_POST['reg'])) {
            $user=test_input($_POST['user']);
            $name=test_input($_POST['name']);
            $sex=test_input($_POST['sex']);
            
            if (is_user_exist($user)) {
                $err='User exists';
            } else {
                $pass=test_input($_POST['pass']);
                $dept=test_input($_POST['dept']);
               

                $sql="insert into volunteers_profile (username,password,name,dept_id,user_type,gender) values ('$user','$pass','$name','$dept','4','$sex')";
                if (mysqli_query($conn, $sql)) {
                    $_SESSION['type']="registered";
                    $_SESSION['auth']="true";
                    setcookie(
                      "username",
                      $user,
                      time() + (10 * 365 * 24 * 60 * 60)
                    );
                    header("Location:registrationstatus.php");
                } else {
                    die("Connection failed: " . mysqli_error($conn));
                }
            }
        }
    }
   
    
    
    
    
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
  <nav class="navbar navbar-expand-lg navbar-light rounded bg-light mt-3 shadow-sm">
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
        
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="../index.php"
                >Home <span class="sr-only">(current)</span></a
              >
            </li>
           
          </ul>
         </a>
            </nav>
    <div class="container  py-3 mt-3">
      <form method='post' action='<?php $_SERVER["PHP_SELF"]?>'>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputUsername">Username</label>
            <input
              type="text"
              class="form-control"
              id="inputUsername"
              name='user'
              placeholder="Username"
              value='<?php echo $user?>'
              required
            /><div style="color:red;font-size:10px;" >
<?php echo $err?>
      </div>
          </div>
          <div class="form-group col-md-6">
            <label for="inputPassword">Password</label>
            <input
              type="password"
              class="form-control"
              id="inputPassword"
              name='pass'
              placeholder="Password"
              value='<?php echo $pass?>'
              required
            />
          </div>
        </div>

        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputName">Name</label>
            <input
              type="text"
              class="form-control"
              id="inputUsername"
              placeholder="Name"
              required
              name='name'
              value='<?php echo $name?>'
            />
          </div>
          <div class="form-group col-md-4">
            <label for="inputDept">Department</label>
            <select id="inputDept"  name='dept' class="form-control"  required>
           <?php if (mysqli_num_rows($dept_list)>0) {
        while ($row=mysqli_fetch_assoc($dept_list)) {
            ?>
             <option value="<?php echo $row['dept_id']?>"><?php echo $row['name']?></option>
             <?php
        }
    } ?>
            </select>
          </div>
        </div>
 <div class="form-group">
            <label for="">Gender</label><br />
            <div class="form-check form-check-inline">
              <input
                class="form-check-input"
                type="radio"
                name="sex"
                id="inlineRadio1"
                value="Male"
                required
              />
              <label class="form-check-label" for="inlineRadio1">Male</label>
            </div>
            <div class="form-check form-check-inline">
              <input
                class="form-check-input"
                type="radio"
                name="sex"
                id="inlineRadio2"
                value="Female"
                required
              />
              <label class="form-check-label" for="inlineRadio2">Female</label>
            </div>
          </div>
        <button type="submit" value="register" name='reg' class="btn btn-primary">Register</button>
      </form>
    </div>
    <!-- Selected-->
  
    </div>
  </body>
</html>
<?php
}?>