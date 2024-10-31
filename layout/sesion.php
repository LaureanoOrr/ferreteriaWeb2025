<?php

session_start ();
if (isset($_SESSION['sesion_mail'])){
  //echo "Si existe sesion";
  $email_session = $_SESSION['sesion_mail'];
  $sql = "SELECT us.id_usuario as id_usuario, us.nombres as nombres, us.email as email, rol.rol as rol 
                FROM tb_usuarios as us INNER JOIN tb_roles as rol ON us.id_rol = rol.id_rol WHERE email='$email_session'";
  $query = $pdo->prepare($sql);
  $query->execute();
  $usuarios = $query->fetchAll(PDO::FETCH_ASSOC);
  foreach($usuarios as $usuario){
  
    $id_usuario_sesion= $usuario['id_usuario'];
    $nombres_sesion= $usuario['nombres'];
    $rol_sesion= $usuario['rol'];
  }

}else
{
  echo "No existe sesion";
  header ('location:'.$URL.'/login');
}
?>