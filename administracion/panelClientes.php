<?php include_once 'headerAdmin.php';

if (!empty($_SESSION['busqueda'])) {
    $busqueda = $_SESSION['busqueda'];
    unset($_SESSION['busqueda']);
}

    $stmt = $gbd->prepare('SELECT * FROM clientes');
    $stmt->execute();

    $clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $busqueda = $busqueda ?? $clientes;
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
                        <input type="text" name="nombre" placeholder="Buscar al animal">
                        <input type="text" name="nombre_dueno" placeholder="Buscar al dueño">
                        <input type="tel" name="telefono_dueno" placeholder="Buscar teléfono del dueño">
                        <input type="hidden" name="tipo" value="clientes">
                        <input type="submit" class="button" value="Enviar">
                    </form>
                </div>
                <div class="contenedor mt-5">
                    <?php foreach ($busqueda as $cliente) { ?>
                    <div class="tarjeta">
                        <h3><?=$cliente['nombre']?></h3>
                        <div class="imagen d-flex justify-content-center">
                            <img src="../img/<?=$cliente['foto']?>" alt="<?=$cliente['nombre']?>">
                        </div>
                        <div class="contenido">
                            <ul>
                                <li>Teléfono dueño: <?=$cliente['telefono_dueno'] ?></li>
                                <li>Dueño: <?=$cliente['nombre_dueno']?></li>
                                <li>Edad: <?=$cliente['edad'] ?></li>
                            </ul>
                        </div>
                        <div class="footer">
                            <form action="../borrar.php" method="post">
                                <input type="hidden" name="id" value="<?=$cliente['id'] ?>">
                                <input type="hidden" name="tipo" value="clientes">
                                <input type="submit" value="Eliminar">
                            </form>
                        </div>
                    </div>

                    <?php } ?>
                </div>
            </section>
            <section id="crear-nuevo" class="mt-5">
                <h2>Añadir nuevo cliente</h2>
                <form action="../crear.php" method="post" class="mt-3 d-flex flex-column">
                    <input type="text" name="nombre" placeholder="Nombre del animal" required>
                    <select name="tipo_animal" required>
                            <option value="0" selected disabled hidden>Selecciona el tipo de animal</option>
                            <option value="perro">Perro</option>
                            <option value="gato">Gato</option>
                            <option value="conejo">Conejo</option>
                            <option value="hámster">Hámster</option>
                            <option value="pájaro">Pájaro</option>
                            <option value="otro">Otro</option>
                    </select>
                    <input type="number" name="edad" min='0' max='20' placeholder='Edad' required>
                    <input type="text" name="nombre_dueno" placeholder="Nombre del dueño" required>
                    <input type="password" name="contrasena" placeholder="Contraseña" required>
                    <input type="tel" name="telefono_dueno" placeholder="Teléfono" required>
                    <input type="file" name="foto" required>
                    <input type="hidden" name="tipo" value="clientes" required>
                    <input type="submit" class="button" value="Añadir" required>
                </form>
            </section>

            <section id="modificar" class="mt-5">
                <h2>Modificar animal existente</h2>

                <form action="../cambio.php" method="post" class="mt-3 d-flex flex-column w-40">
                    <label for="cliente">Animal que modificar</label>
                    <select name="id">
                        <?php foreach ($clientes as $cliente) { ?>
                            <option value="0" selected disabled hidden>Cliente que modificar</option>
                            <option value="<?= $cliente['id'] ?>"><?= $cliente['nombre'] ?></option>
                        <?php } ?>
                    </select>
                    <label for="nombre">Nuevo nombre</label>
                    <input type="text" name="nombre" placeholder="Nuevo nombre del cliente">
                    <label for="tipo_animal">Tipo de animal</label>
                    <select name="tipo_animal">
                            <option value="0" selected disabled hidden>Selecciona el tipo de animal</option>
                            <option value="perro">Perro</option>
                            <option value="gato">Gato</option>
                            <option value="conejo">Conejo</option>
                            <option value="hámster">Hámster</option>
                            <option value="pájaro">Pájaro</option>
                            <option value="otro">Otro</option>
                    </select>
                    <label for="edad">Edad</label>
                    <input type="number" name="edad" min='0' max='20' placeholder='Edad'>
                    <label for="nombre_dueno">Dueño</label>
                    <input type="text" name="nombre_dueno" placeholder="Nombre del dueño">
                    <label for="contrasena">Contraseña</label>
                    <input type="password" name="contrasena" placeholder="Contraseña">
                    <label for="telefono_dueno">Teléfono</label>
                    <input type="tel" name="telefono_dueno" placeholder="Teléfono">
                    <label for="foto">Foto</label>
                    <input type="file" name="foto">
                    <input type="hidden" name="tipo" value="clientes">
                    <input type="submit" class="button" value="Modificar">


                </form>

            </section>
        </div>
    </div>
</main>


<?php include_once '../mod/footer.php'; ?>