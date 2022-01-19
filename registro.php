<?php 

if(isset($_POST)){

    require_once 'includes/conexion.php';

    $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db,trim($_POST['nombre']))  : false;
    $apellidos = isset($_POST['apellidos']) ? mysqli_real_escape_string($db,trim($_POST['apellidos'])) : false;
    $email = isset($_POST['email']) ? mysqli_real_escape_string($db,trim($_POST['email'])) : false;
    $password = isset($_POST['contraseña']) ? mysqli_real_escape_string($db,trim($_POST['contraseña'])) : false;

    //Creo array de errores
    $errores = [];

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

    if(!empty($password) && strlen($password) >= 6){
        $password_validated = true; 
    }else{
        $password_validated = false;
        $errores['pass'] = "Pass invalido";
    }

    $guardar_usuario = false;
    if(count($errores) == 0){
        $guardar_usuario = true;

        //Insertar usuario en DB
        //Cifro la contraseña
        $crypted_pass = password_hash($password,PASSWORD_BCRYPT,['cost' => 10]);

        $sql = "INSERT INTO usuarios VALUES(null,'$nombre','$apellidos','$email','$crypted_pass',CURDATE())";

        $query = mysqli_query($db,$sql);

        if($query){
            $_SESSION['registro'] = "El registro fue exitoso"; 
        }else{
            $_SESSION['errores']['general'] = "Error al registrar";
        }



    }else{
        $_SESSION['errores'] = $errores;
    }
}

header("Location:index.php");

?>