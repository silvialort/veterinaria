<?php include_once 'headerAdmin.php';

$stmt = $gbd->prepare('SELECT * FROM servicios');
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
                        <input type="text" name="servicio" placeholder="Busca servicio">
                        <input type="hidden" name="tipo" value="servicios">
                        <input type="submit" class="button" value="Enviar">
                    </form>
                </div>
                <div class="contenedor mt-5">
                    <?php foreach ($servicios as $servicio) { ?>
                    <div class="tarjeta">
                        <div class="contenido">
                            <h3><?=$servicio['descripcion_servicio']?></h3>
                            <p><?=$servicio['duracion_servicio']?></p>
                            <span><?=$servicio['precio_servicio']?> €</span>
                        </div>
                        <div class="footer">
                            <form action="../borrar.php" method="post">
                                <input type="hidden" name="id" value="<?=$servicio['cod_servicio'] ?>">
                                <input type="hidden" name="tipo" value="servicios">
                                <input type="submit" value="Eliminar">
                            </form>
                        </div>

                    </div>

                    <?php } ?>
                </div>
            </section>
            <section id="crear-nuevo" class="mt-5">
                <h2>Crear nuevo servicio</h2>
                <form action="../crear.php" method="post" class="mt-3 d-flex flex-column">
                    <label for="descripcion">Descripción</label>
                    <input type="text" name="descripcion" placeholder="Descripción del servicio">
                    <input type="hidden" name="tipo" value="servicios">
                    <label for="duracion">Duración</label>
                    <input type="text" name="duracion" placeholder="Duración del servicio">
                    <label for="precio">Precio</label>
                    <input type="number" name="precio" min='1' max='999' step='0.10'>
                    <input type="submit" class="button" value="Crear">
                </form>
            </section>

            <section id="modificar" class="mt-5">
                <h2>Modificar servicio existente</h2>

                <form action="../cambio.php" method="post" class="mt-3 d-flex flex-column w-40">
                    <label for="servicio">Servicio que modificar</label>
                    <select name="cod_servicio">
                        <?php foreach ($servicios as $servicio) { ?>
                            <option value="0" selected disabled hidden>Servicio para modificar</option>
                            <option value="<?= $servicio['cod_servicio'] ?>"><?= $servicio['descripcion_servicio'] ?></option>
                        <?php } ?>
                    </select>
                    <label for="descripcion_servicio">Descripción</label>
                    <input type="text" name="descripcion_servicio" placeholder="Descripción del servicio">
                    <input type="hidden" name="tipo" value="servicios">
                    <label for="duracion_servicio">Duración</label>
                    <input type="text" name="duracion_servicio" placeholder="Duración del servicio">
                    <label for="precio_servicio">Precio</label>
                    <input type="number" name="precio_servicio" min='1' max='999' step='0.10'>
                    <input type="submit" class="button" value="Modificar">


                </form>

            </section>
        </div>
    </div>
</main>


<?php include_once '../mod/footer.php'; ?>