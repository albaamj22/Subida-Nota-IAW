# Subida de Nota 1º Trimestre IAW

> **Implantación de Aplicaciones Web** · Ciclo Formativo de Grado Superior en Administración de Sistemas Informáticos en Red

CRUD completo para la gestión de un catálogo de videojuegos. Se puede visualizar la lista, crear juegos, editarlos y eliminarlos.

---

## Estructura del Proyecto

```
.
│
├── basedatos/
│   └── conexion.php          # Establece la conexión MySQLi a la base de datos
│
├── public/                   # Páginas accesibles desde el navegador
│   ├── index.php             # Listado de todos los videojuegos
│   ├── nuevo.php             # Formulario para crear un nuevo videojuego
│   ├── update.php            # Formulario para editar un videojuego existente
│   └── borrar.php            # Fichero que almacena las instrucciones de borrado
│
├── sql/
│   └── tablas.sql            # Creación de las tablas y almacenado de contenido de prueba
│
├── utils/
│   ├── datos.php             # Arrays de categorías y disponibilidad
│   └── validaciones.php      # Funciones de limpieza y validación de datos del formulario
│
└── plantilla/
    └── base.html             # Plantilla HTML
```

---

## Descripción de cada fichero

### `basedatos/conexion.php`
Conecta a MySQL usando `mysqli_connect`. La conexión apunta a `127.0.0.1` con el usuario `uexamen`, la base de datos `examen` y el **puerto 3307** (Lo puse asi ya que en Docker indique dicho puerto).

### `public/index.php`
Página principal. Consulta todos los videojuegos y los muestra en una tabla.Incluye botones de edición y borrado por fila, y muestra notificaciones al interactuar con el formulario.

### `public/nuevo.php`
Gestiona el formulario de alta. Valida los datos y, si son correctos, inserta el registro con una consulta parametrizada y redirige al índice con mensaje de éxito.

### `public/update.php`
Recibe un `id`, busca el videojuego en la BD y precarga el formulario. Valida y ejecuta el `UPDATE` con consultas parametrizadas.

### `public/borrar.php`
Recibe el `id` (desde un formulario en `index.php`), valida y ejecuta el `DELETE`. Siempre redirige a `index.php`.

### `sql/tablas.sql`
Script SQL con la definición de la tabla `videojuegos` (campos: `id`, `nombre`, `descripcion`, `categoria` ENUM, `disponible` ENUM, `precio` DECIMAL) y 15 registros de prueba.

### `utils/datos.php`
Define dos arrays globales:
- `$clCategorias` — Indica las categoría a sus clases de color usando Tailwind.
- `$clDisponible` — Indica SI/NO a clases de color.

### `utils/validaciones.php`
Contiene las funciones de validación reutilizadas en `nuevo.php` y `update.php`:
- `limpiarDatos()` — aplica `trim` + `htmlspecialchars`.
- `longitudCampoValida()` — comprueba mínimo y máximo de caracteres.
- `precioValido()` — valida rango numérico del precio.
- `categoriaValida()` — verifica que la categoría esté en el array permitido.
- `disponibleValido()` — verifica que el valor sea SI o NO.
- `pintarErrores()` — imprime el error de sesión y lo borra.

### `plantilla/base.html`
Boceto HTML usado como referencia de diseño durante el desarrollo.

---

## Tecnologías usadas

| Tecnología | Uso |
|---|---|
| PHP 8+ | Backend, CRUDs, validaciones |
| MySQLi | Acceso a base de datos |
| MySQL 8 (Docker) | Motor de base de datos en Docker |
| Tailwind CSS v4 (CDN) | Estilos y diseño responsive |
| Font Awesome 7 (CDN) | Iconografía |
| SweetAlert2 (CDN) | Notificaciones de feedback al usuario |
| Sessions PHP | Paso de mensajes y errores entre redirecciones |

---

## Configuración de la base de datos (Docker)

La base de datos corre en un **contenedor Docker** con el puerto `3307` mapeado al host (en lugar del 3306 estándar), para no colisionar con una instalación local de MySQL o Laragon (que es el entorno de desarrollo que utilizo actuamente).

```
Host:     127.0.0.1
Puerto:   3307
Usuario:  uexamen
Password: secret0
Base de datos: examen
```
