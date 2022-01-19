<?php 
    require_once 'includes/redireccion.php';
    require_once 'includes/conexion.php'; 
    require_once 'includes/helpers.php';
?>


<?php require_once 'includes/header.php' ?>
<?php require_once 'includes/aside.php' ?>


    <div id="principal">
        <h1>Crear Categoria</h1>
        <p>Añade nuevas categorias al blog para que los usuarios puedan usarlas.</p>
        <br>
        <?php if(isset($_SESSION['catError'])) : ?>
            <div class="alerta alerta-error">
                <?= $_SESSION['catError'] ?>
            </div>
        <?php elseif(isset($_SESSION['catCorrecto'])) : ?>
            <div class="alerta alerta-exito">
                <?= $_SESSION['catCorrecto'] ?>
            </div>
        <?php endif; ?>
        <form action="guardarCategoria.php" method="POST">
            <label for="nombre">Nombre de la categoria:</label>
            <input type="text" name="nombre">

            <input type="submit" value="Guardar">
        </form>
    </div>
    
    <?php borrarErrores(); ?>

<?php require_once 'includes/footer.php' ?>