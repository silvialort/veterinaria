<?php include_once './pdo/config.php';

// $cliente = $_POST['id'];
$tipo = $_POST['tipo'];



if ($tipo == 'clientes'){
    $condiciones = ["id" => ":id"];
    $cliente = $_POST['id'];
}elseif($tipo == 'productos'){
    $condiciones = [ "id_producto" => ":id_producto"] ; 
    $cliente = $_POST['id'];
}elseif($tipo == 'servicios'){
    $condiciones = [ "cod_servicio" => ":cod_servicio"];
}elseif($tipo == 'citas'){
    $condiciones = [
        "cod_mascota" => $_POST['cod_mascota'],
        "cod_servicio" => $_POST['cod_servicio'],
        "fecha_cita" => $_POST['fecha_cita'],
        "hora_cita" => $_POST['hora_cita']
    ];
}

unset($_POST['tipo']);
delete($tipo, $condiciones, $_POST, $gbd);


function delete (string $tabla, array $params, $values, $gbd) {
    // echo "<pre>".var_export($params,1)."</pre>"; exit;
    $locations = [
        "servicios" => 'Location: ./administracion/panelServicios.php',
        "productos" => 'Location: ./administracion/panelProductos.php',
        "clientes" => 'Location: ./administracion/panelClientes.php',
        "citas" => 'Location: ./administracion/panelCitas.php',
    ];

    $conditionals = "";
    $tags= "";

    foreach($params as $key => $field)
    {
        $conditionals .= $key . "=" ."$field"." AND ";
    

    }
    // echo "<pre>".var_export($tags,1)."</pre>"; exit;

    $query = ("DELETE FROM ". $tabla ." WHERE ". rtrim($condiciones, " AND ") );
    $stmt = $gbd->prepare($query);

    
    
    // echo "<pre>".var_export($stmt,1)."</pre>"; exit;


    // echo "<pre>".var_export($stmt,1)."</pre>"; exit;

    $stmt->execute();


    if ($stmt->rowCount() > 0) {
        header($locations[$tabla]);
    }else{
        header($locations[$tabla]);
    }
}

?>