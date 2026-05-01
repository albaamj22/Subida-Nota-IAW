<?php
    session_start();
    require __DIR__."/../basedatos/conexion.php";
    require __DIR__."/../utils/datos.php";
    require __DIR__."/../utils/validaciones.php";
    if(isset($_POST['nombre'])){
        $nombre=limpiarDatos($_POST['nombre']);
        $descripcion=limpiarDatos($_POST['descripcion']);
        $categoria=limpiarDatos($_POST['categoria']);
        $disponible=$_POST['disponible'] ?? "";
        $disponible=limpiarDatos($disponible);
        $precio=limpiarDatos($_POST['precio']);

        $errores=false;
        if(!longitudCampoValida('nombre',$nombre,3,60)){
            $errores=true;
        }
        if(!longitudCampoValida('descripcion',$descripcion,5,500)){
            $errores=true;
        }
        if(!precioValido($precio,5,1000)){
            $errores=true;
        }
        if(!categoriaValida($categoria)){
            $errores=true;
        }
        if(!disponibleValido($disponible)){
            $errores=true;
        }
        if($errores){
            mysqli_close($conexion);
            header("Location:nuevo.php");
            exit;
        }

        $q="insert into videojuegos(nombre, descripcion, categoria, disponible, precio) values(?, ?, ?, ?, ?)";
        $stmt=mysqli_stmt_init($conexion);
        mysqli_stmt_prepare($stmt,$q);
        mysqli_stmt_bind_param($stmt,'ssssd', $nombre, $descripcion, $categoria, $disponible, $precio);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($conexion);
        $_SESSION['mensaje']="Videojuego creado correctamente.";
        header("Location:index.php");
        exit;
    }
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CDN tailwndcss -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <!-- CDN iconos fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- cdn Sweet Alert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Nuevo</title>
</head>

<body class="bg-purple-100 p-8">
    <div class="max-w-2xl mx-auto bg-white shadow-xl rounded-xl p-8 space-y-6">

        <h2 class="text-2xl font-semibold text-purple-800 flex items-center gap-2 mb-4">
            <i class="fas fa-gamepad"></i>
            Nuevo Videojuego
        </h2>

        <form action="nuevo.php" method="POST" class="space-y-6">

            <!-- Nombre -->
            <div>
                <label class="block text-purple-700 font-semibold mb-1 flex items-center gap-2">
                    <i class="fas fa-tag"></i> Nombre
                </label>
                <input type="text" name="nombre" required
                    class="w-full border border-purple-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-purple-500 focus:outline-none" />
                    <?php pintarErrores('error_nombre'); ?>
            </div>

            <!-- Descripción -->
            <div>
                <label class="block text-purple-700 font-semibold mb-1 flex items-center gap-2">
                    <i class="fas fa-align-left"></i> Descripción
                </label>
                <textarea name="descripcion" rows="4"
                    class="w-full border border-purple-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-purple-500 focus:outline-none"></textarea>
                    <?php pintarErrores('error_descripcion'); ?>
            </div>

            <!-- Categoría -->
            <div>
                <label class="block text-purple-700 font-semibold mb-1 flex items-center gap-2">
                    <i class="fas fa-layer-group"></i> Categoría
                </label>
                <select name="categoria"
                    class="w-full border border-purple-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-purple-500 focus:outline-none">
                    <option>Elige una categoría</option>
                    <?php foreach($clCategorias as $item=>$valor): ?>
                    <option><?= $item ?></option>
                    <?php endforeach; ?>
                </select>
                <?php pintarErrores('error_categoria'); ?>
            </div>

            <!-- Disponible -->
            <div>
                <label class="block text-purple-700 font-semibold mb-1 flex items-center gap-2">
                    <i class="fas fa-toggle-on"></i> Disponible
                </label>

                <div class="flex items-center gap-6">
                    <label class="flex items-center gap-2">
                        <input type="radio" name="disponible" value="SI" class="accent-purple-600" />
                        SI
                    </label>

                    <label class="flex items-center gap-2">
                        <input type="radio" name="disponible" value="NO" class="accent-purple-600" />
                        NO
                    </label>
                </div>
                <?php pintarErrores('error_disponible'); ?>
            </div>

            <!-- Precio -->
            <div>
                <label class="block text-purple-700 font-semibold mb-1 flex items-center gap-2">
                    <i class="fas fa-euro-sign"></i> Precio
                </label>
                <input type="number" name="precio" step="0.01" min="0"
                    class="w-full border border-purple-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-purple-500 focus:outline-none" />
                    <?php pintarErrores('error_precio'); ?>
            </div>

            <!-- Botones -->
            <div class="flex justify-end gap-4 pt-4">

                <!-- Botón Cancelar -->
                <a href="index.php"
                    class="inline-flex items-center gap-2 bg-gray-300 text-gray-700 px-5 py-2 rounded-full hover:bg-gray-400 transition shadow">
                    <i class="fas fa-arrow-left"></i>
                    Cancelar
                </a>

                <!-- Botón Guardar -->
                <button type="submit"
                    class="inline-flex items-center gap-2 bg-purple-700 text-white px-5 py-2 rounded-full shadow-md hover:bg-purple-800 hover:shadow-lg transition">
                    <i class="fas fa-save"></i>
                    Guardar
                </button>
            </div>

        </form>
    </div>

</body>

</html>