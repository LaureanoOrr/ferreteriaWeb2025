<?php
/**
 * @var PDO $pdo
 */
include('../../config.php');

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

 $sentencia = $pdo->prepare("INSERT INTO tb_proveedores
 ( nombre_proveedor, telefono, email, direccion, cuit, fyh_creacion) 
VALUES (:nombre_proveedor, :telefono, :email, :direccion, :cuit, :fyh_creacion)");

$sentencia->bindParam('nombre_proveedor', $nombre_proveedor);
$sentencia->bindParam('telefono', $telefono);
$sentencia->bindParam('email', $email);
$sentencia->bindParam('direccion', $direccion);
$sentencia->bindParam('cuit', $cuit);
$sentencia->bindParam('fyh_creacion', $fechaHora);

if ($sentencia->execute()){
 session_start();
 $_SESSION ['mensaje']= "Se registro al proveedor correctamente";
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
