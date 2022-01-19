<?php 

    require_once './includes/conexion.php'; 
    require_once 'includes/helpers.php' 
        
?>

<?php 

    if(empty($_POST['busqueda'])){
        header('Location:index.php');
    }

?>

<!-- Header -->
<?php require_once './includes/header.php' ?>



        <!-- Sidebar -->

        <?php require_once './includes/aside.php' ?>

        <!-- Main -->

        <main id="principal">

            <h1>Resultados de <?= $_POST['busqueda'] ?></h1>

            <?php 
            
            $entradas = buscarEntradas($db,$_POST['busqueda']);
                if(empty($entradas)) :
            ?>   

                <?php 
                    $_SESSION['errorBusqueda'] = 'No hay resultados...';
                    header('Location:index.php');
                ?>

            <?php else: ?>

            <?php while($entrada = mysqli_fetch_assoc($entradas)) : ?>

                <article class="entradas">
                    <a href="verEntrada.php?id=<?= $entrada['id'] ?>">
                        <h2><?= $entrada['titulo'] ?></h2>
                        <span class="fecha"> <?= $entrada['nombre'] . ' | ' . $entrada['fecha']?> </span>
                        <p> <?= substr($entrada['descripcion'],0,180) . '...'  ?> </p>
                    </a>
                </article>

            <?php endwhile ?>

            <?php endif ?>
        </main> 
        
        <!-- Fin Main -->

<!-- Footer -->
<?php require_once './includes/footer.php' ?>