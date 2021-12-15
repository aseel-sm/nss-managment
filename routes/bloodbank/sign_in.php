<?php

require('../../backend/dbconnect.php');
session_start();
$err='';
$user=$pass='';
  function test_input($data)
  {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
  }
 
  if ($_SERVER['REQUEST_METHOD']=='POST') {
      if (isset($_POST['submit'])) {
        $user=test_input($_POST['mobile']);
        $pass=test_input($_POST['pass']);
        
          $sql="SELECT mobile_no,`password` FROM blood_donor_profile";
          $result=mysqli_query($conn, $sql);
          if (mysqli_num_rows($result)==1) {
              while ($row=$result->fetch_assoc()) {
                  if ($user==$row['mobile_no'] && $pass==$row['password']) {
                      
                      $_SESSION['type']='donor';
                      $_SESSION['auth']="true";
                      setcookie(
                        "mob",
                        $user,
                        time() + (10 * 365 * 24 * 60 * 60),'/'
                    );
                     header("Location:bloodboard.php");
                  } else {
                      $err="Wrong Creditianal";
                  }
              }
          }
          else
          echo  mysqli_error($conn);
      }
  }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donor Sign In</title>
</head>

<style>
    .login-form {
      width: 340px;
      margin: 50px auto;
    }

    .login-form form {
      margin-bottom: 15px;
      background: #f7f7f7;
      box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
      padding: 30px;
    }

    .login-form h2 {
      margin: 0 0 15px;
    }

    .form-control,
    .btn {
      min-height: 38px;
      border-radius: 2px;
    }

    .input-group-addon .fa {
      font-size: 18px;
    }

    .btn {
      font-size: 15px;
      font-weight: bold;
    }

    .bottom-action {
      font-size: 14px;
    }
  </style>


<body>
    


<div class="login-form">
            <form action="<?php $_SERVER["PHP_SELF"]?>" method="post">
              <h2 class="text-center">Sign In</h2>
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <span class="fa fa-user"></span>
                    </span>
                  </div>
                  <input type="text" class="form-control" placeholder="Username" required="required" name="mobile" />
                </div>
              </div>
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="fa fa-lock"></i>
                    </span>
                  </div>
                  <input type="password" class="form-control" placeholder="Password" required="required"
                    name="pass" />
                </div>
              </div>
              <div class="form-group">
                <button type="submit" value='submit' name='submit' class="btn btn-primary btn-block">
                  Log in
                </button>
              </div>
              <div style="color:red;font-size:10px;" >
<?php echo $err?>
  </div>
            </form>
          </div>
</body>
</html>