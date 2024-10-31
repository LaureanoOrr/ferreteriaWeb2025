<?php
include('../../config.php');

$id_categoria = $_POST['id_categoria'];

// Obtener el código más alto existente en la categoría seleccionada
$sentencia = $pdo->prepare("SELECT MAX(codigo) as max_codigo FROM tb_almacen WHERE id_categoria = :id_categoria");
$sentencia->bindParam('id_categoria', $id_categoria);
$sentencia->execute();
$result = $sentencia->fetch(PDO::FETCH_ASSOC);

if ($result['max_codigo']) {
    $max_codigo = $result['max_codigo'];
    // Extraer el número del código
    preg_match('/-(\d+)$/', $max_codigo, $matches);
    $next_number = intval($matches[1]) + 1;
} else {
    $next_number = 1; // Inicia desde 1 si no hay productos en la categoría
}

// Generar el nuevo código del producto
$codigo = 'P' . $id_categoria . '-' . str_pad($next_number, 5, '0', STR_PAD_LEFT);

$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$stock = $_POST['stock'];
$stock_minimo = $_POST['stock_minimo'];
$stock_maximo = $_POST['stock_maximo'];
$precio_compra = $_POST['precio_compra'];
$precio_venta = $_POST['precio_venta'];
$fecha_ingreso = $_POST['fecha_ingreso'];
$id_usuario = $_POST['id_usuario'];

// Insertar el nuevo producto en la base de datos
$sentencia = $pdo->prepare("INSERT INTO tb_almacen (codigo, id_categoria, nombre, descripcion, stock, stock_minimo, stock_maximo, precio_compra, precio_venta, fecha_ingreso, id_usuario) VALUES (:codigo, :id_categoria, :nombre, :descripcion, :stock, :stock_minimo, :stock_maximo, :precio_compra, :precio_venta, :fecha_ingreso, :id_usuario)");

$sentencia->bindParam(':codigo', $codigo);
$sentencia->bindParam(':id_categoria', $id_categoria);
$sentencia->bindParam(':nombre', $nombre);
$sentencia->bindParam(':descripcion', $descripcion);
$sentencia->bindParam(':stock', $stock);
$sentencia->bindParam(':stock_minimo', $stock_minimo);
$sentencia->bindParam(':stock_maximo', $stock_maximo);
$sentencia->bindParam(':precio_compra', $precio_compra);
$sentencia->bindParam(':precio_venta', $precio_venta);
$sentencia->bindParam(':fecha_ingreso', $fecha_ingreso);
$sentencia->bindParam(':id_usuario', $id_usuario);

session_start();
if ($sentencia->execute()) {
    $_SESSION['mensaje'] = "Producto registrado correctamente";
    $_SESSION['icono'] = "success";
    header('location: ' . $URL . '/almacen');
} else {
    $_SESSION['mensaje'] = "Error al registrar el producto";
    $_SESSION['icono'] = "error";
    header('location: ' . $URL . '/almacen/create.php');
}
?>
