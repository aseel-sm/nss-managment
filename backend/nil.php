<?php 
require('dbconnect.php');


 echo date('Y-m-d',strtotime('- 3 months',strtotime(date('Y-m-d'))));
?>