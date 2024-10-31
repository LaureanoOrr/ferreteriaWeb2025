<?php

include('../../config.php');
 $id_proveedor = $_GET['id_proveedor'];
 $nombre_proveedor = $_GET['nombre_proveedor'];
 $telefono = $_GET['telefono'];
 $email = $_GET['email'];
 $direccion = $_GET['direccion'];
 $cuit = $_GET['cuit'];


 if (empty(trim($nombre_proveedor))) {
    session_start();
    $_SESSION['mensaje'] = "El campo es obligatorio.";
    $_SESSION['icono'] = "error";
    ?>
    <script>
        location.href = "<?php echo $URL?>/proveedores";
    </script>
    <?php
    exit;
}

 $sentencia = $pdo->prepare("UPDATE tb_proveedores
        SET nombre_proveedor=:nombre_proveedor,
            telefono=:telefono,
            email=:email,
            direccion=:direccion,
            cuit=:cuit,
            fyh_actualizacion=:fyh_actualizacion
        WHERE id_proveedor =:id_proveedor");

$sentencia->bindParam('nombre_proveedor', $nombre_proveedor);
$sentencia->bindParam('telefono', $telefono);
$sentencia->bindParam('email', $email);
$sentencia->bindParam('direccion', $direccion);
$sentencia->bindParam('cuit', $cuit);
$sentencia->bindParam('fyh_actualizacion', $fechaHora);
$sentencia->bindParam('id_proveedor', $id_proveedor);

if ($sentencia->execute()){
 session_start();
 $_SESSION ['mensaje']= "Se actializo al proveedor correctamente";
 $_SESSION ['icono']= "success";
 //header( 'location: '.$URL.'/categorias');
?> 
<script>
    location.href ="<?php echo $URL?>/proveedores"
</script>

<?php 

} else{
 session_start();
 $_SESSION ['mensaje']="Error no se pudo registrar en la base de datos";
 $_SESSION ['icono']= "error";
 //header( 'location: '.$URL.'/categorias');
 ?> 
<script>
    location.href ="<?php echo $URL?>/proveedores"
</script>

<?php 
}