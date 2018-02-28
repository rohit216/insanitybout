<?php

  $hostname="insanitybout.ceazc8sfrkye.ap-south-1.rds.amazonaws.com";
  $username="insanitybout";
  $password="insanitybout";
  $dbname ="insanitybout";
  
  $con = mysqli_connect($hostname,$username,$password,$dbname);
  
  if($con)
  {
      //echo "Success";
  }
  else
  {
      //echo "Error";
  }
?>