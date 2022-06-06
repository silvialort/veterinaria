<?php include_once('./mod/header.php');

$stmt = $gbd->prepare("SELECT * from servicios");
$stmt->execute();
$servicios = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $gbd->prepare("SELECT * from productos");
$stmt->execute();
$productos = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $gbd->prepare("SELECT * from clientes");
$stmt->execute();
$clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<main id="index">
    <section id="banner">
        <h1>¡Bienvenido!</h1>
    </section>
    <section id="servicios" class="my-4 p-3">
        <h2 class='my-4'>Nuestros servicios</h2>
        <div class="contenedor px-5">
            <?php foreach($servicios as $servicio) { ?>
                <div class="tarjeta">
                    <p><?= $servicio['descripcion_servicio'] ?></p>
                    <p><?= $servicio['precio_servicio'] ?> €</p>
                    <p><?= $servicio['duracion_servicio'] ?></p>
                </div>
            <?php } ?>
        </div>
    </section>
    <section id="productos" class="my-4 p-3">
        <h2 class='my-4'>Productos destacados</h2>
        <div class="contenedor px-5">
            <?php foreach($productos as $producto) { ?>
                <div class="tarjeta">
                    <p><?= $producto['nombre'] ?></p>
                    <p><?= $producto['precio'] ?> €</p>
                </div>
            <?php } ?>
        </div>
    </section>
    <section id="mascotas" class="my-4 p-3">
        <h2 class='my-4'>Algunos de nuestros clientes</h2>
        <div class="contenedor px-5">
        <?php for ($i = 1; $i <= 4; $i++) { ?>
            <div class="tarjeta">
            <img src="./img/<?= $clientes[$i]['foto'] ?>" alt=<?= $clientes[$i]['nombre'] ?>>
            <p class='mt-4'><?= $clientes[$i]['nombre'] ?></p>
            </div>
        <?php } ?>
        </div>
    </section>
</main>



<?php include_once('./mod/footer.php'); ?>