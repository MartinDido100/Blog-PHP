<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>Blog de videojuegos</title>
</head>
    <body>    
        <!-- Header -->

        <header id="cabecera">
            <!-- Logo -->
            <div id="logo">
                <a href="index.php">
                    Blog de videojuegos
                </a>
            </div>


            <!-- Nav -->
            <nav id="menu">
                <ul>
                    <li>
                        <a href="index.php">Inicio</a>
                    </li>
                    
                <?php $categorias = getCat($db);
                 while($categorias && $categoria = mysqli_fetch_assoc($categorias)) : ?>

                    <li>
                        <a href="index.php?categoria=<?= $categoria['nombre'] ?>"> <?= $categoria['nombre'] ?> </a>
                    </li>

                <?php endwhile ?>
                </ul>
            </nav>

        </header>
    <div id="contenedor">