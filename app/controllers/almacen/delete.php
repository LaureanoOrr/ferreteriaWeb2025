<?php
include('../../config.php');

$id_producto = $_POST['id_producto'];

// Consulta para actualizar el estado del producto a 'inactivo'
$update_query = "UPDATE tb_almacen SET estado = 'inactivo' WHERE id_producto = :id_producto";

$statement = $pdo->prepare($update_query);
$statement->bindParam(':id_producto', $id_producto);


session_start();

if ($statement->execute()) {
    $_SESSION['mensaje'] = "Se actualizó el estado del producto a 'inactivo' correctamente.";
    $_SESSION['icono'] = "success";
    header('Location: ' . $URL . '/almacen');
} else {
    $_SESSION['mensaje'] = "Error: no se pudo actualizar el estado del producto en la base de datos.";
    $_SESSION['icono'] = "error";
    header('Location: ' . $URL . '/almacen/delete.php?id=' . $id_producto);
}
?>

