<?php 

    require_once './includes/conexion.php'; 
    require_once 'includes/helpers.php' 
        
?>

<!-- Header -->
<?php require_once './includes/header.php' ?>



        <!-- Sidebar -->

        <?php require_once './includes/aside.php' ?>

        <!-- Main -->

        <main id="principal">


            <h1>Ultimas entradas <?= isset($_GET['categoria']) ? "de {$_GET['categoria']}" : '' ?></h1>

            <?php 
            
                $entradas = getEntradas($db,true);

                if(!$entradas) :
            ?>   

                <h2>Aun no hay entradas...</h2>

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


            <div id="ver-todas">
                <a href=" <?= checkActiveCat(); ?> " class="boton">Ver mas...</a>
            </div>
 
            <?php endif ?>
        </main> 
        
        <!-- Fin Main -->

<!-- Footer -->
<?php require_once './includes/footer.php' ?>