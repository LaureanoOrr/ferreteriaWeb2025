<?php
include('../../config.php');
session_start(); // Se inicia la sesión al principio

$nro_venta = $_GET['nro_venta'];
$id_cliente = $_GET['id_cliente'];
$total_pagado = $_GET['total_pagado'];
$metodo_pago = $_GET['metodo_pago'];

try {
    $pdo->beginTransaction(); // Inicia la transacción

    // Insertar la nueva venta en la base de datos
    $sentencia = $pdo->prepare("INSERT INTO tb_ventas
        (nro_venta, id_cliente, total_pagado, metodo_pago, fyh_creacion)
        VALUES (:nro_venta, :id_cliente, :total_pagado, :metodo_pago, :fyh_creacion)");

    $sentencia->bindParam(':nro_venta', $nro_venta);
    $sentencia->bindParam(':id_cliente', $id_cliente);
    $sentencia->bindParam(':total_pagado', $total_pagado);
    $sentencia->bindParam(':metodo_pago', $metodo_pago);
    $sentencia->bindParam(':fyh_creacion', $fechaHora);

    if ($sentencia->execute()) {
        $pdo->commit(); // Confirma la transacción

        $_SESSION['mensaje'] = "Se registró la venta correctamente";
        $_SESSION['icono'] = "success";

        ?>
        <script>
            location.href = "<?php echo $URL ?>/ventas"; // Redirigir a la vista principal de ventas
        </script>
        <?php
    } else {
        throw new Exception("No se pudo registrar la venta en la base de datos.");
    }
} catch (Exception $e) {
    $pdo->rollBack(); // Si ocurre un error, se revierte la transacción

    $_SESSION['mensaje'] = "Error: " . $e->getMessage();
    $_SESSION['icono'] = "error";
    ?>
    <script>
        location.href = "<?php echo $URL ?>/ventas/create.php"; // Redirigir a la vista de creación en caso de error
    </script>
    <?php
}

