<?php 
    DEFINE('DB_USER','root');
    DEFINE('DB_PASSWORD','');
    DEFINE('DB_HOST','localhost');
    DEFINE('DB_NAME','quan_ly_tien_luong');
    $conn = mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) 

		OR die ('Could not connect to MySQL: ' . mysqli_connect_error() );
?>