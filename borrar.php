<?php include_once './pdo/config.php';

$tipo = $_POST['tipo'];

// echo "<pre>".var_export($_POST,1)."</pre>"; exit;


if ($tipo == 'clientes'){
    $condiciones = "id=:id";

}elseif($tipo == 'productos'){
    $condiciones = "id_producto=:id_producto";

}elseif($tipo == 'servicios'){
    $condiciones = "cod_servicio=:cod_servicio";
}elseif($tipo == 'citas'){
    $condiciones = "cod_mascota = :cod_mascota AND cod_servicio = :cod_servicio AND fecha_cita= :fecha_cita AND hora_cita= :hora_cita";
}

unset($_POST['tipo']);
delete($tipo, $condiciones, $_POST, $gbd);


function delete (string $tabla, $condiciones, $params, $gbd) {

    $locations = [
        "servicios" => 'Location: ./administracion/panelServicios.php',
        "productos" => 'Location: ./administracion/panelProductos.php',
        "clientes" => 'Location: ./administracion/panelClientes.php',
        "citas" => 'Location: ./administracion/panelCitas.php',
    ];

    $query = ("DELETE FROM $tabla WHERE $condiciones");
    $stmt = $gbd->prepare($query);

    foreach ($params as $key => &$field){
        $stmt->bindParam(":".$key, $field);

    }


    $stmt->execute();


    if ($stmt->rowCount() > 0) {
        header($locations[$tabla]);
    }else{
        header($locations[$tabla]);
    }
}

?>