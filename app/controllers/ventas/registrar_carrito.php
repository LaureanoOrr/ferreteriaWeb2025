<?php 
include('../../config.php');

$id_producto = $_GET['id_producto'];
$nro_venta = $_GET['nro_venta'];
$cantidad = $_GET['cantidad'];

// Verificar si el producto ya está en el carrito
$sentencia_verificar = $pdo->prepare("SELECT * FROM tb_carrito WHERE nro_venta = :nro_venta AND id_producto = :id_producto");
$sentencia_verificar->bindParam(':nro_venta', $nro_venta);
$sentencia_verificar->bindParam(':id_producto', $id_producto);
$sentencia_verificar->execute();

$producto_existente = $sentencia_verificar->fetch(PDO::FETCH_ASSOC);

if ($producto_existente) {
    // Si el producto ya existe en el carrito, sumamos la cantidad
    $nueva_cantidad = $producto_existente['cantidad'] + $cantidad;
    $sentencia_actualizar = $pdo->prepare("UPDATE tb_carrito SET cantidad = :nueva_cantidad WHERE nro_venta = :nro_venta AND id_producto = :id_producto");
    $sentencia_actualizar->bindParam(':nueva_cantidad', $nueva_cantidad);
    $sentencia_actualizar->bindParam(':nro_venta', $nro_venta);
    $sentencia_actualizar->bindParam(':id_producto', $id_producto);
    $sentencia_actualizar->execute();
} else {
    // Si el producto no existe, lo insertamos como nuevo en el carrito
    $sentencia_insertar = $pdo->prepare("INSERT INTO tb_carrito (nro_venta, id_producto, cantidad, fyh_creacion) VALUES (:nro_venta, :id_producto, :cantidad, :fyh_creacion)");
    $sentencia_insertar->bindParam(':id_producto', $id_producto);
    $sentencia_insertar->bindParam(':nro_venta', $nro_venta);
    $sentencia_insertar->bindParam(':cantidad', $cantidad);
    $sentencia_insertar->bindParam(':fyh_creacion', $fechaHora);
    $sentencia_insertar->execute();
}
?>

<script>
    location.href = "<?php echo $URL?>/ventas/create.php";
</script>