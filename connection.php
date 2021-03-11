<?php
define("DBHOST","localhost");
define("DBUSERNAME","root");
define("DBPASSWORD","");
define("DB","acebanks");
$conn = mysqli_connect(DBHOST,DBUSERNAME,DBPASSWORD,DB);
if(mysqli_connect_errno()) {  
    die("Failed to connect with MySQL: ". mysqli_connect_error());  
}  
?>