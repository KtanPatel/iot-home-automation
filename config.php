<?php
   define('DB_SERVER', 'localhost:3306');
   define('DB_USERNAME', 'phpmyadmin');
   define('DB_PASSWORD', 'passwd');
   define('DB_DATABASE', 'IOT');
   $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE) or die('Database Connection Erro...');
?>

