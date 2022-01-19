<?php 
    require_once 'includes/redireccion.php';
    require_once 'includes/conexion.php'; 
    require_once 'includes/helpers.php';
?>


<?php require_once 'includes/header.php' ?>
<?php require_once 'includes/aside.php' ?>

    <?php

        $cats = getCat($db); 

        $entErrores = isset($_SESSION['entErrores']) ? $_SESSION['entErrores'] : NULL;
    
    ?>
    <div id="principal">
        <h1>Crear Entrada</h1>
        <p>Añade nuevas entradas al blog: </p>
        <br>
        <?php if(isset($_SESSION['entAgregada'])) : ?>
            <div class="alerta alerta-exito">
                <?= $_SESSION['entAgregada'] ?>
            </div>
        <?php elseif(isset($_SESSION['entNoAgregada'])) : ?>
            <div class="alerta alerta-error">
                <?= $_SESSION['entNoAgregada'] ?>
            </div>
        <?php endif; ?>
        <form action="guardarEntrada.php" method="POST">
            <?= mostrarErrores($entErrores,'titulo') ?>
            <label for="titulo">Titulo de la entrada:</label>
            <input type="text" name="titulo">

            <?= mostrarErrores($entErrores,'descripcion') ?>
            <label for="descripcion">Descripcion de la entrada:</label>
            <textarea name="descripcion" cols="137" rows="10" style="resize: none; padding: 1em 1em";></textarea>

            <?php if($cats) : ?>
            <label for="categorias">Selecciona categoria: </label>
            <select name="categorias">
                <?php while($categoria = mysqli_fetch_assoc($cats)) : ?>
                    <option value="<?= $categoria['id'] ?>"> <?= $categoria['nombre'] ?> </option>
                <?php endwhile ?>
            </select>
                
            <input type="submit" value="Guardar">

            <?php else : ?>

            <h3>Aun no hay categorias, no puedes insertar entradas</h3>

            <?php endif; ?>
        </form>
    </div>
    
    <?php borrarErrores(); ?>

<?php require_once 'includes/footer.php' ?>