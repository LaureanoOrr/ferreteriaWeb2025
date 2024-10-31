<?php

include('../../config.php');

$id_venta = $_GET['id_venta'];
$nro_venta = $_GET['nro_venta'];

$pdo->beginTransaction(); // realiza las sentencias


// elimina el producto del carrito en la base de datos
$sentencia = $pdo->prepare(" DELETE FROM tb_ventas WHERE id_venta=:id_venta");

$sentencia->bindParam(':id_venta', $id_venta);



if ($sentencia->execute()) {

    $sentencia2 = $pdo->prepare(" DELETE FROM tb_carrito WHERE nro_venta=:nro_venta");
    $sentencia2->bindParam(':nro_venta', $nro_venta);
    $sentencia2->execute();
    
    $pdo->commit(); // sino hubo error en las sentencias modifica la base de datos

    session_start();
    $_SESSION['mensaje'] = "Se elimino la venta correctamente";
    $_SESSION['icono'] = "success";
?>
    <script>
        location.href = "<?php echo $URL ?>/ventas/"
    </script>

<?php

} else {

    echo "error al eliminar venta";
    $pdo->rollBack(); // si hubo error no cambia la base de datos
    session_start();
    $_SESSION['mensaje'] = "Error no se pudo eliminar la venta";
    $_SESSION['icono'] = "error";

    ?>
    <script>
        location.href = "<?php echo $URL ?>/ventas/"
    </script>

<?php

}
