<?php
try {
    $conexion=mysqli_connect('127.0.0.1','uexamen','secret0','examen',3307);
} catch (Exception $ex) {
    die("Error de conexion a la base de datos, el mensaje es: ".$ex->getMessage());
}