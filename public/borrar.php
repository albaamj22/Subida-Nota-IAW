<?php
session_start();
$id=filter_input(INPUT_POST,'id',FILTER_VALIDATE_INT);
if(!$id){
    header("Location:index.php");
    exit;
}

require __DIR__."//../basedatos/conexion.php";
$q="delete from videojuegos where id=?";
$stmt=mysqli_stmt_init($conexion);
mysqli_stmt_prepare($stmt,$q);
mysqli_stmt_bind_param($stmt,'i',$id);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);
mysqli_close($conexion);
$_SESSION['mensaje']="Videojuego borrado correctamente.";
header("Location:index.php");
exit;