<?php include_once 'headerAdmin.php';

if (!empty($_SESSION['busqueda'])) {
    $busqueda = $_SESSION['busqueda'];
    unset($_SESSION['busqueda']);
}

    $stmt = $gbd->prepare('SELECT * FROM productos');
    $stmt->execute();

    $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $busqueda = $busqueda ?? $productos;

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
                        <input type="text" name="nombre" placeholder="Busca un producto">
                        <input type="number" name="precio" placeholder="Busca precio" min='1' max='999' step='0.05'>
                        <input type="hidden" name="tipo" value="productos">
                        <input type="submit" class="button" value="Enviar">
                    </form>
                </div>
                <div class="contenedor mt-5">
                    <?php foreach ($busqueda as $producto) { ?>
                    <div class="tarjeta">
                        <div class="contenido">
                            <h3><?=$producto['nombre']?></h3>
                            <span><?=$producto['precio']?> €</span>
                        </div>
                        <div class="footer">
                            <form action="../borrar.php" method="post">
                                <input type="hidden" name="id_producto" value="<?=$producto['id_producto'] ?>">
                                <input type="hidden" name="tipo" value="productos">
                                <input type="submit" value="Eliminar">
                            </form>
                        </div>

                    </div>

                    <?php } ?>
                </div>
            </section>
            <section id="crear-nuevo" class="mt-5">
                <h2>Crear nuevo producto</h2>
                <form action="../crear.php" method="post" class="mt-3 d-flex flex-column">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" placeholder="Nombre del producto">
                    <input type="hidden" name="tipo" value="productos">
                    <label for="precio">Precio</label>
                    <input type="number" name="precio" min='1' max='999' step='0.05'>
                    <input type="submit" class="button" value="Crear">
                </form>
            </section>

            <section id="modificar" class="mt-5">
                <h2>Modificar producto existente</h2>

                <form action="../cambio.php" method="post" class="mt-3 d-flex flex-column w-40">
                    <label for="producto">Producto que modificar</label>
                    <select name="id_producto">
                        <?php foreach ($productos as $producto) { ?>
                            <option value="0" selected disabled hidden>Producto para modificar</option>
                            <option value="<?= $producto['id_producto'] ?>"><?= $producto['nombre'] ?></option>
                        <?php } ?>
                    </select>
                    <label for="nombre">Nuevo nombre</label>
                    <input type="text" name="nombre" placeholder="Nuevo nombre del producto">
                    <input type="hidden" name="tipo" value="productos">
                    <label for="precio">Precio</label>
                    <input type="number" name="precio" min='1' max='999' step='0.05'>
                    <input type="submit" class="button" value="Modificar">


                </form>

            </section>
        </div>
    </div>
</main>


<?php include_once '../mod/footer.php'; ?>