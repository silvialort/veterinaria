<?php include_once 'headerAdmin.php';

?>


<main id="administracion" class="container-fluid">
    <div class="row">
        <div class="col-2" id='navegacion'>
            <a href='panelAdministracion.php'>Inicio</a>
            <a href="panelClientes.php">Clientes</a>
            <a href="panelProductos.php">Productos</a>
            <a href="panelServicios.php">Servicios</a>
            <a href="panelCitas.php">Citas</a>
        </div>
        <div class="col-10 my-5 px-5" id='cuerpo'>
            <h1>Hola, <?= $_SESSION['usuario'] ?></h1>
        </div>
    </div>
</main>


<?php include_once '../mod/footer.php'; ?>