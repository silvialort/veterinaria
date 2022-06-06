<?php include_once './pdo/config.php';

session_start();

session_unset();
echo "Cerrando sesión...";
header('refresh: 5; url= index.php');


?>