<?php include_once './pdo/config.php';

$cliente = $_POST['id'];
$tipo = $_POST['tipo'];

if ($tipo == 'clientes'){
    $condiciones = "id";
}elseif($tipo == 'productos'){
    $condiciones = "id_producto";
}elseif($tipo == 'servicios'){
    $condiciones = "cod_servicio";
}elseif($tipo == 'citas'){
    $condiciones = [
        "cod_mascota" => ":cod_mascota",
        "cod_servicio" => ":cod_servicio",
        "fecha_cita" => ":fecha_cita",
        "hora_cita" => ":hora_cita"
    ];
}

delete($tipo, $condiciones, $cliente, $gbd);


function delete (string $tabla, array $condiciones, $cliente, $gbd) {

    $locations = [
        "servicios" => 'Location: ./administracion/panelServicios.php',
        "productos" => 'Location: ./administracion/panelProductos.php',
        "clientes" => 'Location: ./administracion/panelClientes.php',
    ];

    $condiciones = "";
    foreach($condiciones as $key => $field)
    {
        $condiciones .= $key . "=" .$field."AND";

    }

    $query = "DELETE FROM $tabla WHERE $condiciones";
    $stmt = $gbd->prepare($query);

    echo "<pre>".var_export($stmt,1)."</pre>"; exit;

    $stmt->execute();


    if ($stmt->rowCount() > 0) {
        header($locations[$tabla]);
    }else{
        header($locations[$tabla]);
    }
}

?>