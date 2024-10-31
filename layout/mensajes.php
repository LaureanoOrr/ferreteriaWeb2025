<?php
if ((isset( $_SESSION ['mensaje'])) && ($_SESSION ['icono']="success")) {
    $respuesta =  $_SESSION ['mensaje'];
    $icono = $_SESSION ['icono'];
     ?>
    <script>
       Swal.fire({
        position: "center",
        icon: "<?php echo $icono; ?>",
        title: "<?php echo $respuesta; ?>",
        showConfirmButton: false,
        timer: 2000
      });
    </script>
  
  <?php
  unset($_SESSION ['mensaje']);
  unset($_SESSION ['icono']);
  }