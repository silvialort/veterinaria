<?php include_once './pdo/config.php';

$tipo = $_POST['tipo'];

$condicion = "default";

unset($_POST['tipo']);
create(array_filter($_POST, fn($value)=>$value !== ''), $tipo, $condicion, $gbd);

function create (array $params = [], string $tabla, $condicion, $gbd){
    $locations = [
        "servicios" => 'Location: ./administracion/panelServicios.php',
        "productos" => 'Location: ./administracion/panelProductos.php',
        "clientes" => 'Location: ./administracion/panelClientes.php',
    ];

    $campos = "";
    foreach ($params as $field){
        $campos .= "'".$field."'" . ",";
    }

    $query = ("INSERT INTO ".$tabla." VALUES ($condicion," . rtrim( $campos, ',') .")");

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