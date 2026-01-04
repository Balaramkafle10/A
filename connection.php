<?php
 $servername = "localhost";
 $userName = "root";
 $password = "";
 $database = "tourmandu_db";

 $conn = mysqli_connect( $servername, $userName, $password, $database);

 if ( ! $conn){
    die ("connection failed". mysqli_connect_error());
 } else {
   //  echo "connected sucessfully";
 }
 ?>