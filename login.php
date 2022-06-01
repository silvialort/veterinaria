<?php include_once './pdo/config.php';

$usuario = $_POST['usuario'];
$contrasena = $_POST['contrasena'];

$stmt = $gbd->prepare('SELECT * FROM administradores WHERE usuario=:usuario');
$stmt->bindParam(':usuario', $usuario);

$stmt->execute();

$administrador = $stmt->fetch(PDO::FETCH_ASSOC);

if ($stmt-> rowCount() > 0) {
    if($administrador['contrasena'] == $contrasena){
        session_start();
        $_SESSION['usuario'] = $administrador['usuario'];
        header('Location: ./administracion/panelAdministracion.php');
    }else{
        header('Location: ./administracion/iniciarSesion.php');
    }
}else{
    header('Location: ./administracion/iniciarSesion.php');
}

?>

