<?php
require __DIR__."/../utils/datos.php";

function limpiarDatos($cadena){
    return htmlspecialchars(trim($cadena));
}

function longitudCampoValida($nomCampo,$valorCampo,$min,$max){
    if(strlen($valorCampo)<$min || strlen($valorCampo)>$max){
        $_SESSION["error_$nomCampo"]="Error, la longitud esperada es de $min y $max caracteres.";
        return false;
    }
    return true;
}

function pintarErrores($nomError){
    if(isset($_SESSION[$nomError])){
        echo "<p class='text-red-500 text-sm italic mt-2'>{$_SESSION[$nomError]}</p>";
        unset($_SESSION[$nomError]);
    }
}

function precioValido($precio,int|float $min, int|float $max){
    if($precio<$min || $precio>$max){
        $_SESSION['error_precio']="Error, se esperaba un precio comprendido entre $min y $max";
        return false;
    }
    return true;
}

function categoriaValida($categoria){
    global $clCategorias;
    foreach($clCategorias as $categorias=>$color){
        if($categorias==$categoria){
            return true;
        }
    }
    $_SESSION['error_categoria']="Error, categoria invalida o no seleccionada.";
    return false;
}

function disponibleValido($disponible){
    global $clDisponible;
    foreach($clDisponible as $disponibles=>$color){
        if($disponibles==$disponible){
            return true;
        }
    }
    $_SESSION['error_disponible']="Error, seleccione un valor.";
    return false;
}