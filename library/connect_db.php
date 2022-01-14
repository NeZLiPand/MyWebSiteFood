<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$connect = new mysqli('127.0.0.1', 'mysql', 'mysql', 'food');
                  //1-host | 2-name user | 3-password | 4-name BD
if (!$connect) 
      die(mysqli_connect_error());
?>
