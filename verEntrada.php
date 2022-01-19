<?php require_once 'includes/conexion.php' ?>
<?php require_once 'includes/helpers.php' ?>


<?php 

    $entrada = getEntrada($db,$_GET['id']);

    if(!isset($_GET['id']) && !isset($entrada)){
        header('Location:index.php');
    }

?>

<?php require_once 'includes/header.php' ?>

<?php require_once 'includes/aside.php' ?>


<div id="principal">

    <h1><?= $entrada['titulo'] ?></h1>
    <h2> <?= $entrada['categoria'] ?> </h2>
    <h4> <?= $entrada['fecha'] ?> | <?= $entrada['usuario'] ?> </h4>
    <p>
        <?= $entrada['descripcion'] ?>
    </p>

    <br>

    <?php if(isset($_SESSION['usuario']) && $entrada['usuario_id'] == $_SESSION['usuario']['id']) : ?>

        <a href="editarEntrada.php?id=<?= $entrada['id'] ?>" class="boton boton-verde">Editar entrada</a>
        <a href="borrarEntrada.php?id=<?= $entrada['id'] ?>" class="boton boton-rojo">Eliminar entrada</a>

    <?php endif; ?>

</div>


<?php require_once 'includes/footer.php' ?>