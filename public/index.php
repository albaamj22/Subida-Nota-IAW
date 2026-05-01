<?php
    session_start();
    require __DIR__ . '/../basedatos/conexion.php';
    require __DIR__ . '/../utils/datos.php';
    $q="select * from videojuegos order by id desc";
    $videojuegos=mysqli_query($conexion,$q);
    mysqli_close($conexion);
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
    <title>examen</title>
</head>

<body class="bg-purple-100 p-8">
    <h2 class="text-center text-2xl italic font-semibold mb-6 text-purple-800">Listado de VideoJuegos</h2>
    <div class="flex flex-row-reverse mb-4 gap-2">
        <a href="nuevo.php"
            class="font-bold inline-flex items-center gap-2 bg-purple-700 text-white px-5 py-2 rounded-full shadow-md hover:bg-purple-800 hover:shadow-lg transition">
            <i class="fas fa-plus"></i>
            NUEVO
        </a>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white shadow-xl rounded-xl overflow-hidden">
            <thead class="bg-purple-700 text-white">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-semibold">ID</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold">Nombre</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold">Descripción</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold">Categoría</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold">Disponible</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold">Precio</th>
                    <th class="px-6 py-3 text-center text-sm font-semibold">Acciones</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-purple-200">
                <!-- Ejemplo de fila -->
                 <?php foreach($videojuegos as $item): ?>
                <tr class="hover:bg-purple-50 transition">
                    <td class="px-6 py-4 text-sm"><?= $item['id'] ?></td>
                    <td class="px-6 py-4 text-sm font-medium text-purple-800"><?= $item['nombre'] ?></td>
                    <td class="px-6 py-4 text-sm"><?= $item['descripcion'] ?></td>
                    <td class="px-6 py-4 text-sm">
                        <p class="text-center px-3 py-1 rounded-full <?= $clCategorias[$item['categoria']] ?> text-xs font-semibold">
                            <?= $item['categoria'] ?> </p>
                    </td>
                    <td class="px-6 py-4 text-sm">
                        <p class="px-3 text-center py-1 rounded-full <?= $clDisponible[$item['disponible']] ?> text-white text-xs font-bold">
                            <?= $item['disponible'] ?> </p>
                    </td>
                    <td class="px-6 py-4 text-sm font-semibold"><?= $item['precio'] ?></td>
                    <td class="px-6 py-4 flex justify-center gap-4 text-lg">
                        <form method="GET" action="borrar.php">
                            <input type="hidden" name="id" value="<?= $item['id'] ?>" />
                            <a href="update.php?id=<?= $item['id'] ?>" class="text-blue-600 hover:text-blue-800 hover:text-xl">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button class="text-red-600 hover:text-red-800 hover:text-xl" type='submit' onclick="return confirm('¿Borrar definitivamente?')">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <?php
    if(isset($_SESSION['mensaje'])){
        echo <<< TXT
            <script>
                Swal.fire({
                    icon: "success",
                    title: "{$_SESSION['mensaje']}",
                    showConfirmButton: false,
                    timer: 1500
                });
            </script>
        TXT;
        unset($_SESSION['mensaje']);
    }
    ?>
</body>

</html>