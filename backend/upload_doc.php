<?php 
require('dbconnect.php');
$fileExistsFlag = 0; 
// Check if image file is a actual image or fake image
if(isset($_POST["upload_doc"])) {
  
      $fileName = $_FILES['docFile']['name'];
      $sql="select path from gallery where path='$fileName'";
      $result=mysqli_query($conn, $sql) or die(mysqli_error($conn));
      while ($row=mysqli_fetch_array($result)) {
          if ($row['path'] == $fileName) {
              $fileExistsFlag = 1;
          }
      }
      if ($fileExistsFlag == 0) {
          $target = "../assets/downloads/";
          $fileTarget = $target.$fileName;
          $tempFileName = $_FILES["docFile"]["tmp_name"];
          $title = $_POST['docTitle'];
          $result = move_uploaded_file($tempFileName, $fileTarget);

          if($result){
              $sql="INSERT INTO `downloads`(`title`, `path`) VALUES ('$title','$fileName')";
              $result=mysqli_query($conn, $sql) or die(mysqli_error($conn));
                    header("Location:../routes/adminboard.php");
          }
          else {			
          
                   echo "<script>alert('Sorry !!! There was an error in uploading your file');
            window.location = '../routes/adminboard.php';</script> ";
                    
		}
      }
      else {
     

          echo "<script>alert('Sorry !!! Exist');
  window.location = '../routes/adminboard.php';</script> ";
      }


  }

?>