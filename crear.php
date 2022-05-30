<?php

include_once './pdo/config.php';

$tipo = $_POST['tipo'];

if ($tipo == 'servicios') {
    $descripcion = $_POST['descripcion'];
    $duracion = $_POST['duracion'];
    $precio = $_POST['precio'];
    $stmt = $gbd->prepare("INSERT INTO servicios VALUES (default, :descripcion, :duracion, :precio)");
    $stmt->bindParam(':descripcion', $descripcion);
    $stmt->bindParam(':duracion', $duracion);
    $stmt->bindParam(':precio', $precio);

    $stmt->execute();


    if ($stmt->rowCount() > 0) {
        echo "Se ha añadido el nuevo servicio.";
        header('Location: panelServicios.php');

    }else{
        echo "No se ha completado la inserción del servicio.";
    }

}elseif($tipo == 'productos'){
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $stmt = $gbd->prepare("INSERT INTO productos VALUES (default, :nombre, :precio)");
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':precio', $precio);

    $stmt->execute();

    if($stmt->rowCount() > 0) {
        echo "Se ha añadido el nuevo producto.";
        header('Location: ./administracion/panelProductos.php');
    }else{
        echo "No se ha completado la inserción del producto.";
    }

}elseif($tipo == 'clientes'){
    $tipoAnimal = $_POST['tipoanimal'];
    $nombre = $_POST['nombre'];
    $edad = $_POST['edad'];
    $nombreDueno = $_POST['dueno'];
    $contra = $_POST['contra'];
    $tlf = $_POST['telefono'];
    $foto = $_POST['foto'];

    $stmt = $gbd->prepare("INSERT INTO clientes VALUES (default, :tipo, :nombre, :edad, :dueno, :contra, :tlf, :foto)");
    $stmt->bindParam(':tipo', $tipoAnimal);
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':edad', $edad);
    $stmt->bindParam(':dueno', $nombreDueno);
    $stmt->bindParam(':contra', $contra);
    $stmt->bindParam(':tlf', $tlf);
    $stmt->bindParam(':foto', $foto);

    $stmt->execute();

    if($stmt->rowCount() > 0) {
        echo "Se ha añadido un nuevo cliente.";
        header('Location: ./administracion/panelClientes.php');
    }else{
        echo "No se ha completado la inserción del cliente nuevo.";
    }

}elseif($tipo == 'citas'){


    $stmt = $gbd->prepare("INSERT INTO citas VALUES (:mascota, :servicio, :fecha, :hora)");
    $stmt->bindParam(':mascota', $mascota);
    $stmt->bindParam(':servicio', $servicio);
    $stmt->bindParam(':fecha', $fecha);
    $stmt->bindParam(':hora', $hora);

    $stmt->execute();

    if($stmt->rowCount() > 0) {
        echo "Se ha añadido una nueva cita.";
        header('Location: panelCitas.php');
    }else{
        echo "No se ha completado la inserción de la cita.";
    }

}else{
    echo "Ha ocurrido un error al procesas su formulario.";
}



?>