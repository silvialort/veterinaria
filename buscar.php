<?php include_once './pdo/config.php';

$tipo = $_GET['tipo'];


unset($_GET['tipo']);
search(array_filter($_GET, fn($value)=>$value !== ''), $tipo, $gbd);
function search (array $params = [], string $tabla, $gbd) {



    $condiciones = "";

    foreach ($params as $key => $field) {
        $condiciones .= $key . " LIKE CONCAT('%', :".$key.", '%') AND ";
    }

    $query = ("SELECT * FROM $tabla WHERE ". rtrim( $condiciones, 'AND ' ) ."");
    // echo "<pre>".var_export($query,1)."</pre>"; exit;
    $stmt = $gbd->prepare($query);
    foreach ($params as $key => $field){
        $stmt->bindParam(":".$key, $field);
    }



    // $stmt = $gbd->prepare("SELECT * FROM $tabla WHERE descripcion_servicio LIKE CONCAT( '%', :servicio, '%')");
    // $stmt->bindParam(':servicio', $servicio);
    $stmt->execute();

    $busqueda = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($stmt-> rowCount() > 0) {
        echo "<pre>";
        var_dump($busqueda);
        echo "</pre>";
    }else{
        echo "No se han encontrado resultados.";
        header('refresh: 2; url= ./administracion/panelCitas.php');
    }


}


