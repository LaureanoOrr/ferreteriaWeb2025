<?php

include('../../config.php');

$id_compra = $_GET['id_compra'];
$id_producto = $_GET['id_producto'];
$cantidad_compra = $_GET['cantidad_compra'];
$stock_actual = $_GET['stock_actual'];

$pdo->beginTransaction(); // realiza las sentencias

// elimina  la compra en la base de datos
$sentencia = $pdo->prepare(" DELETE FROM tb_compras WHERE id_compra=:id_compra");

$sentencia->bindParam(':id_compra', $id_compra);


if ($sentencia->execute()) {
    //calcular el stock con la compra eliminada
    $stock = $stock_actual-$cantidad_compra;
    // actualizar stock producto desde la compra en la base de datos
    $sentencia = $pdo->prepare("UPDATE tb_almacen SET stock=:stock WHERE id_producto =:id_producto");

    $sentencia->bindParam(':stock', $stock);
    $sentencia->bindParam(':id_producto', $id_producto);
    $sentencia->execute();

    $pdo->commit(); // sino hubo error en las sentencias modifica la base de datos
    
    session_start();
    $_SESSION['mensaje'] = "Se elimino la compra correctamente";
    $_SESSION['icono'] = "success";
?>
    <script>
        location.href = "<?php echo $URL ?>/compras"
    </script>

<?php

} else {
    $pdo->rollBack(); // si hubo error no cambia la base de datos

    session_start();
    $_SESSION['mensaje'] = "Error no se pudo actalizar en la base de datos";
    $_SESSION['icono'] = "error";
?>
    <script>
        location.href = "<?php echo $URL ?>/compras"
    </script>

<?php
}




