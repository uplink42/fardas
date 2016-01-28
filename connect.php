<?php
 $username = "";
 $password = "";
 $hostname = "localhost";
 $database = "fardas";
 
 $con = mysqli_connect($hostname,$username,$password,$database);
 // Check connection
 if ($con)
 {
    //echo "Ligação estabelecida com êxito. <br>";
 }

 
 if (mysqli_connect_errno())
    {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    
   /* change character set to utf8 */
  if (!$con->set_charset("utf8")) {
      printf("Error loading character set utf8: %s\n", $con->error);
  } else {
      
  }
  
 
  
  
?>
