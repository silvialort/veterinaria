<?php include_once './pdo/config.php';

$tipo = $_POST['tipo'];

// $condicion = "default";

unset($_POST['tipo']);
create(array_filter($_POST, fn($value)=>$value !== ''), $tipo,  $gbd);

function create (array $params = [], string $tabla,  $gbd){
    $locations = [
        "servicios" => 'Location: ./administracion/panelServicios.php',
        "productos" => 'Location: ./administracion/panelProductos.php',
        "clientes" => 'Location: ./administracion/panelClientes.php',
        "citas" => 'Location: ./administracion/panelCitas.php',
    ];

    $campos = "";
    $valores = "";
    foreach ($params as $key => $field){
        $campos .= $key . ",";
        $valores .= "'".$field."'" . ",";
    }

    $query = ("INSERT INTO ".$tabla." (" . rtrim( $campos, ',') .") VALUES (" . rtrim( $valores, ',') .")");

    $stmt = $gbd->prepare($query);




    $stmt->execute();

    if($stmt->rowCount() > 0) {

        echo "Creado con éxito.";
        header($locations[$tabla]);

    }else{

        echo "No se ha creado.";

    }

}


?>