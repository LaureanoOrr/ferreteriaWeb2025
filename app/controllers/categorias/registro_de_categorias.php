<?php

include('../../config.php');

 $nombre_categoria = $_GET['nombre_categoria'];


 if (empty(trim($nombre_categoria))) {
    session_start();
    $_SESSION['mensaje'] = "El nombre de la categoría es obligatorio.";
    $_SESSION['icono'] = "error";
    ?>
    <script>
        location.href = "<?php echo $URL?>/categorias";
    </script>
    <?php
    exit;
}

 $sentencia = $pdo->prepare("INSERT INTO tb_categorias 
 ( nombre_categoria, fyh_creacion) 
VALUES (:nombre_categoria,:fyh_creacion)");

$sentencia->bindParam('nombre_categoria', $nombre_categoria);
$sentencia->bindParam('fyh_creacion', $fechaHora);

if ($sentencia->execute()){
 session_start();
 $_SESSION ['mensaje']= "Se registro la categoría correctamente";
 $_SESSION ['icono']= "success";
 //header( 'location: '.$URL.'/categorias');
?> 
<script>
    location.href ="<?php echo $URL?>/categorias"
</script>

<?php 

} else{
 session_start();
 $_SESSION ['mensaje']="Error no se pudo registrar en la base de datos";
 $_SESSION ['icono']= "error";
 //header( 'location: '.$URL.'/categorias');
 ?> 
<script>
    location.href ="<?php echo $URL?>/categorias"
</script>

<?php 
}
