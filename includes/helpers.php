<?php 

function mostrarErrores($errores,$campo){
    $alerta = '';
    if(isset($errores[$campo]) && !empty($campo)){
        $alerta = "<div class='alerta alerta-error'>$errores[$campo]</div>";
    }

    return $alerta;
}

function borrarErrores(){
    unset($_SESSION['registro']);
    unset($_SESSION['errores']);
    unset($_SESSION['catError']);
    unset($_SESSION['catCorrecto']);
    unset($_SESSION['loginError']);
    unset($_SESSION['entAgregada']);
    unset($_SESSION['entNoAgregada']);
    unset($_SESSION['entErrores']);
    unset($_SESSION['errorBusqueda']);
}

function getCat($db){
    $sql = "SELECT * FROM categorias ORDER BY id ASC";
    $categorias = mysqli_query($db,$sql);
    $result = [];

    if($categorias && mysqli_num_rows($categorias) >= 1){
        $result = $categorias;
    }

    return $result;
}

function getEntradas($db,$limit = null){
    $sql = "SELECT e.*,c.nombre FROM entradas e INNER JOIN categorias c ON c.id = e.categoria_id ";

    if(isset($_GET['categoria'])){
        $sql .= "WHERE c.nombre = '{$_GET['categoria']}' ";
    }

    $sql .= "ORDER BY e.id DESC ";

    if($limit){
        $sql .= "LIMIT 4";
    }


    $entradas = mysqli_query($db,$sql);

    $result = [];

    if($entradas && mysqli_num_rows($entradas) >= 1){
        $result = $entradas;
    }

    return $result;
}

function getEntrada($db,$id){

    $sql = "SELECT e.*,c.nombre AS 'categoria', CONCAT(u.nombre,' ',u.apellido) AS 'usuario' FROM entradas e INNER JOIN categorias c ON c.id = e.categoria_id 
            INNER JOIN usuarios u ON e.usuario_id = u.id
            WHERE e.id = $id";

    
    $entrada = mysqli_query($db,$sql);

    $result = [];

    if($entrada && mysqli_num_rows($entrada) >= 1){
        $result = mysqli_fetch_assoc($entrada);
    }

    return $result;
}

function checkActiveCat(){
    return isset($_GET['categoria']) ? "entradas.php?categoria={$_GET['categoria']}" : 'entradas.php';
}

function buscarEntradas($db,$busqueda,$limit = null){
    $sql = "SELECT e.*,c.nombre FROM entradas e INNER JOIN categorias c ON c.id = e.categoria_id ";

    if(!empty($busqueda)){
        $sql.= "WHERE e.titulo LIKE '%$busqueda%'";
    }

    $sql .= "ORDER BY e.id DESC ";

    if($limit){
        $sql .= "LIMIT 4";
    }


    $entradas = mysqli_query($db,$sql);

    $result = [];

    if($entradas && mysqli_num_rows($entradas) >= 1){
        $result = $entradas;
    }

    return $result;
}

?>