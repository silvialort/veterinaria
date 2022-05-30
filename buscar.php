<?php include_once './pdo/config.php';

$servicio = $_GET['servicio'];
$tipo = $_GET['tipo'];

$stmt = $gbd->prepare("SELECT * FROM servicios WHERE descripcion_servicio LIKE CONCAT( '%', :servicio, '%')");
$stmt->bindParam(':servicio', $servicio);
$stmt->execute();

$busqueda = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo "<pre>";
var_dump($busqueda);
echo "</pre>";