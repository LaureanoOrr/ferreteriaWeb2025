<?php 
ob_start();
error_reporting(E_ALL & ~E_NOTICE); // Mostrar errores excepto Notificaciones para evitar mensajes en la página
include('../app/config.php');
include('../layout/sesion.php');
include('../layout/parte1.php');

// Obtener las categorías para el formulario
$sqlCategorias = "SELECT * FROM tb_categorias";
$categorias = $pdo->query($sqlCategorias)->fetchAll(PDO::FETCH_ASSOC);

// Obtener los productos de la categoría seleccionada
$categoriaSeleccionada = isset($_GET['categoria']) ? $_GET['categoria'] : '';
$sqlProductos = "SELECT * FROM tb_almacen WHERE estado = 'activo' AND id_categoria = :categoria";
$stmtProductos = $pdo->prepare($sqlProductos);
$stmtProductos->bindParam(':categoria', $categoriaSeleccionada, PDO::PARAM_INT);
$stmtProductos->execute();
$productos = $stmtProductos->fetchAll(PDO::FETCH_ASSOC);

// Procesar el formulario cuando se envía y el porcentaje esté definido
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['porcentaje']) && $_POST['porcentaje'] !== '') {
    $categoria = isset($_POST['categoria']) ? $_POST['categoria'] : '';
    $producto = isset($_POST['producto']) ? $_POST['producto'] : '';
    $porcentaje = $_POST['porcentaje'] / 100;

    // Crear la consulta base para actualizar el precio de venta del producto seleccionado
    $sqlUpdate = "UPDATE tb_almacen SET precio_venta = precio_venta * (1 + :porcentaje) WHERE estado = 'activo'";

    // Condicional para la categoría y el producto
    if ($categoria !== '') {
        $sqlUpdate .= " AND id_categoria = :categoria";
    }
    if ($producto !== '') {
        $sqlUpdate .= " AND id_producto = :producto";
    }

    // Preparar y ejecutar la consulta
    $stmt = $pdo->prepare($sqlUpdate);
    $stmt->bindParam(':porcentaje', $porcentaje, PDO::PARAM_STR);

    if ($categoria !== '') {
        $stmt->bindParam(':categoria', $categoria, PDO::PARAM_INT);
    }
    if ($producto !== '') {
        $stmt->bindParam(':producto', $producto, PDO::PARAM_INT);
    }

    if ($stmt->execute()) {
        // Redirigir manteniendo la categoría y el producto seleccionados
        header("Location: ".$_SERVER['PHP_SELF']."?categoria=".$categoria."&producto=".$producto);
        exit();
    } else {
        $errorInfo = $stmt->errorInfo();
        echo "Error al actualizar precios: " . $errorInfo[2] . "<br>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Actualizar Precios</title>
    <script>
        // Función para redirigir la página automáticamente al seleccionar una categoría o producto
        function filtrarPorCategoria() {
            var categoriaSeleccionada = document.getElementById('categoria').value;
            window.location.href = 'index.php?categoria=' + categoriaSeleccionada;
        }
        function filtrarPorProducto() {
            var categoriaSeleccionada = document.getElementById('categoria').value;
            var productoSeleccionado = document.getElementById('producto').value;
            window.location.href = 'index.php?categoria=' + categoriaSeleccionada + '&producto=' + productoSeleccionado;
        }
    </script>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <!-- Barra lateral -->
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
            <div class="sidebar-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="../index.php">
                            <span data-feather="arrow-left-circle"></span>
                            Volver al menú
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Contenido principal -->
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Actualizar Precios de Venta</h1>
            </div>

            <!-- Formulario para actualizar precios por lote -->
            <form action="index.php" method="post" class="mb-5">
                <div class="form-group">
                    <label for="categoria">Seleccione Categoría:</label>
                    <select name="categoria" id="categoria" class="form-control" onchange="filtrarPorCategoria()">
                        <option value="">--Todas las categorías--</option>
                        <?php foreach ($categorias as $cat): ?>
                            <option value="<?php echo $cat['id_categoria']; ?>" <?php echo ($categoriaSeleccionada == $cat['id_categoria']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($cat['nombre_categoria']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <?php if ($categoriaSeleccionada): ?>
                <div class="form-group">
                    <label for="producto">Seleccione Producto:</label>
                    <select name="producto" id="producto" class="form-control" onchange="filtrarPorProducto()">
                        <option value="">--Todos los productos--</option>
                        <?php foreach ($productos as $prod): ?>
                            <option value="<?php echo htmlspecialchars($prod['id_producto']); ?>" <?php echo (isset($_GET['producto']) && $_GET['producto'] == $prod['id_producto']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($prod['nombre']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <?php endif; ?>

                <div class="form-group">
                    <label for="porcentaje">Ingrese porcentaje de aumento (%):</label>
                    <input type="number" name="porcentaje" id="porcentaje" step="0.01" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary">Aplicar Aumento</button>
            </form>

            <!-- Mostrar productos filtrados -->
            <h3>Listado de Productos</h3>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Precio Compra</th>
                        <th>Precio Venta</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    // Filtrar productos para mostrar solo el producto seleccionado si está definido
                    $sqlListado = "SELECT * FROM tb_almacen WHERE estado = 'activo'";
                    if ($categoriaSeleccionada !== '') {
                        $sqlListado .= " AND id_categoria = :categoria";
                    }
                    if (isset($_GET['producto']) && $_GET['producto'] !== '') {
                        $sqlListado .= " AND id_producto = :producto";
                    }

                    $stmtListado = $pdo->prepare($sqlListado);

                    if ($categoriaSeleccionada !== '') {
                        $stmtListado->bindParam(':categoria', $categoriaSeleccionada, PDO::PARAM_INT);
                    }
                    if (isset($_GET['producto']) && $_GET['producto'] !== '') {
                        $stmtListado->bindParam(':producto', $_GET['producto'], PDO::PARAM_INT);
                    }

                    $stmtListado->execute();
                    $listadoProductos = $stmtListado->fetchAll(PDO::FETCH_ASSOC);

                    if (count($listadoProductos) > 0): 
                        foreach ($listadoProductos as $producto): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($producto['codigo']); ?></td>
                                <td><?php echo htmlspecialchars($producto['nombre']); ?></td>
                                <td><?php echo "$" . number_format($producto['precio_compra'], 2); ?></td>
                                <td><?php echo "$" . number_format($producto['precio_venta'], 2); ?></td>
                            </tr>
                        <?php endforeach; 
                    else: ?>
                        <tr>
                            <td colspan="4" class="text-center">No se encontraron productos en esta categoría o producto específico.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </main>
    </div>
</div>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>

<?php 
include('../layout/parte2.php');
include('../layout/mensajes.php');
ob_end_flush();
?>
