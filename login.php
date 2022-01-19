<?php 


if(isset($_POST['email']) && isset($_POST['contraseña'])){
    
    require 'includes/conexion.php';

    $email = trim($_POST['email']);
    $pass = $_POST['contraseña'];

    $sql = "SELECT * FROM usuarios WHERE email = '$email' LIMIT 1";

    $query = mysqli_query($db,$sql);

    if($query && mysqli_num_rows($query) == 1){

        $usuario = mysqli_fetch_assoc($query);

        $passVerify = password_verify($pass,$usuario['password']);

        if($passVerify){
            $_SESSION['usuario'] = $usuario;
        }else{
            $_SESSION['loginError'] = 'Credenciales invalidas';
        }

    }else{
        $_SESSION['loginError'] = 'Credenciales invalidas';
    }

}else{
    $_SESSION['loginError'] = 'Campos incompletos';
}

header('Location:index.php');

?>