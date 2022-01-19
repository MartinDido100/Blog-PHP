<?php 

if(isset($_POST)){
    
    require_once 'includes/conexion.php';

    $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db,trim($_POST['nombre']))  : false;
    $apellidos = isset($_POST['apellidos']) ? mysqli_real_escape_string($db,trim($_POST['apellidos'])) : false;
    $email = isset($_POST['email']) ? mysqli_real_escape_string($db,trim($_POST['email'])) : false;

    //Creo array de errores
    $errores = [];

    $sql = "SELECT id,email FROM usuarios WHERE email = '$email'";

    $isset_email = mysqli_query($db,$sql);
    $isset_user = mysqli_fetch_assoc($isset_email);

    if(mysqli_num_rows($isset_email) == 1 && $isset_user['id'] != $_SESSION['usuario']['id']){
        $errores['email'] = "Email ya tomado";
    }

    //Valido los datos
    if(!empty($nombre) && is_string($nombre) && !preg_match("/[0-9]/",$nombre)){
        $nombre_validated = true; 
    }else{
        $nombre_validated = false;
        $errores['nombre'] = "El nombre no es valido";
    }

    if(!empty($apellidos) && is_string($apellidos) && !preg_match("/[0-9]/",$apellidos)){
        $apellidos_validated = true; 
    }else{
        $apellidos_validated = false;
        $errores['apellidos'] = "Los apellidos no son validos";
    }

    if(!empty($email) && filter_var($email,FILTER_VALIDATE_EMAIL)){
        $email_validated = true; 
    }else{
        $email_validated = false;
        $errores['email'] = "Email invalido";
    }

    $guardar_usuario = false;
    if(count($errores) == 0){
        $guardar_usuario = true;
        
        $usuario = $_SESSION['usuario'];
        
        $sql = "UPDATE usuarios SET nombre = '$nombre', apellido = '$apellidos', email = '$email' WHERE id = {$usuario['id']}";
        
        var_dump($sql);
        $query = mysqli_query($db,$sql);

        if($query){
            $_SESSION['usuario']['nombre'] = $nombre;
            $_SESSION['usuario']['apellidos'] = $apellidos;
            $_SESSION['usuario']['email'] = $email;
            $_SESSION['actualizado'] = "Se actualizo exitosamente"; 
        }else{
            $_SESSION['errores']['general'] = "Error al actualizar";
        }



    }else{
        $_SESSION['errores'] = $errores;
    }
}

header("Location:misDatos.php");

?>