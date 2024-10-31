<?php
include('../../config.php');

$nombre_cliente = $_POST['nombre_cliente'];
$dni_cliente = $_POST['dni_cliente'];
$celular_cliente = $_POST['celular_cliente'];
$email_cliente = $_POST['email_cliente'];


// Insertar la nueva compra en la base de datos
$sentencia = $pdo->prepare("INSERT INTO tb_clientes
        (nombre_cliente, dni_cliente, celular_cliente, email_cliente,  fyh_creacion)
 VALUES (:nombre_cliente, :dni_cliente, :celular_cliente, :email_cliente, :fyh_creacion)");

$sentencia->bindParam(':nombre_cliente', $nombre_cliente);
$sentencia->bindParam(':dni_cliente', $dni_cliente);
$sentencia->bindParam(':celular_cliente', $celular_cliente);
$sentencia->bindParam(':email_cliente', $email_cliente);

$sentencia->bindParam(':fyh_creacion', $fechaHora);


if ($sentencia->execute()) {
?>
    <script>
        location.href = "<?php echo $URL ?>/ventas/create.php"
    </script>

<?php

} else {
   

    session_start();
    $_SESSION['mensaje'] = "Error no se pudo registrar en la base de datos";
    $_SESSION['icono'] = "error";
?>
    <script>
        location.href = "<?php echo $URL ?>/ventas/create.php"
    </script>

<?php
}
