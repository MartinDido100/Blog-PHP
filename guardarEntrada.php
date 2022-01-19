<?php 

if(isset($_POST)){

    require_once 'includes/conexion.php';

    $titulo = isset($_POST['titulo']) ? mysqli_real_escape_string($db,$_POST['titulo']) : NULL;
    $descripcion = isset($_POST['descripcion']) ? mysqli_real_escape_string($db,$_POST['descripcion']) : NULL;
    $categoria = isset($_POST['categorias']) ? mysqli_real_escape_string($db,$_POST['categorias']) : NULL;
    $user_id = $_SESSION['usuario']['id'];

    $errores = [];
    
    if(empty($titulo) || !is_string($titulo) || preg_match("/[0-9]/",$titulo)){
        $errores['titulo'] = 'Completa el campo';
    }

    if(empty($descripcion) || !is_string($descripcion)){
        $errores['descripcion'] = 'Completa el campo';
    }

    if(count($errores) == 0){

        if(isset($_GET['editar'])){
            $mensaje = 'editada';
            $sql = "UPDATE entradas SET titulo = '$titulo',descripcion = '$descripcion',categoria_id = $categoria WHERE id = {$_GET['editar']}";
        }else{
            $mensaje = 'agregada';
            $sql = "INSERT entradas VALUES(null,$user_id,$categoria,'$descripcion',CURDATE(),'$titulo')";
        }


        $query = mysqli_query($db,$sql);

        if(!$query){
            $_SESSION['entNoAgregada'] = 'Error al agregar';
        }else{
            $_SESSION['entAgregada'] = "Entrada {$mensaje} correctamente!";
        }

    }else{
        $_SESSION['entErrores'] = $errores;
    }

}

if(isset($_GET['editar'])){
    if(count($errores) > 0){
        header("Location:editarEntrada.php?id={$_GET['editar']}");
    }else{
        header("Location:verEntrada?id={$_GET['editar']}");
    }
}else{
    header('Location:crearEntrada.php');
}

?>