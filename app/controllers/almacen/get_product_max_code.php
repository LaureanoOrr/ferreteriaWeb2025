<?php
include('../../config.php');

$id_categoria = $_GET['id_categoria'];

// Obtener el código más alto existente en la categoría seleccionada
$sentencia = $pdo->prepare("SELECT MAX(codigo) as max_codigo FROM tb_almacen WHERE id_categoria = :id_categoria");
$sentencia->bindParam('id_categoria', $id_categoria);
$sentencia->execute();
$result = $sentencia->fetch(PDO::FETCH_ASSOC);

echo json_encode(['max_codigo' => $result['max_codigo']]);
?>
