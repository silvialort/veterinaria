<?php include_once './pdo/config.php';

$tipo = $_GET['tipo'];

unset($_GET['tipo']);

if ($tipo == 'citas'){
    searchCita(array_filter($_GET, fn($value)=>$value !== ''), $gbd);
}else{
    search(array_filter($_GET, fn($value)=>$value !== ''), $tipo, $gbd);
}


function search (array $params = [], string $tabla, $gbd) {

    $condiciones = "";

    foreach ($params as $key => $field) {
        $condiciones .= $key . " LIKE CONCAT('%', :".$key.", '%') AND ";
    }

    $query = ("SELECT * FROM $tabla WHERE ". rtrim( $condiciones, 'AND ' ) ."");
    $stmt = $gbd->prepare($query);

    foreach ($params as $key => $field){
        // Se ha probado en un primer momento con bindParam, pero construía los parámetros mal
        // $stmt->bindParam(":".$key, $field);
        $parametros[":".$key] = $field;
    }

    $stmt->execute($parametros);

    // $stmt->debugDumpParams();

    // echo "<pre>".var_export($stmt,1)."</pre>"; exit;
    $busqueda = $stmt->fetchAll(PDO::FETCH_ASSOC);

    session_start();
    $_SESSION['busqueda'] = $busqueda;
    header('Location: ' . $_SERVER['HTTP_REFERER']);


}

function searchCita (array $params = [], $gbd)
{
    $condiciones = "";

    foreach ($params as $key => $field) {
        $condiciones .= 'citas.' . $key . " = :$key AND ";
    }
    $stmt = $gbd->prepare("SELECT * FROM citas, clientes, servicios WHERE ". rtrim( $condiciones, 'AND ' ) . " AND citas.cod_mascota = clientes.id AND citas.cod_servicio = servicios.cod_servicio");

    foreach ($params as $key => $field){

        $parametros[":".$key] = $field;
    }

    $stmt->execute($parametros);

    // $stmt->debugDumpParams();


    $busqueda = $stmt->fetchAll(PDO::FETCH_ASSOC);

    session_start();
    $_SESSION['busqueda'] = $busqueda;
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}


