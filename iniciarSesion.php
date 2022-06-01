<?php include_once './mod/header.php'; ?>

<main id="login" class='m-5'>
    <form action="./login.php" method="post" class='d-flex flex-column'>
        <label for="usuario">Usuario</label>
        <input type="text" name="usuario" required>
        <label for="contrasena">Contraseña</label>
        <input type="password" name="contrasena" required>
        <input type="submit" class="button" value="Iniciar sesión">
    </form>
</main>

<?php include_once './mod/footer.php'; ?>


