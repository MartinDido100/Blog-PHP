<?php
require_once 'includes/redireccion.php';
require_once 'includes/conexion.php';
require_once 'includes/helpers.php';
?>

<?php require_once 'includes/header.php' ?>
<?php require_once 'includes/aside.php' ?>

<?php 

    if(isset($_SESSION['errores'])){
        $errores = $_SESSION['errores'];
    }else{
        $errores = null;
    }

?>

<div id="principal">
    <h1>Mis datos</h1>

    <?php if(isset($_SESSION['actualizado'])) : ?>
        <div class="alerta alerta-exito">
            <?= $_SESSION['actualizado'] ?>
        </div>
    <?php endif ?>

    <form action="updateUser.php" method="POST">

        <?= mostrarErrores($errores, 'nombre'); ?>
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" value="<?= $_SESSION['usuario']['nombre'] ?>">

        <?= mostrarErrores($errores, 'apellidos'); ?>
        <label for="apellidos">Apellidos</label>
        <input type="text" name="apellidos" value="<?= $_SESSION['usuario']['apellido'] ?>">

        <?= mostrarErrores($errores, 'email'); ?>
        <label for="email">Email</label>
        <input type="email" name="email" value="<?= $_SESSION['usuario']['email'] ?>">

        <input type="submit" name="submit" value="Guardar">

    </form>
    <?php unset($_SESSION['actualizado']); borrarErrores() ?>

</div>

<?php require_once 'includes/footer.php' ?>