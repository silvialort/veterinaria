<?php include_once './pdo/config.php';

$tipo = $_POST['tipo'];


if ($tipo == 'servicios') {
    $condicion = 'cod_servicio=:cod_servicio';
}elseif ($tipo == 'productos') {
    $condicion = 'id_producto=:id_producto';
}elseif ($tipo == 'clientes') {
    $condicion = 'id=:id';
}
unset($_POST['tipo']);
update(array_filter($_POST, fn($value)=>$value !== ''), $tipo, $condicion, $gbd);


function update (array $params = [], string $tabla, string $condicion, $gbd)
{
    // redirige en función del tipo (tabla)
    $locations = [
        "servicios" => 'Location: ./administracion/panelServicios.php',
        "productos" => 'Location: ./administracion/panelProductos.php',
        "clientes" => 'Location: ./administracion/panelClientes.php',
    ];

    // creamos la cadena con los campos que afectan a la consulta
    $campos = "";
    foreach($params as $key => $field)
    {
        $campos .= $key . "=:" .$key.",";

    }


    $qry = ("UPDATE ".$tabla." SET " . rtrim($campos, ',') . " WHERE " . $condicion);


    $stmt = $gbd->prepare($qry);

    foreach ($params as $key => &$field){
        $stmt->bindParam(":".$key, $field);
        echo $key.$field;
    }


    $stmt->execute();

    if($stmt->rowCount() > 0) {

        echo "Modificado con éxito.";
        header($locations[$tabla]);

    }else{

        echo "No se ha modificado.";

    }

}
?>