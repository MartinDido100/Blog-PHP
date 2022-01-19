<?php 

if(isset($_POST)){
    require_once 'includes/conexion.php';

    if(empty($_POST['nombre']) || !is_string($_POST['nombre']) || preg_match("/[0-9]/",$_POST['nombre'])){
        $_SESSION['catError'] = 'Completa el campo';
    }else{

        $nombre = mysqli_real_escape_string($db,$_POST['nombre']);

        $sql = "INSERT categorias VALUES(null,'$nombre')";

        $result = mysqli_query($db,$sql);

        if(!$result){
            $_SESSION['catError'] = 'Ya existe la categoria';
        }else{
            $_SESSION['catCorrecto'] = 'Agregado Correctamente';
        }
    }



}else{
    $_SESSION['catError'] = 'Completa el campo';
}

header('Location:crearCategoria.php');

?>