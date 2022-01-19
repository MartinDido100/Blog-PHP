<?php 

    if(isset($_SESSION['errores'])){
        $errores = $_SESSION['errores'];
    }else{
        $errores = null;
    }

?>

        <aside id="sidebar">

            <div id="buscador" class="bloque">

                <?php if(isset($_SESSION['errorBusqueda'])) : ?>
                    <div class="alerta alerta-error">
                        <?= $_SESSION['errorBusqueda'] ?>
                    </div>
                <?php endif;  ?>

                <form action="buscar.php" method="POST">

                    <label for="busqueda"><h3>Buscar: </h3></label>
                    <input type="text" name="busqueda" id="busqueda">

                    <input type="submit" name="buscar">

                </form>
            </div>


            <?php if(isset($_SESSION['usuario'])) : ?>    

                <div class="bloque" id="usuario-logueado">
                    <h3>Bienvenido, <?= $_SESSION['usuario']['nombre'] . ' ' . $_SESSION['usuario']['apellido']  ?></h3>
                    <a href="crearEntrada.php" class="boton boton-verde">Crear entrada</a>
                    <a href="crearCategoria.php" class="boton">Crear categoria</a>
                    <a href="misDatos.php" class="boton boton-naranja">Mis datos</a>
                    <a href="backend/logout.php" class="boton boton-rojo">Cerrar sesion...</a>
                </div>

            <?php else: ?>

            

            <div id="login" class="bloque">
                <?php if(isset($_SESSION['loginError'])) : ?>
                    <div class="alerta alerta-error">
                        <?= $_SESSION['loginError'] ?>
                    </div>
                <?php endif ?>
                <h3>Identificate</h3>
                <form action="login.php" method="POST">

                    <label for="email">Email</label>
                    <input type="email" name="email">

                    <label for="contraseña">Contraseña</label>
                    <input type="password" name="contraseña">

                    <input type="submit" name="submit">

                </form>
            </div>




            <div id="register" class="bloque">
                <h3>Registrarse</h3>
                <?php if(isset($_SESSION['registro'])) : ?>
                    <div class="alerta alerta-exito">
                        <?= $_SESSION['registro'] ?>
                    </div>
                <?php elseif(isset($_SESSION['errores']['general'])) : ?>
                    <div class="alerta alerta-error">
                        <?= $_SESSION['errores']['general'] ?>
                    </div>
                <?php endif ?>
                <form action="registro.php" method="POST">

                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre">
                    <?= mostrarErrores($errores,'nombre'); ?>

                    <label for="apellidos">Apellidos</label>
                    <input type="text" name="apellidos">
                    <?= mostrarErrores($errores,'apellidos'); ?>

                    <label for="email">Email</label>
                    <input type="email" name="email">
                    <?= mostrarErrores($errores,'email'); ?>

                    <label for="contraseña">Contraseña</label>
                    <input type="password" name="contraseña">
                    <?= mostrarErrores($errores,'pass'); ?>

                    <input type="submit" name="submit">

                </form>
            </div>
            <?php endif ?>
            <?php borrarErrores(); ?>



        </aside>