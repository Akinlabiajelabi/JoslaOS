<?php
   define('DB_SERVER', 'josladb.cgxjhdohrvdq.us-west-2.rds.amazonaws.com:3306');
   define('DB_USERNAME', 'root');
   define('DB_PASSWORD', 'josla040516');
   define('DB_DATABASE', 'josla');
   $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
?>