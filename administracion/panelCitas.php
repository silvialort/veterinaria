<?php include_once 'headerAdmin.php';


$stmt = $gbd->prepare('SELECT * FROM citas INNER JOIN clientes ON citas.cod_mascota = clientes.id INNER JOIN servicios ON citas.cod_servicio = servicios.cod_servicio');

$stmt->execute();


$citas = $stmt->fetchAll(PDO::FETCH_ASSOC);
// echo "<pre>".var_export($citas,1)."</pre>"; exit;

$stmt = $gbd->prepare('SELECT id, nombre FROM clientes');
$stmt->execute();

$clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $gbd->prepare('SELECT cod_servicio, descripcion_servicio FROM servicios');
$stmt->execute();

$servicios = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
        <div class="col-10 p-4" id='cuerpo'>
            <section id="buscador">
                <div class="buscador">
                    <form action="../buscar.php" method="get">
                        <input type="date" name="fecha_cita">
                        <select name="id">
                            <option value="0" selected disabled hidden>Selecciona el cliente</option>
                            <?php foreach ($citas as $cita) { ?>
                                <option value="<?= $cita['cod_mascota'] ?>"><?= $cita['nombre'] ?></option>
                            <?php } ?>
                        </select>
                        <select name="cod_servicio">
                            <option value="0" selected disabled hidden>Selecciona el servicio</option>
                            <?php foreach ($citas as $cita) { ?>
                                <option value="<?= $cita['cod_servicio'] ?>"><?= $cita['descripcion_servicio'] ?></option>
                            <?php } ?>

                        </select>
                        <input type="submit" class="button" value="Enviar">
                    </form>
                </div>
                <div class="contenedor mt-5">
                    <?php foreach ($citas as $cita) { ?>
                    <div class="tarjeta">
                        <div class="contenido">
                            <ul>
                                <li><span>Cliente: </span><?= $cita['nombre'] ?></li>
                                <li><span>Servicio: </span><?= $cita['descripcion_servicio'] ?></li>
                                <li><span>Fecha cita: </span><?= date("d-m-Y", strtotime($cita['fecha_cita'])); ?></li>
                                <li><span>Hora cita: </span><?= substr($cita['hora_cita'],0,-3); ?></li>
                                <li><span>Precio final: </span><?= $cita['precio_servicio']; ?> €</li>
                            </ul>
                        </div>
                        <div class="footer">
                            <form action="../borrar.php" method="post">
                                <input type="hidden" name="cod_mascota" value="<?= $cita['cod_mascota'] ?>">
                                <input type="hidden" name="cod_servicio" value="<?= $cita['cod_servicio'] ?>">
                                <input type="hidden" name="fecha_cita" value="<?= $cita['fecha_cita'] ?>">
                                <input type="hidden" name="hora_cita" value="<?= $cita['hora_cita'] ?>">
                                <input type="hidden" name="tipo" value="citas">
                                <input type="submit" value="Eliminar">
                            </form>
                        </div>
                    </div>

                    <?php } ?>
                </div>
            </section>
            <section id="crear-nuevo" class="mt-5">
                <h2>Añadir nueva cita</h2>
                <form action="../crear.php" method="post" class="mt-3 d-flex flex-column">
                    <select name="cod_mascota">
                        <option value="0" selected disabled hidden>Selecciona el cliente</option>
                        <?php foreach ($clientes as $cliente) { ?>
                            <option value="<?= $cliente['id']; ?>"> <?=$cliente['nombre']?> </option>
                        <?php } ?>
                    </select>
                    <select name="cod_servicio" required>
                        <option value="0" selected disabled hidden>Selecciona el servicio</option>
                        <?php foreach ($servicios as $servicio) { ?>
                            <option value="<?= $servicio['cod_servicio']; ?>"> <?=$servicio['descripcion_servicio']?> </option>
                        <?php } ?>
                    </select>
                    <input type="date" name="fecha_cita">
                    <input type="time" name="hora_cita">
                    <input type="hidden" name="tipo" value="citas" required>
                    <input type="submit" class="button" value="Añadir" required>
                </form>
            </section>

            <section id="modificar" class="mt-5">
                <h2>Modificar cita existente</h2>

                <form action="../cambio.php" method="post" class="mt-3 d-flex flex-column w-40">
                    <select name="cod_mascota">
                            <option value="0" selected disabled hidden>Selecciona el cliente</option>
                        <?php foreach ($citas as $cita) { ?>
                            <option value="<?= $cita['cod_mascota'] ?>"><?= $cita['nombre'] ?></option>
                        <?php } ?>
                    </select>
                    <select name="cod_servicio">
                            <option value="0" selected disabled hidden>Selecciona el servicio</option>
                            <?php foreach ($servicios as $servicio) { ?>
                            <option value="<?= $servicio['cod_servicio'] ?>"><?= $servicio['descripcion_servicio'] ?></option>
                            <?php } ?>
                    </select>
                    <input type="date" name="fecha_cita">
                    <input type="time" name="hora_cita">
                    <input type="hidden" name="tipo" value="citas">
                    <input type="submit" class="button" value="Modificar">


                </form>

            </section>
        </div>

    </div>
</main>


<?php include_once '../mod/footer.php'; ?>