<?php 

$server = 'localhost';
$database = 'veterinario_larosa';

$dsn = "mysql:host=$server;dbname=$database;charset=utf8";

$usuario = 'root';
$contraseña = '';


try {
    $gbd = new PDO($dsn, $usuario, $contraseña);
    $gbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
} catch (PDOException $e) {
    echo 'Falló la conexión: ' . $e->getMessage();
}



?>