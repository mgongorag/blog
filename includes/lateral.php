<?php require_once 'includes/helpers.php'; ?>
<!-- SIDEBAR -->
<aside id="sidebar">
    <?php if (isset($_SESSION['usuario'])) : ?>
        <div id="usuario-logueado" class="bloque">
            <h3>Bienvenido <?= $_SESSION['usuario']['nombre'] . ' ' . $_SESSION['usuario']['apellido']; ?></h3>
            <!-- Botones -->
            <a  href="mis-datos.php" id="boton">Mis datos</a>
            <a  href="crear-entradas.php" id="boton">Crear Entrada</a>
            <a  href="crear-categoria.php" id="boton">Crear Categoria</a>
            <a  href="cerrar.php" id="boton-cerrar">Cerrar Sesion</a>
        </div>

    <?php endif; ?>

    <?php if (!isset($_SESSION['usuario'])) : ?>
    <div id="login" class="bloque">
        <h3>Identificate</h3>
        <?php if (isset($_SESSION['error_login'])) : ?>
            <div class="alerta alerta-error">
                <?= $_SESSION['error_login']; ?>
            </div>

        <?php endif; ?>

        <form action="login.php" method="post">
            <label for="email">Email</label>
            <input type="text" name="email" id="email">
            <label for="password">Password</label>
            <input type="password" name="password" id="password">
            <input type="submit" value="Entrar">
        </form>
        </?>

        <div id="register" class="bloque">

            <h3>Registrate</h3>
            <?php

            if (isset($_SESSION['completado'])) : ?>
                <div class="alerta alerta-exito">
                    <?= $_SESSION['completado']; ?>
                </div>
            <?php elseif (isset($_SESSION['errores']['general'])) : ?>
                <div class="alerta alerta-error">
                    <?= $_SESSION['errores']['general']; ?>
                </div>
            <?php endif; ?>


            <form action="registro.php" method="post" id="formulario">

                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre">
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'nombre') : ''; ?>

                <label for="apellido">Apellido</label>
                <input type="text" name="apellido" id="apellido">
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'apellido') : ''; ?>


                <label for="email">Email</label>
                <input type="text" name="email" id="email">
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'email') : ''; ?>


                <label for="password">Password</label>
                <input type="password" name="password" id="password">
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'password') : ''; ?>
                <div class="error">
                    <p>Error</p>
                </div>

                <input type="submit" id="boton" name="submit" value="Entrar">
            </form>

            <?php borrarErrores(); ?>
            
        </div>
        <?php endif; ?>
</aside>