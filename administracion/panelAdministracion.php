<?php include_once 'headerAdmin.php';

$stmt = $gbd->prepare('SELECT * FROM citas INNER JOIN clientes ON citas.cod_mascota = clientes.id INNER JOIN servicios ON citas.cod_servicio = servicios.cod_servicio  ORDER BY fecha_cita');

$stmt->execute();


$citas = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
            <div class="bienvenida mb-5">
                <h1>Hola, <?= $_SESSION['usuario'] ?></h1>
            </div>
            <div class="calendario">
                <h2 class='mb-4'>Próximas citas</h2>
                    <div class="lista">
                        <ul>
                        <?php foreach($citas as $cita) { ?>
                            <li class="mb-3">
                                <strong><?= date("d-m-Y", strtotime($cita['fecha_cita'])); ?></strong> (<?= substr($cita['hora_cita'],0,-3);  ?>). <?= $cita['nombre'] ?>. <?= $cita['descripcion_servicio'] ?>.
                            </li>
                        <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


<?php include_once '../mod/footer.php'; ?>