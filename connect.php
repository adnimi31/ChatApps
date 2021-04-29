<?php 
  $hostname = "localhost";
  $username = "root";
  $password = "";
  $dbname = "chatapps";

  $conn = mysql_connect($hostname, $username, $password);
  mysql_select_db($dbname);
  if(!$conn){
    echo "Database connection error".mysql_connect_error();
  }

 ?>