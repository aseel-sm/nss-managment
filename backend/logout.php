<?php
session_start();
if($_GET['q']=='out')
{


    if(isset($_GET['u']))
    {

if($_GET['u']=='donor'){
$_SESSION['type']=$_SESSION['auth']=null;

if(isset( $_COOKIE['mob']))
setcookie("mob", "", time() - 3600,'/');
//   session_destroy();
header("Location:../routes/bloodbank/bloodbank.php");}


    }
    else{ $_SESSION['type']=$_SESSION['auth']=null;
        if ($_SESSION['special']!=='') {
            $_SESSION['special']='';
        }
    
        if(isset( $_COOKIE['username']))
        setcookie("username", "", time() - 3600,'/');
     //   session_destroy();
        header("Location:../index.php");}
   
}
else{
    echo "error";
}





?>