<?php 

$db = mysqli_connect('localhost','root','','blog_master'); 

if(!$db){
    die('Error de Base de datos');
}

mysqli_query($db,"SET NAMES utf8");

if(!isset($_SESSION)){
    session_start();
}

?>